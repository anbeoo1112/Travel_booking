@extends('layouts.moldUser')

@section('content')

<div class="flex flex-col gap-16">
    <section class="relative overflow-hidden rounded-3xl bg-neutral text-neutral-content">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" alt="{{ $trangTinTuc->tieu_de }}" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-neutral/90 via-neutral/70 to-neutral/40"></div>
        </div>
        <div class="relative mx-auto flex max-w-4xl flex-col gap-4 px-6 py-24 text-center sm:px-8 lg:px-12">
            <span class="inline-flex items-center justify-center gap-2 self-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em]">Hanoitourist Blog</span>
            <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">{{ $trangTinTuc->tieu_de }}</h1>
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-white/80">
                <span>Ngày đăng: {{ date('d/m/Y', strtotime($trangTinTuc->created_at)) }}</span>
                <span>Lượt xem: {{ $trangTinTuc->doc }}</span>
            </div>
        </div>
    </section>

    <section class="mx-auto flex w-full max-w-6xl flex-col gap-12 px-4 sm:px-6 lg:px-8 lg:flex-row">
        <article class="flex-1 space-y-8">
            <x-ui.card class="space-y-6 bg-base-100/90">
                <div class="prose max-w-none text-base-content [&_*]:leading-relaxed">
                    {!! $trangTinTuc->mo_ta !!}
                </div>
                <div class="flex flex-wrap gap-4 text-sm text-base-content/70">
                    <span>Ngày đăng: {{ date('d/m/Y', strtotime($trangTinTuc->created_at)) }}</span>
                    <span>Lượt xem: {{ $trangTinTuc->doc }}</span>
                </div>
            </x-ui.card>

            <x-ui.card class="space-y-4 bg-base-100/90">
                <h2 class="text-xl font-semibold text-base-content">Chia sẻ bài viết</h2>
                <p class="text-sm text-base-content/70">Lan tỏa cảm hứng du lịch đến bạn bè của bạn.</p>
                <div class="flex flex-wrap gap-3">
                    <x-ui.button variant="ghost" class="btn-sm">Facebook</x-ui.button>
                    <x-ui.button variant="ghost" class="btn-sm">Zalo</x-ui.button>
                    <x-ui.button variant="ghost" class="btn-sm">Email</x-ui.button>
                </div>
            </x-ui.card>
        </article>

        <aside class="w-full max-w-md space-y-6">
            <x-ui.card class="space-y-4 border border-base-200/80 bg-base-100/90">
                <h3 class="text-lg font-semibold text-base-content">Tour phổ biến</h3>
                <div class="space-y-4">
                    @foreach($tours as $tour)
                        <x-ui.card hover class="flex items-center gap-4 p-3">
                            <div class="h-16 w-16 overflow-hidden rounded-xl">
                                <img src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}" alt="{{ $tour->ten_tour }}" class="h-full w-full object-cover">
                            </div>
                            <div class="flex flex-1 flex-col gap-1">
                                <a href="{{ route('showTourDuLich', $tour->slug) }}" class="text-sm font-semibold text-base-content transition hover:text-primary">{{ $tour->ten_tour }}</a>
                                <p class="text-xs text-base-content/60">{{ $tour->thoigian_tour }} - {{ $tour->noi_khoi_hanh }}</p>
                                <p class="text-xs font-semibold text-primary">{{ number_format($tour->gia) }} VNĐ</p>
                            </div>
                        </x-ui.card>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card class="space-y-4 bg-base-100/90">
                <h3 class="text-lg font-semibold text-base-content">Nhận bản tin</h3>
                <p class="text-sm text-base-content/70">Bạn sẽ nhận được email mỗi tuần về ưu đãi, mẹo du lịch và xu hướng mới.</p>
                <form class="space-y-3">
                    <x-ui.input name="newsletter_email" type="email" placeholder="you@example.com" />
                    <x-ui.button type="submit" variant="primary" class="w-full justify-center">Đăng ký</x-ui.button>
                </form>
            </x-ui.card>
        </aside>
    </section>

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 text-center">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-primary">Tin tức liên quan</span>
            <h2 class="text-3xl font-bold text-base-content">Có thể bạn sẽ thích</h2>
            <p class="text-base text-base-content/70">Khám phá thêm các câu chuyện hấp dẫn để lên ý tưởng cho hành trình tiếp theo.</p>
        </div>
        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @foreach($relatedBlogs as $relatedBlog)
                <x-ui.card hover class="flex h-full flex-col overflow-hidden p-0">
                    <a href="{{ route('showTinTuc', $relatedBlog->slug) }}" class="block">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('storage/' . $relatedBlog->hinh_anh) }}" alt="{{ $relatedBlog->tieu_de }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-5">
                        <div class="flex items-center gap-3 text-xs font-medium text-base-content/60">
                            <span>{{ date('d/m/Y', strtotime($relatedBlog->created_at)) }}</span>
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $relatedBlog->doc }} lượt xem
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-base-content">
                            <a href="{{ route('showTinTuc', $relatedBlog->slug) }}" class="transition hover:text-primary">{{ $relatedBlog->tieu_de }}</a>
                        </h3>
                        <p class="text-sm text-base-content/70" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $relatedBlog->noidung_rutgon }}</p>
                        <div class="mt-auto">
                            <x-ui.button href="{{ route('showTinTuc', $relatedBlog->slug) }}" variant="ghost" class="px-0 text-primary">Đọc tiếp</x-ui.button>
                        </div>
                    </div>
                </x-ui.card>
            @endforeach
        </div>
    </section>
</div>
@endsection