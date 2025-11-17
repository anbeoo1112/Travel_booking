@extends('layouts.moldUser')

@section('content')
<div class="space-y-8">
    <x-ui.card class="max-w-2xl mx-auto">
        <div class="space-y-2 mb-8">
            <h1 class="text-3xl font-bold">Chọn phương thức thanh toán</h1>
            <p class="text-gray-600">
                Đơn hàng: <span class="font-semibold">#{{ $booking->id }}</span> 
                • <span class="font-semibold">{{ number_format($booking->tour->gia * $booking->so_nguoi, 0, ',', '.') }} ₫</span>
            </p>
        </div>

        <div class="space-y-4">
            <!-- PayOS VietQR -->
            <div class="border-2 border-primary/20 rounded-lg p-6 hover:border-primary hover:bg-primary/5 transition-all">
                <div class="flex items-start justify-between">
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4z"/>
                            </svg>
                            PayOS VietQR
                        </h2>
                        <p class="text-sm text-gray-600">
                            Quét mã QR bằng app ngân hàng. Xác nhận tự động qua webhook (1-3 phút).
                        </p>
                    </div>
                    <a 
                        href="{{ route('user.booking.pay.payos', $booking) }}" 
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors whitespace-nowrap"
                    >
                        Thanh toán ngay
                    </a>
                </div>
            </div>

            <!-- Momo -->
            <div class="border-2 border-pink-500/20 rounded-lg p-6 hover:border-pink-500 hover:bg-pink-500/5 transition-all">
                <form action="{{ route('momo.pay') }}" method="POST" class="flex items-start justify-between">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold flex items-center gap-2 text-pink-600">
                            <img src="https://developers.momo.vn/v3/vi/img/logo.svg" alt="Momo Logo" class="h-6">
                            Ví MoMo
                        </h2>
                        <p class="text-sm text-gray-600">
                            Thanh toán an toàn và nhanh chóng bằng ví điện tử MoMo.
                        </p>
                    </div>
                    <button 
                        type="submit"
                        class="px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-600/90 transition-colors whitespace-nowrap"
                    >
                        Thanh toán ngay
                    </button>
                </form>
            </div>

            <!-- Coming Soon Methods -->
            @foreach(['Thẻ tín dụng', 'Chuyển khoản ngân hàng'] as $method)
            <div class="border-2 border-gray-200 rounded-lg p-6 opacity-60 pointer-events-none bg-gray-50">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-600">{{ $method }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Sắp ra mắt</p>
                    </div>
                    <span class="px-3 py-1 bg-gray-300 text-gray-700 text-xs font-semibold rounded-full">
                        Coming soon
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Info Box -->
        <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-gray-700">
                <strong>💡 Ghi chú:</strong> Hệ thống sẽ tự động xác nhận thanh toán khi PayOS nhận được tiền từ ngân hàng của bạn. 
                Không cần admin duyệt.
            </p>
        </div>
    </x-ui.card>
</div>
@endsection
