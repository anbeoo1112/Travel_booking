@extends('layouts.moldUser')

@section('content')
@php
    $selectedLoai = collect(request()->input('loai_tour', []))->map(fn ($id) => (int) $id)->all();
@endphp

<div class="flex flex-col gap-16">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary/20 via-accent/20 to-primary/30 px-6 py-20 shadow-inner sm:px-10 lg:px-16 dark:from-primary/25 dark:via-secondary/15 dark:to-base-200/60">
        <div class="absolute inset-0 -z-10 bg-[url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&w=1400&q=80')] bg-cover bg-center opacity-20 dark:opacity-25"></div>
        <div class="mx-auto flex max-w-5xl flex-col gap-10 text-center lg:text-left">
            <span class="inline-flex items-center self-center rounded-full bg-primary/15 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary lg:self-start">Hanoitourist</span>
            <div class="space-y-5">
                <h1 class="text-3xl font-bold leading-tight text-base-content sm:text-4xl lg:text-5xl">Khám phá bộ sưu tập tour du lịch</h1>
                <p class="text-base text-base-content/75 lg:max-w-3xl">Chọn lọc hành trình phù hợp nhất với sở thích của bạn. Lọc theo loại hình, ngân sách và thời gian để tìm tour mơ ước chỉ trong vài bước.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-base-content/70 lg:justify-start">
                <div class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow dark:bg-base-100/60">Có {{ $tours->count() }} tour phù hợp</div>
                <div class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow dark:bg-base-100/60">{{ $loaiTours->count() }} loại hình trải nghiệm</div>
                <a href="#bo-loc-tour" class="inline-flex items-center gap-2 text-primary font-semibold">Tới bộ lọc<span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </section>

    <section id="bo-loc-tour" class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[320px_1fr]">
            <x-ui.card class="h-full border border-base-200/80 bg-base-100/90 shadow-lg dark:border-base-200/40 dark:bg-base-200/70">
                <form action="{{ route('tim-kiem-tour') }}" method="GET" class="flex flex-col gap-6">
                    <div class="space-y-2">
                        <h2 class="text-lg font-semibold text-base-content">Bộ lọc tìm kiếm</h2>
                        <p class="text-sm text-base-content/70">Tùy chỉnh tiêu chí để tìm tour đúng nhu cầu của bạn.</p>
                    </div>

                    <div class="space-y-3">
                        <p class="text-sm font-semibold text-base-content">Loại hình du lịch</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($loaiTours as $loaiTour)
                                @php
                                    $isChecked = in_array($loaiTour->id, $selectedLoai, true);
                                @endphp
                                <label class="inline-flex items-center gap-2 rounded-full border border-base-200 px-3 py-2 text-sm font-medium text-base-content/80 transition hover:border-primary/50 hover:text-primary">
                                    <input type="checkbox" name="loai_tour[]" value="{{ $loaiTour->id }}" class="checkbox checkbox-xs checkbox-primary" {{ $isChecked ? 'checked' : '' }}>
                                    <span>{{ $loaiTour->ten_loaitour }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <x-ui.input
                        name="ten_tour"
                        label="Tên tour du lịch"
                        placeholder="Ví dụ: Phú Quốc 4N3D"
                        value="{{ request('ten_tour') }}"
                    />

                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.input
                            name="min_price"
                            label="Giá tối thiểu"
                            type="number"
                            min="0"
                            placeholder="Từ"
                            value="{{ request('min_price') }}"
                        />
                        <x-ui.input
                            name="max_price"
                            label="Giá tối đa"
                            type="number"
                            min="0"
                            placeholder="Đến"
                            value="{{ request('max_price') }}"
                        />
                    </div>

                    <x-ui.input
                        name="thoigian_tour"
                        label="Thời gian tour"
                        placeholder="Ví dụ: 3N2D"
                        value="{{ request('thoigian_tour') }}"
                    />

                    <div class="flex flex-wrap gap-3">
                        <x-ui.button type="submit" variant="primary" class="flex-1 justify-center">Áp dụng bộ lọc</x-ui.button>
                        <x-ui.button type="reset" variant="ghost" class="justify-center" onclick="this.form.reset();">Xóa</x-ui.button>
                    </div>
                </form>
            </x-ui.card>

            <div class="space-y-6">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-base-content">Danh sách tour</h2>
                        <p class="text-sm text-base-content/70">Hiển thị {{ $tours->count() }} kết quả theo tiêu chí hiện tại.</p>
                    </div>
                    <x-ui.button href="{{ route('tourDuLich') }}" variant="ghost" class="justify-center">Tải lại tất cả tour</x-ui.button>
                </div>

                @if($tours->isEmpty())
                    <x-ui.empty title="Chưa tìm thấy tour phù hợp" description="Hãy thử điều chỉnh bộ lọc hoặc liên hệ đội ngũ tư vấn để được gợi ý hành trình riêng." />
                @else
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($tours as $tour)
                            <x-ui.card hover class="flex h-full flex-col overflow-hidden p-0">
                                <a href="{{ route('showTourDuLich', $tour->slug) }}" class="block">
                                    <div class="aspect-[4/3] overflow-hidden">
                                        <img
                                            src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}"
                                            alt="Hình ảnh tour {{ $tour->ten_tour }}"
                                            class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                        >
                                    </div>
                                </a>
                                <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-5">
                                    <div class="flex items-center justify-between text-sm font-semibold">
                                        <span class="rounded-full bg-primary/15 px-3 py-1 text-primary/90">{{ $tour->noi_khoi_hanh }}</span>
                                        <span class="text-base-content">{{ number_format($tour->gia) }} VNĐ</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-base-content">
                                        <a href="{{ route('showTourDuLich', $tour->slug) }}" class="transition hover:text-primary">{{ $tour->ten_tour }}</a>
                                    </h3>
                                    <p class="text-sm text-base-content/70">Thời gian {{ $tour->thoigian_tour }} với lịch trình cân bằng giữa nghỉ dưỡng và khám phá.</p>
                                    <div class="mt-auto flex items-center justify-between text-xs font-medium text-base-content/60">
                                        <span>Hành trình linh hoạt</span>
                                        <span>Xem chi tiết &rarr;</span>
                                    </div>
                                </div>
                            </x-ui.card>
                        @endforeach
                    </div>

                    @if(method_exists($tours, 'links'))
                        <div class="pt-6">
                            {{ $tours->links('pagination::tailwind') }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
</div>
@endsection