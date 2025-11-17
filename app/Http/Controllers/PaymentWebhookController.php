<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Models\Payment;
use App\Models\HoaDonDatTour;
use App\Jobs\SendInvoiceJob;
use App\Notifications\BookingPaidAdminNotification;
use App\Services\PayOSService;

class PaymentWebhookController extends Controller
{
    /**
     * Xử lý webhook từ PayOS
     */
    public function payos(Request $request, PayOSService $payos)
    {
        $payload = $request->all();

        // Log toàn bộ payload (mask dữ liệu nhạy cảm)
        Log::info('PayOS Webhook Received', [
            'payload' => $this->maskSensitiveData($payload),
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
        ]);

        // Xác thực chữ ký
        if (!$payos->verifySignature($payload)) {
            Log::warning('PayOS Webhook: Invalid signature', [
                'payload' => $this->maskSensitiveData($payload)
            ]);
            return response('Invalid signature', 400);
        }

        // Lấy thông tin từ payload
        $orderCode = data_get($payload, 'data.orderCode') ?? data_get($payload, 'orderCode');
        $amount = (int) (data_get($payload, 'data.amount') ?? 0);
        $code = data_get($payload, 'code') ?? data_get($payload, 'data.code', '0');
        $desc = data_get($payload, 'desc') ?? data_get($payload, 'data.desc', '');

        Log::info('PayOS Webhook: Processing', [
            'order_code' => $orderCode,
            'amount' => $amount,
            'code' => $code,
        ]);

        // Tìm payment theo order_code hoặc id
        $payment = Payment::where('order_code', $orderCode)
            ->orWhere('id', $orderCode)
            ->first();

        if (!$payment) {
            Log::warning('PayOS Webhook: Order not found', [
                'order_code' => $orderCode
            ]);
            // Trả 200 để tránh retry vô hạn
            return response()->json(['ok' => true, 'message' => 'Order not found']);
        }

        // Idempotency: Nếu đã succeeded thì không xử lý lại
        if ($payment->status === 'succeeded') {
            Log::info('PayOS Webhook: Payment already succeeded', [
                'payment_id' => $payment->id,
                'order_code' => $orderCode,
            ]);
            return response()->json(['ok' => true, 'message' => 'Already processed']);
        }

        try {
            DB::transaction(function () use ($payment, $amount, $payload, $code, $desc) {
                // Đối soát số tiền
                if ($amount !== (int) $payment->amount) {
                    Log::error('PayOS Webhook: Amount mismatch', [
                        'payment_id' => $payment->id,
                        'expected' => $payment->amount,
                        'received' => $amount,
                    ]);
                    abort(400, 'Amount mismatch');
                }

                // Cập nhật payment
                $payment->update([
                    'status' => 'succeeded',
                    'signature_valid' => true,
                    'paid_at' => now(),
                    'return_code' => (string) $code,
                    'txn_id' => data_get($payload, 'data.transactionId') ?? data_get($payload, 'data.id'),
                    'meta' => $payload,
                ]);

                Log::info('PayOS Webhook: Payment updated to succeeded', [
                    'payment_id' => $payment->id,
                ]);

                // Lock booking và cập nhật payment_status
                $booking = $payment->booking()->lockForUpdate()->first();

                if ($booking && $booking->payment_status !== 'paid') {
                    // Cập nhật payment_status VÀ tự động duyệt tour
                    $booking->update([
                        'payment_status' => 'paid',
                        'trang_thai_dattour' => 'Đã xác nhận', // Tự động duyệt
                    ]);

                    Log::info('PayOS Webhook: Booking confirmed automatically', [
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
                                'phuong_thuc_thanh_toan' => 'Thanh toán online qua PayOS (VietQR)',
                                'trang_thai' => 'Đã thanh toán',
                            ];

                            $hoaDon = HoaDonDatTour::create($hoaDonData);

                            Log::info('PayOS Webhook: Invoice created', [
                                'invoice_id' => $hoaDon->id,
                                'booking_id' => $booking->id,
                            ]);
                        } catch (\Exception $e) {
                            Log::error('PayOS Webhook: Failed to create invoice', [
                                'booking_id' => $booking->id,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }

                    // Gửi email hóa đơn cho khách hàng (async)
                    try {
                        dispatch(new SendInvoiceJob($booking->id, $payment->id));
                        Log::info('PayOS Webhook: SendInvoiceJob dispatched', [
                            'booking_id' => $booking->id,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('PayOS Webhook: Failed to dispatch SendInvoiceJob', [
                            'booking_id' => $booking->id,
                            'error' => $e->getMessage(),
                        ]);
                    }

                    // Notify admin
                    try {
                        $adminEmail = config('services.business.admin_email');
                        if ($adminEmail) {
                            Notification::route('mail', $adminEmail)
                                ->notify(new BookingPaidAdminNotification($booking));

                            Log::info('PayOS Webhook: Admin notification sent', [
                                'booking_id' => $booking->id,
                                'admin_email' => $adminEmail,
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('PayOS Webhook: Failed to send admin notification', [
                            'booking_id' => $booking->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            });

            return response()->json(['ok' => true]);
        } catch (\Exception $e) {
            Log::error('PayOS Webhook: Transaction failed', [
                'payment_id' => $payment->id ?? null,
                'order_code' => $orderCode,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Nếu là lỗi validation (400), throw lại
            if ($e->getCode() === 400 || str_contains($e->getMessage(), 'mismatch')) {
                return response($e->getMessage(), 400);
            }

            // Các lỗi khác trả 500
            return response('Internal error', 500);
        }
    }

    /**
     * Mask dữ liệu nhạy cảm trong log
     */
    private function maskSensitiveData(array $data): array
    {
        $masked = $data;

        $sensitiveKeys = ['signature', 'checksum', 'token', 'password', 'secret'];

        foreach ($sensitiveKeys as $key) {
            if (isset($masked[$key])) {
                $masked[$key] = '***MASKED***';
            }
            if (isset($masked['data'][$key])) {
                $masked['data'][$key] = '***MASKED***';
            }
        }

        return $masked;
    }
}
