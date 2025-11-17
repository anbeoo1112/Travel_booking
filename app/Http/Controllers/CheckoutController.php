<?php

namespace App\Http\Controllers;

use App\Models\DatTour;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang chọn phương thức thanh toán
     * GET /user/bookings/{booking}/checkout
     */
    public function show(Request $request, DatTour $booking)
    {
        // Kiểm tra quyền sở hữu booking
        if ($booking->id_khachhang !== (string) auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Nếu đã thanh toán, redirect sang result
        if ($booking->payment_status === 'paid') {
            $payment = $booking->latestPayment;
            if ($payment) {
                return redirect()->route('payment.result', $payment);
            }
        }

        return view('user.checkout.methods', compact('booking'));
    }
}
