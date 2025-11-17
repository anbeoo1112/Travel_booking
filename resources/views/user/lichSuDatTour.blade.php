@extends('layouts.moldMain-User')

@section('content-min')
@php
    $statusColors = [
        'Đã Hủy' => 'badge-error',
        'Đã Xác Nhận' => 'badge-success',
        'Đang Xử Lý' => 'badge-warning',
        'Chờ xác nhận' => 'badge-info',
    ];
@endphp

<div class="space-y-8">
    <div class="space-y-2">
        <h1 class="text-2xl font-semibold text-base-content">Lịch sử đặt tour</h1>
        <p class="text-sm text-base-content/70">Theo dõi tất cả booking của bạn và chủ động quản lý lịch trình.</p>
    </div>

    <x-ui.card class="space-y-5">
        <form id="search-form" method="GET" action="{{ route('lichSuDatTour') }}" class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-ui.input
                name="keyword"
                label="Tìm kiếm"
                placeholder="Nhập tên tour hoặc trạng thái"
                value="{{ request('keyword') }}"
                class="sm:max-w-sm"
            />
            <div class="flex flex-wrap gap-3">
                <x-ui.button type="submit" variant="primary" class="justify-center">Tìm kiếm</x-ui.button>
                <x-ui.button href="{{ route('lichSuDatTour') }}" variant="ghost" class="justify-center">Xóa lọc</x-ui.button>
            </div>
        </form>
    </x-ui.card>

    <x-ui.card class="p-0">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-base-200/60 text-xs uppercase tracking-wide text-base-content/70">
                    <tr>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Tour</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Thông tin liên hệ</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Lịch trình</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Tổng giá</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Trạng thái</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-sm">
                    @forelse ($datTours as $datTour)
                        <tr class="hover:bg-base-200/40">
                            <td class="px-6 py-4 align-top">
                                <div class="flex flex-col gap-1">
                                    <p class="font-semibold text-base-content">{{ $datTour->tour->ten_tour }}</p>
                                    <p class="text-xs text-base-content/60">Khởi hành: {{ $datTour->tour->noi_khoi_hanh }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <div class="space-y-1 text-xs text-base-content/70">
                                    <p>Họ tên: <span class="font-medium text-base-content">{{ $datTour->ho_ten }}</span></p>
                                    <p>Email: {{ $datTour->email }}</p>
                                    <p>Điện thoại: {{ $datTour->so_dien_thoai }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <div class="space-y-1 text-xs text-base-content/70">
                                    <p>Số người: <span class="font-medium text-base-content">{{ $datTour->so_nguoi }}</span></p>
                                    <p>Ngày đi: {{ $datTour->ngay_di }}</p>
                                    <p>Ngày đặt: {{ $datTour->ngay_dat_tour }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <p class="font-semibold text-base-content">{{ number_format($datTour->tour->gia * $datTour->so_nguoi) }} VNĐ</p>
                                <p class="text-xs text-base-content/60">Giá tour: {{ number_format($datTour->tour->gia) }} VNĐ/người</p>
                            </td>
                            <td class="px-6 py-4 align-top">
                                @php
                                    $badgeClass = $statusColors[$datTour->trang_thai_dattour] ?? 'badge-ghost';
                                @endphp
                                <div class="flex flex-col gap-2">
                                    <span class="badge {{ $badgeClass }} badge-outline px-3 py-2 text-xs font-semibold uppercase">
                                        {{ $datTour->trang_thai_dattour }}
                                    </span>
                                    @if($datTour->payment_status)
                                        <span class="badge {{ $datTour->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }} badge-outline px-2 py-1 text-xs font-semibold">
                                            @if($datTour->payment_status === 'paid')
                                                ✓ Đã thanh toán
                                            @elseif($datTour->payment_status === 'unpaid')
                                                ⏳ Chưa thanh toán
                                            @else
                                                🔄 {{ ucfirst($datTour->payment_status) }}
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <div class="flex flex-wrap gap-2">
                                    @if($datTour->trang_thai_dattour === 'Chờ xác nhận' && $datTour->payment_status === 'unpaid')
                                        <a 
                                            href="{{ route('user.booking.checkout', $datTour) }}"
                                            class="btn btn-sm btn-primary text-xs font-semibold"
                                            title="Thanh toán ngay"
                                        >
                                            💳 Thanh toán
                                        </a>
                                    @endif
                                    @include('user.huyDatTour', ['buttonClass' => 'btn btn-sm btn-error text-xs font-semibold', 'disabledClass' => 'btn-disabled'])
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12">
                                <x-ui.empty title="Chưa có tour nào" description="Khi bạn đặt tour, thông tin sẽ hiển thị ở đây để dễ dàng theo dõi và quản lý." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($datTours, 'links'))
            <div class="border-t border-base-200 px-6 py-4">
                {{ $datTours->links('pagination::tailwind') }}
            </div>
        @endif
    </x-ui.card>
</div>
@endsection