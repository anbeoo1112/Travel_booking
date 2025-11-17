<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\DatTour;
use App\Models\Payment;
use App\Mail\BillDatTourMail;

class SendInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $bookingId;
    public $paymentId;

    /**
     * Create a new job instance.
     */
    public function __construct($bookingId, $paymentId)
    {
        $this->bookingId = $bookingId;
        $this->paymentId = $paymentId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $booking = DatTour::find($this->bookingId);
            $payment = Payment::find($this->paymentId);

            if (!$booking || !$payment) {
                Log::error('SendInvoiceJob: Booking or Payment not found', [
                    'booking_id' => $this->bookingId,
                    'payment_id' => $this->paymentId,
                ]);
                return;
            }

            // Lấy hóa đơn nếu có
            $hoaDon = $booking->hoaDon()->first();

            if (!$hoaDon) {
                Log::warning('SendInvoiceJob: No invoice found for booking', [
                    'booking_id' => $this->bookingId,
                ]);
                return;
            }

            // Gửi email hóa đơn cho khách hàng
            // BillDatTourMail($hoadon, $pdfPath, $payment)
            Mail::to($booking->email)->send(new BillDatTourMail($hoaDon, null, $payment));

            Log::info('SendInvoiceJob: Invoice email sent successfully', [
                'booking_id' => $this->bookingId,
                'email' => $booking->email,
            ]);
        } catch (\Exception $e) {
            Log::error('SendInvoiceJob: Failed to send invoice email', [
                'booking_id' => $this->bookingId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Retry job nếu chưa quá số lần thử
            if ($this->attempts() < 3) {
                $this->release(60); // Retry sau 60 giây
            }
        }
    }
}
