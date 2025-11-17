<?php

namespace App\Http\Controllers;

use App\Models\DatTour;
use App\Models\Payment;
use App\Models\HoaDonDatTour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\MomoService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    /**
     * Tạo yêu cầu thanh toán mới tới Momo.
     */
    public function createMomoPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:dat_tour,id',
        ]);

        $booking = DatTour::findOrFail($request->booking_id);

        // Kiểm tra quyền sở hữu
        if ($booking->id_khachhang !== (string) auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Chặn thanh toán lại
        if ($booking->payment_status === 'paid') {
            return back()->with('warning', 'Đơn này đã được thanh toán rồi.');
        }

        $amount = $booking->tour->gia * $booking->so_nguoi;
        $orderId = 'momo_' . $booking->id . '_' . time(); // ID đơn hàng duy nhất cho Momo
        $orderInfo = "Thanh toan don hang tour " . $booking->id;

        // Tạo hoặc cập nhật bản ghi thanh toán
        $payment = Payment::updateOrCreate(
            ['booking_id' => $booking->id, 'gateway' => 'momo', 'status' => 'pending'],
            [
                'order_code' => $orderId,
                'amount' => $amount,
                'currency' => 'VND',
            ]
        );

        $momoService = new MomoService();
        $response = $momoService->createPayment($orderId, $amount, $orderInfo);

        if (isset($response['payUrl'])) {
            return redirect()->away($response['payUrl']);
        }

        Log::error('Momo Payment Creation Failed', ['response' => $response]);
        return back()->with('error', 'Không thể tạo thanh toán MoMo. Vui lòng thử lại.');
    }

    /**
     * Xử lý URL trả về từ Momo.
     */
    public function momoReturn(Request $request)
    {
        $orderId = $request->input('orderId');
        $resultCode = $request->input('resultCode');

        if (!$orderId) {
            return redirect()->route('homepage')->with('error', 'Thiếu thông tin đơn hàng.');
        }

        $payment = Payment::where('order_code', $orderId)->first();

        if (!$payment) {
            Log::warning('MoMo Return: Payment not found', ['orderId' => $orderId]);
            return redirect()->route('homepage')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Log data nhận được từ MoMo
        Log::info('MoMo Return Received', [
            'orderId' => $orderId,
            'resultCode' => $resultCode,
            'data' => $request->all()
        ]);

        $momoService = new MomoService();
        $isValid = $momoService->verifyPayment($request->all());

        if (!$isValid) {
            Log::warning('Momo Return Signature Invalid', ['data' => $request->all()]);
            return redirect()->route('payment.result', $payment)->with('error', 'Chữ ký không hợp lệ từ Momo.');
        }

        if ($resultCode == 0) {
            // Nếu thanh toán thành công và payment vẫn pending, cập nhật luôn
            // (Trong trường hợp IPN chưa đến hoặc bị chậm)
            if ($payment->status === 'pending') {
                try {
                    DB::transaction(function () use ($request, $payment, $resultCode) {
                        $payment->update([
                            'status' => 'succeeded', // Đổi từ 'paid' thành 'succeeded'
                            'transaction_id' => $request->input('transId'),
                            'paid_at' => now(),
                            'signature_valid' => true,
                            'return_code' => (string) $resultCode,
                            'meta' => $request->all(),
                        ]);

                        Log::info('MoMo Return: Payment updated to succeeded', [
                            'payment_id' => $payment->id,
                            'order_code' => $request->input('orderId'),
                        ]);

                        // Lock booking và cập nhật
                        $booking = $payment->booking()->lockForUpdate()->first();

                        if ($booking && $booking->payment_status !== 'paid') {
                            // Cập nhật payment_status VÀ tự động duyệt tour
                            $booking->update([
                                'payment_status' => 'paid',
                                'trang_thai_dattour' => 'Đã xác nhận', // Tự động duyệt
                            ]);

                            Log::info('MoMo Return: Booking confirmed automatically', [
                                'booking_id' => $booking->id,
                                'payment_id' => $payment->id,
                            ]);

                            // Tạo hóa đơn (nếu chưa có)
                            $existingInvoice = HoaDonDatTour::where('id_dattour', $booking->id)->first();
                            if (!$existingInvoice) {
                                try {
                                    $lastHoaDonDatTour = HoaDonDatTour::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_hoadon")
                                        ->orderBy('so_hoadon', 'desc')
                                        ->first();
                                    $newNumber = $lastHoaDonDatTour ? $lastHoaDonDatTour->so_hoadon + 1 : 1;

                                    $hoaDonData = [
                                        'id' => 'HD-' . $newNumber,
                                        'id_dattour' => $booking->id,
                                        'phuong_thuc_thanh_toan' => 'Thanh toán online qua Momo',
                                        'trang_thai' => 'Đã thanh toán',
                                    ];

                                    $hoaDon = HoaDonDatTour::create($hoaDonData);

                                    Log::info('MoMo Return: Invoice created', [
                                        'invoice_id' => $hoaDon->id,
                                        'booking_id' => $booking->id,
                                    ]);
                                } catch (\Exception $e) {
                                    Log::error('MoMo Return: Failed to create invoice', [
                                        'booking_id' => $booking->id,
                                        'error' => $e->getMessage(),
                                    ]);
                                }
                            }

                            // Gửi email hóa đơn cho khách hàng
                            try {
                                dispatch(new \App\Jobs\SendInvoiceJob($booking->id, $payment->id));
                                Log::info('MoMo Return: SendInvoiceJob dispatched', [
                                    'booking_id' => $booking->id,
                                ]);
                            } catch (\Exception $e) {
                                Log::error('MoMo Return: Failed to dispatch SendInvoiceJob', [
                                    'booking_id' => $booking->id,
                                    'error' => $e->getMessage(),
                                ]);
                            }

                            // Notify admin
                            try {
                                $adminEmail = config('services.business.admin_email');
                                if ($adminEmail) {
                                    Notification::route('mail', $adminEmail)
                                        ->notify(new \App\Notifications\BookingPaidAdminNotification($booking->id));

                                    Log::info('MoMo Return: Admin notification sent', [
                                        'booking_id' => $booking->id,
                                        'admin_email' => $adminEmail,
                                    ]);
                                }
                            } catch (\Exception $e) {
                                Log::error('MoMo Return: Failed to send admin notification', [
                                    'booking_id' => $booking->id,
                                    'error' => $e->getMessage(),
                                ]);
                            }
                        }
                    });
                } catch (\Exception $e) {
                    Log::error('MoMo Return: Transaction failed', [
                        'orderId' => $orderId,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Refresh payment để lấy data mới nhất
            $payment->refresh();

            return redirect()->route('payment.result', $payment)->with('success', 'Giao dịch thành công!');
        }

        return redirect()->route('payment.result', $payment)->with('error', 'Giao dịch không thành công. Vui lòng thử lại.');
    }

    /**
     * Xử lý thông báo IPN từ Momo.
     */
    public function momoNotify(Request $request)
    {
        Log::info('Momo IPN Received', ['data' => $request->all()]);

        $momoService = new MomoService();
        $isValid = $momoService->verifyPayment($request->all());

        if (!$isValid) {
            Log::error('Momo IPN Signature Invalid', ['data' => $request->all()]);
            // Không phản hồi thành công để Momo có thể gửi lại
            return response()->json(['resultCode' => 1, 'message' => 'Signature failed'], 400);
        }

        $resultCode = $request->input('resultCode');
        $orderId = $request->input('orderId');

        if ($resultCode == 0) {
            try {
                DB::transaction(function () use ($request, $orderId, $resultCode) {
                    $payment = Payment::where('order_code', $orderId)
                        ->where('status', 'pending')
                        ->lockForUpdate()
                        ->first();

                    if ($payment) {
                        // Cập nhật payment
                        $payment->update([
                            'status' => 'succeeded', // Đổi từ 'paid' thành 'succeeded'
                            'transaction_id' => $request->input('transId'),
                            'paid_at' => now(),
                            'signature_valid' => true,
                            'return_code' => (string) $resultCode,
                            'meta' => $request->all(),
                        ]);

                        Log::info('MoMo IPN: Payment updated to succeeded', [
                            'payment_id' => $payment->id,
                            'order_code' => $orderId,
                        ]);

                        // Lock booking và cập nhật
                        $booking = $payment->booking()->lockForUpdate()->first();

                        if ($booking && $booking->payment_status !== 'paid') {
                            // Cập nhật payment_status VÀ tự động duyệt tour
                            $booking->update([
                                'payment_status' => 'paid',
                                'trang_thai_dattour' => 'Đã xác nhận', // Tự động duyệt
                            ]);

                            Log::info('MoMo IPN: Booking confirmed automatically', [
                                'booking_id' => $booking->id,
                                'payment_id' => $payment->id,
                            ]);

                            // Tạo hóa đơn (nếu chưa có)
                            $existingInvoice = HoaDonDatTour::where('id_dattour', $booking->id)->first();
                            if (!$existingInvoice) {
                                try {
                                    $lastHoaDonDatTour = HoaDonDatTour::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_hoadon")
                                        ->orderBy('so_hoadon', 'desc')
                                        ->first();
                                    $newNumber = $lastHoaDonDatTour ? $lastHoaDonDatTour->so_hoadon + 1 : 1;

                                    $hoaDonData = [
                                        'id' => 'HD-' . $newNumber,
                                        'id_dattour' => $booking->id,
                                        'phuong_thuc_thanh_toan' => 'Thanh toán online qua Momo',
                                        'trang_thai' => 'Đã thanh toán',
                                    ];

                                    $hoaDon = HoaDonDatTour::create($hoaDonData);

                                    Log::info('MoMo IPN: Invoice created', [
                                        'invoice_id' => $hoaDon->id,
                                        'booking_id' => $booking->id,
                                    ]);
                                } catch (\Exception $e) {
                                    Log::error('MoMo IPN: Failed to create invoice', [
                                        'booking_id' => $booking->id,
                                        'error' => $e->getMessage(),
                                    ]);
                                }
                            }

                            // Gửi email hóa đơn cho khách hàng
                            try {
                                dispatch(new \App\Jobs\SendInvoiceJob($booking->id, $payment->id));
                                Log::info('MoMo IPN: SendInvoiceJob dispatched', [
                                    'booking_id' => $booking->id,
                                ]);
                            } catch (\Exception $e) {
                                Log::error('MoMo IPN: Failed to dispatch SendInvoiceJob', [
                                    'booking_id' => $booking->id,
                                    'error' => $e->getMessage(),
                                ]);
                            }

                            // Notify admin
                            try {
                                $adminEmail = config('services.business.admin_email');
                                if ($adminEmail) {
                                    Notification::route('mail', $adminEmail)
                                        ->notify(new \App\Notifications\BookingPaidAdminNotification($booking->id));

                                    Log::info('MoMo IPN: Admin notification sent', [
                                        'booking_id' => $booking->id,
                                        'admin_email' => $adminEmail,
                                    ]);
                                }
                            } catch (\Exception $e) {
                                Log::error('MoMo IPN: Failed to send admin notification', [
                                    'booking_id' => $booking->id,
                                    'error' => $e->getMessage(),
                                ]);
                            }
                        }
                    } else {
                        Log::warning('MoMo IPN: Payment already processed or not found', [
                            'orderId' => $orderId
                        ]);
                    }
                });
            } catch (\Exception $e) {
                Log::error('MoMo IPN: Transaction failed', [
                    'orderId' => $orderId,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                return response()->json(['resultCode' => 1, 'message' => 'Transaction failed'], 500);
            }
        } else {
            Log::warning('Momo IPN: Payment failed or was cancelled.', [
                'orderId' => $orderId,
                'resultCode' => $resultCode,
                'message' => $request->input('message')
            ]);
        }

        // Phản hồi cho Momo để không gửi lại IPN
        return response()->json(['resultCode' => 0, 'message' => 'Success'], 200);
    }
}
