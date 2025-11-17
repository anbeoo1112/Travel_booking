<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DatTour;

class BookingPaidAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $bookingId;

    /**
     * Create a new notification instance.
     */
    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $booking = DatTour::with(['tour', 'latestPayment'])->find($this->bookingId);

        if (!$booking) {
            return (new MailMessage)
                ->subject('Thông báo thanh toán')
                ->line('Không tìm thấy thông tin đặt tour.');
        }

        $payment = $booking->latestPayment;
        $tour = $booking->tour;

        return (new MailMessage)
            ->subject('🎉 Có đơn đặt tour mới đã thanh toán')
            ->greeting('Xin chào Admin!')
            ->line('Có một đơn đặt tour mới đã được thanh toán thành công.')
            ->line('**Thông tin đặt tour:**')
            ->line('Mã đặt tour: **' . $booking->id . '**')
            ->line('Khách hàng: **' . $booking->ho_ten . '**')
            ->line('Email: ' . $booking->email)
            ->line('Số điện thoại: ' . $booking->so_dien_thoai)
            ->line('Tour: **' . ($tour->ten_tour ?? 'N/A') . '**')
            ->line('Số người: ' . $booking->so_nguoi)
            ->line('Ngày đi: ' . date('d/m/Y', strtotime($booking->ngay_di)))
            ->line('Số tiền: **' . number_format($payment->amount ?? 0, 0, ',', '.') . ' VNĐ**')
            ->line('Trạng thái: **Đã thanh toán**')
            ->action('Xem chi tiết', url('/quanlydattour'))
            ->line('Vui lòng kiểm tra và xử lý đơn đặt tour.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->bookingId,
        ];
    }
}
