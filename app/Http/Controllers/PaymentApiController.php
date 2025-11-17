<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatTour;
use App\Models\Payment;
use App\Services\PayOSService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentApiController extends Controller
{
    /**
     * Khởi tạo đơn thanh toán PayOS
     * POST /api/payments/{booking}/payos/start
     */
    public function startPayOS(Request $request, DatTour $booking, PayOSService $payos)
    {
        // Verify ownership
        if ($booking->id_khachhang !== (string) auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Lấy hoặc tạo payment
        $amount = $booking->tour->gia * $booking->so_nguoi;
        $payment = Payment::where('booking_id', $booking->id)
            ->where('status', 'pending')
            ->first();

        if (!$payment) {
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'gateway' => 'payos',
                'order_code' => $booking->id . '-' . time(),
                'amount' => $amount,
                'currency' => 'VND',
                'status' => 'pending',
            ]);
        }

        try {
            // Gọi PayOS API để tạo order
            $result = $payos->createOrder([
                'orderCode' => $payment->order_code,
                'amount' => (int) $payment->amount,
                'description' => "Thanh toán tour {$booking->id}",
                'returnUrl' => route('payment.result', $payment),
                'cancelUrl' => route('user.booking.pay.payos', $booking),
                'buyerEmail' => $booking->email,
                'buyerPhone' => $booking->so_dien_thoai,
                'buyerName' => $booking->ho_ten,
            ]);

            // Cập nhật meta vào payment
            $payment->update([
                'meta' => json_encode($result),
            ]);

            return response()->json([
                'success' => true,
                'payment_id' => $payment->id,
                'qr_data' => $result['qrCode'] ?? null,
                'checkout_url' => $result['checkoutUrl'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('PayOS createOrder failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Lấy trạng thái thanh toán
     * GET /api/payments/{payment}/status
     */
    public function status(Request $request, Payment $payment)
    {
        // Verify ownership
        if ($payment->booking->id_khachhang !== (string) auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => $payment->status,
            'paid_at' => $payment->paid_at ? $payment->paid_at->toIso8601String() : null,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'order_code' => $payment->order_code,
            'booking_id' => $payment->booking_id,
        ]);
    }
}
