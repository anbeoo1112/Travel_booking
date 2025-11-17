@extends('layouts.moldUser')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <x-ui.card class="max-w-2xl w-full">
        @if($payment->status === 'succeeded')
            <!-- Success State -->
            <div class="text-center space-y-6">
                <div class="flex justify-center">
                    <div class="relative w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-green-600">Thanh toán thành công!</h1>
                    <p class="text-gray-600">
                        Đơn đặt tour của bạn đã được xác nhận. Email xác nhận sẽ được gửi đến <strong>{{ $payment->booking->email }}</strong>
                    </p>
                </div>

                <!-- Order Details -->
                <div class="bg-gray-50 rounded-lg p-6 text-left space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mã đơn hàng:</span>
                        <span class="font-semibold">{{ $payment->booking->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tour:</span>
                        <span class="font-semibold">{{ $payment->booking->tour->ten_tour }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Số lượng khách:</span>
                        <span class="font-semibold">{{ $payment->booking->so_nguoi }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="font-semibold text-green-600">{{ $payment->booking->trang_thai_dattour }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-3">
                        <span class="text-gray-600 font-semibold">Tổng thanh toán:</span>
                        <span class="font-bold text-lg text-green-600">{{ number_format($payment->amount, 0, ',', '.') }} ₫</span>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2 text-left text-sm">
                    <p class="font-semibold text-blue-900">📋 Chi tiết thanh toán:</p>
                    <p class="text-blue-800"><strong>Phương thức:</strong> {{ $payment->gateway === 'momo' ? 'Ví MoMo' : 'PayOS VietQR' }}</p>
                    <p class="text-blue-800"><strong>Ngày thanh toán:</strong> {{ $payment->paid_at->format('d/m/Y H:i') }}</p>
                    <p class="text-blue-800"><strong>Mã giao dịch:</strong> <code class="bg-blue-100 px-2 py-1 rounded text-xs">{{ $payment->order_code }}</code></p>
                </div>

                <!-- Next Steps -->
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 space-y-2">
                    <p class="font-semibold text-amber-900">📧 Bước tiếp theo:</p>
                    <ul class="text-sm text-amber-800 space-y-1 ml-4 list-disc">
                        <li>Kiểm tra email xác nhận (kiểm tra cả thư spam)</li>
                        <li>Lưu file PDF hóa đơn để làm căn cứ</li>
                        <li>Tour đã được xác nhận tự động - không cần chờ duyệt</li>
                        <li>Chuẩn bị cho chuyến tour của bạn</li>
                    </ul>
                </div>

                <!-- Countdown -->
                <div class="text-center space-y-4">
                    <p class="text-gray-600">
                        Quay về trang chủ sau <span id="countdown" class="font-bold text-primary">10</span> giây...
                    </p>
                    <div class="flex gap-3 justify-center">
                        <a 
                            href="{{ route('lichSuDatTour') }}" 
                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors"
                        >
                            Xem lịch sử đặt tour
                        </a>
                        <a 
                            href="{{ url('/') }}" 
                            class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Về trang chủ
                        </a>
                    </div>
                </div>
            </div>

            <script>
                let seconds = 10;
                const countdownEl = document.getElementById('countdown');
                const interval = setInterval(() => {
                    seconds--;
                    countdownEl.textContent = seconds;
                    if (seconds <= 0) {
                        clearInterval(interval);
                        window.location.href = '{{ route("lichSuDatTour") }}';
                    }
                }, 1000);
            </script>

        @else
            <!-- Pending/Failed State -->
            <div class="text-center space-y-6">
                <div class="flex justify-center">
                    <div class="relative w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-yellow-600">Chưa xác nhận thanh toán</h1>
                    <p class="text-gray-600">
                        Hệ thống chưa nhận được xác nhận thanh toán từ ngân hàng. Vui lòng:
                    </p>
                </div>

                <ul class="text-left bg-gray-50 rounded-lg p-4 space-y-2 text-sm text-gray-700">
                    <li>✓ Kiểm tra lại kết nối mạng</li>
                    <li>✓ Quay lại trang thanh toán để kiểm tra trạng thái</li>
                    <li>✓ Liên hệ với chúng tôi nếu có vấn đề</li>
                </ul>

                <div class="flex gap-3">
                    <a 
                        href="{{ route('user.booking.pay.payos', $payment->booking) }}" 
                        class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-center"
                    >
                        Quay lại thanh toán
                    </a>
                    <a 
                        href="{{ url('/') }}" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center"
                    >
                        Trang chủ
                    </a>
                </div>
            </div>
        @endif
    </x-ui.card>
</div>
@endsection
