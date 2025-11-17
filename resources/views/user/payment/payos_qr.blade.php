@extends('layouts.moldUser')

@section('content')
<div class="space-y-8">
    <x-ui.card class="max-w-xl mx-auto">
        <div class="space-y-2 mb-8 text-center">
            <h1 class="text-3xl font-bold">Thanh toán qua VietQR</h1>
            <p class="text-gray-600">
                Đơn #<span class="font-semibold">{{ $booking->id }}</span> 
                • <span class="font-semibold">{{ number_format($payment->amount, 0, ',', '.') }} ₫</span>
            </p>
        </div>

        <div x-data="paymentUI()" x-init="init()" class="space-y-6">
            <!-- QR Code -->
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-2xl shadow-lg border-4 border-primary/10">
                    <img 
                        :src="qrUrl" 
                        alt="QR Code thanh toán" 
                        class="w-72 h-72 rounded-xl"
                        x-show="qrUrl"
                    />
                    <div x-show="!qrUrl" class="w-72 h-72 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 animate-spin mx-auto mb-2 text-primary" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <p class="text-sm text-gray-600">Đang tải mã QR...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Message -->
            <div class="text-center space-y-2">
                <p class="text-lg font-semibold" x-text="statusMessage"></p>
                <p class="text-sm text-gray-600" x-show="status === 'pending'">
                    Quét mã QR bằng ứng dụng ngân hàng để thanh toán
                </p>
            </div>

            <!-- Instructions -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 space-y-2">
                <p class="font-semibold text-amber-900 text-sm">📝 Hướng dẫn thanh toán:</p>
                <ol class="text-sm text-amber-800 space-y-1 ml-4 list-decimal">
                    <li>Mở ứng dụng ngân hàng trên điện thoại</li>
                    <li>Chọn "Quét mã QR" hoặc "Chuyển khoản"</li>
                    <li>Quét mã bên trên</li>
                    <li>Xác nhận và gửi yêu cầu</li>
                    <li><strong>KHÔNG TẮT TRANG NÀY</strong> - Chúng tôi đang chờ xác nhận từ ngân hàng</li>
                </ol>
            </div>

            <!-- Countdown or Manual Check -->
            <div class="flex gap-3">
                <button 
                    @click="checkStatus()" 
                    class="flex-1 px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90 transition-colors"
                >
                    Kiểm tra trạng thái
                </button>
                <a 
                    href="{{ route('user.booking.checkout', $booking) }}" 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center"
                >
                    Quay lại
                </a>
            </div>

            <!-- Auto-check info -->
            <p class="text-xs text-gray-500 text-center">
                ✓ Chúng tôi sẽ tự động kiểm tra trạng thái mỗi 2 giây
            </p>
        </div>
    </x-ui.card>
</div>

<script>
function paymentUI() {
    return {
        paymentId: '{{ $payment->id }}',
        qrUrl: '',
        status: 'pending',
        statusMessage: 'Đang tải mã QR...',
        pollInterval: null,

        async init() {
            try {
                const response = await fetch('{{ route("api.payments.payos.start", $booking) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                if (!response.ok) {
                    const error = await response.json();
                    console.error('API Error:', error);
                    throw new Error(error.message || 'Failed to initialize payment');
                }

                const data = await response.json();
                console.log('API Success:', data);
                this.qrUrl = data.qr_data;
                this.paymentId = data.payment_id;

                // Start polling
                this.startPolling();
            } catch (error) {
                console.error('Init error:', error);
                this.statusMessage = '❌ Lỗi: ' + error.message;
            }
        },

        startPolling() {
            this.pollInterval = setInterval(() => this.checkStatus(), 2000);

            // Auto stop after 10 minutes
            setTimeout(() => {
                if (this.pollInterval) {
                    clearInterval(this.pollInterval);
                }
            }, 600000);
        },

        async checkStatus() {
            try {
                const response = await fetch(`/api/payments/${this.paymentId}/status`, {
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                if (response.status === 401) {
                    // User logged out
                    window.location.href = '{{ route("login") }}';
                    return;
                }

                const data = await response.json();
                this.status = data.status;

                if (data.status === 'succeeded') {
                    this.statusMessage = '✅ Thanh toán thành công!';
                    clearInterval(this.pollInterval);
                    setTimeout(() => {
                        window.location.href = `{{ route('payment.result', ['payment' => '__ID__']) }}`.replace('__ID__', this.paymentId);
                    }, 1000);
                } else if (data.status === 'failed' || data.status === 'canceled') {
                    this.statusMessage = '❌ Thanh toán thất bại. Vui lòng thử lại.';
                    clearInterval(this.pollInterval);
                } else {
                    this.statusMessage = '⏳ Đang chờ xác nhận từ ngân hàng...';
                }
            } catch (error) {
                console.error('Status check error:', error);
            }
        },
    };
}
</script>
@endsection
