<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\Payment;
use App\Models\DatTour;
use App\Models\Tour;
use App\Models\NguoiDung;
use App\Models\LoaiTour;
use App\Jobs\SendInvoiceJob;
use App\Notifications\BookingPaidAdminNotification;

class PaymentWebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock notifications và queue
        Notification::fake();
        Queue::fake();

        // Set config cho test
        config(['services.payos.checksum_key' => 'test_checksum_key']);
        config(['services.business.admin_email' => 'admin@test.com']);
    }

    /**
     * Test webhook với signature không hợp lệ
     */
    public function test_webhook_rejects_invalid_signature(): void
    {
        $payload = [
            'code' => '00',
            'desc' => 'Thành công',
            'data' => [
                'orderCode' => 'ORDER_123',
                'amount' => 1000000,
                'signature' => 'invalid_signature',
            ],
        ];

        $response = $this->postJson('/payments/webhook/payos', $payload);

        $response->assertStatus(400);
        $this->assertEquals('Invalid signature', $response->getContent());
    }

    /**
     * Test webhook với order không tồn tại
     */
    public function test_webhook_handles_order_not_found(): void
    {
        $payload = $this->createValidPayload('NONEXISTENT_ORDER', 1000000);

        $response = $this->postJson('/payments/webhook/payos', $payload);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true, 'message' => 'Order not found']);
    }

    /**
     * Test webhook với số tiền không khớp
     */
    public function test_webhook_rejects_amount_mismatch(): void
    {
        // Tạo booking và payment
        $booking = $this->createBooking();
        $payment = $this->createPayment($booking, 1000000);

        // Gửi webhook với số tiền khác
        $payload = $this->createValidPayload($payment->order_code, 2000000);

        $response = $this->postJson('/payments/webhook/payos', $payload);

        $response->assertStatus(400);

        // Kiểm tra payment không được cập nhật
        $payment->refresh();
        $this->assertEquals('pending', $payment->status);
    }

    /**
     * Test webhook thành công
     */
    public function test_webhook_processes_successful_payment(): void
    {
        // Tạo booking và payment
        $booking = $this->createBooking();
        $payment = $this->createPayment($booking, 1000000);

        // Gửi webhook hợp lệ
        $payload = $this->createValidPayload($payment->order_code, 1000000);

        $response = $this->postJson('/payments/webhook/payos', $payload);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        // Kiểm tra payment được cập nhật
        $payment->refresh();
        $this->assertEquals('succeeded', $payment->status);
        $this->assertTrue($payment->signature_valid);
        $this->assertNotNull($payment->paid_at);

        // Kiểm tra booking được cập nhật
        $booking->refresh();
        $this->assertEquals('paid', $booking->payment_status);

        // Kiểm tra job được dispatch
        Queue::assertPushed(SendInvoiceJob::class);

        // Kiểm tra notification được gửi
        Notification::assertSentTo(
            Notification::route('mail', 'admin@test.com'),
            BookingPaidAdminNotification::class
        );
    }

    /**
     * Test idempotency - không xử lý lại nếu đã succeeded
     */
    public function test_webhook_is_idempotent(): void
    {
        // Tạo booking và payment đã succeeded
        $booking = $this->createBooking();
        $payment = $this->createPayment($booking, 1000000);
        $payment->update(['status' => 'succeeded', 'paid_at' => now()]);
        $booking->update(['payment_status' => 'paid']);

        // Gửi webhook lại
        $payload = $this->createValidPayload($payment->order_code, 1000000);

        Queue::fake(); // Reset queue để đếm lại

        $response = $this->postJson('/payments/webhook/payos', $payload);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true, 'message' => 'Already processed']);

        // Kiểm tra job KHÔNG được dispatch lại
        Queue::assertNotPushed(SendInvoiceJob::class);
    }

    /**
     * Helper: Tạo payload hợp lệ với signature
     */
    private function createValidPayload($orderCode, $amount): array
    {
        $data = [
            'orderCode' => $orderCode,
            'amount' => $amount,
            'description' => 'Thanh toán tour',
            'transactionId' => 'TXN_' . time(),
        ];

        // Tính signature
        ksort($data);
        $message = collect($data)->map(fn($v, $k) => $k . '=' . $v)->implode('&');
        $signature = hash_hmac('sha256', $message, config('services.payos.checksum_key'));

        return [
            'code' => '00',
            'desc' => 'Thành công',
            'data' => array_merge($data, ['signature' => $signature]),
        ];
    }

    /**
     * Helper: Tạo booking
     */
    private function createBooking(): DatTour
    {
        // Tạo loại tour
        $loaiTour = LoaiTour::create([
            'id' => 'LOAI_' . time(),
            'ten_loaitour' => 'Tour Test',
            'slug' => 'tour-test',
        ]);

        // Tạo user
        $user = NguoiDung::create([
            'id' => 'USER_' . time(),
            'ho_ten' => 'Test User',
            'email' => 'user@test.com',
            'mat_khau' => bcrypt('password'),
            'so_dien_thoai' => '0123456789',
            'vai_tro' => 'Khách Hàng',
        ]);

        // Tạo tour
        $tour = Tour::create([
            'id' => 'TOUR_' . time(),
            'ten_tour' => 'Test Tour',
            'slug' => 'test-tour',
            'gia' => 1000000,
            'mo_ta' => 'Test description',
            'id_LoaiTour' => $loaiTour->id,
            'thoigian_tour' => '3 ngày 2 đêm',
        ]);

        // Tạo booking
        return DatTour::create([
            'id' => 'BOOKING_' . time(),
            'id_khachhang' => $user->id,
            'id_tour' => $tour->id,
            'ho_ten' => 'Test User',
            'email' => 'user@test.com',
            'so_dien_thoai' => '0123456789',
            'so_nguoi' => 2,
            'ngay_di' => now()->addDays(30),
            'trang_thai_dattour' => 'Chờ xác nhận',
            'payment_status' => 'unpaid',
            'ngay_dat_tour' => now(),
        ]);
    }

    /**
     * Helper: Tạo payment
     */
    private function createPayment($booking, $amount): Payment
    {
        return Payment::create([
            'booking_id' => $booking->id,
            'gateway' => 'payos',
            'order_code' => 'ORDER_' . time(),
            'amount' => $amount,
            'currency' => 'VND',
            'status' => 'pending',
        ]);
    }
}
