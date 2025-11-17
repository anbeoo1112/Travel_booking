@extends('layouts.moldUser')

@section('content')
@php
    $selectedCategories = collect(request()->input('the_loai', []))->map(fn ($id) => (int) $id)->all();
@endphp

<div class="flex flex-col gap-16">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary/20 via-accent/15 to-primary/30 px-6 py-20 shadow-inner sm:px-10 lg:px-16">
        <div class="absolute inset-0 -z-10 bg-[url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&w=1400&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="mx-auto flex max-w-5xl flex-col gap-8 text-center lg:text-left">
            <span class="inline-flex items-center self-center rounded-full bg-primary/15 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary lg:self-start" x-text="$store.uiTheme.t('news_listing_badge')">Hanoitourist</span>
            <div class="space-y-5">
                <h1 class="text-3xl font-bold leading-tight text-base-content sm:text-4xl" x-text="$store.uiTheme.t('news_listing_hero_title')">Tin tức du lịch mới nhất</h1>
                <p class="text-base text-base-content/70" x-text="$store.uiTheme.t('news_listing_hero_description')">Cập nhật xu hướng điểm đến, kinh nghiệm hành trình và ưu đãi hấp dẫn để bạn luôn dẫn đầu xu hướng dịch chuyển.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3 text-sm text-base-content/70 lg:justify-start" x-data="{ articleCount: {{ $trangTinTucs->count() }}, categoryCount: {{ $theLoais->count() }} }">
                <span class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow" x-text="$store.uiTheme.format('news_listing_showing', { count: articleCount })">{{ $trangTinTucs->count() }} bài viết đang hiển thị</span>
                <span class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow" x-text="$store.uiTheme.format('news_listing_categories', { count: categoryCount })">{{ $theLoais->count() }} chủ đề du lịch</span>
                <a href="#loc-tin-tuc" class="inline-flex items-center gap-2 text-primary font-semibold">
                    <span x-text="$store.uiTheme.t('news_listing_explore_filters')">Khám phá bộ lọc</span><span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <section id="loc-tin-tuc" class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[320px_1fr]">
            <x-ui.card class="space-y-6 border border-base-200/80 bg-base-100/90 shadow-lg">
                <form id="category-filter-form" class="space-y-5">
                    <div class="space-y-2">
                        <h2 class="text-lg font-semibold text-base-content" x-text="$store.uiTheme.t('news_listing_filter_title')">Lọc theo thể loại</h2>
                        <p class="text-sm text-base-content/70" x-text="$store.uiTheme.t('news_listing_filter_description')">Chọn chủ đề bạn quan tâm để xem bài viết phù hợp.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($theLoais as $theLoai)
                            @php
                                $checked = in_array($theLoai->id, $selectedCategories, true);
                            @endphp
                            <label class="inline-flex items-center gap-2 rounded-full border border-base-200 px-3 py-2 text-sm font-medium text-base-content/80 transition hover:border-primary/50 hover:text-primary">
                                <input type="checkbox" name="the_loai[]" value="{{ $theLoai->id }}" class="checkbox checkbox-xs checkbox-primary" {{ $checked ? 'checked' : '' }}>
                                <span>{{ $theLoai->ten_the_loai }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.button type="button" id="apply-filter" variant="primary" class="flex-1 justify-center">
                            <span x-text="$store.uiTheme.t('news_listing_apply')">Áp dụng</span>
                        </x-ui.button>
                        <x-ui.button type="button" id="reset-filter" variant="ghost" class="justify-center">
                            <span x-text="$store.uiTheme.t('news_listing_reset')">Bỏ chọn</span>
                        </x-ui.button>
                    </div>
                </form>
            </x-ui.card>

            <div class="space-y-8">
                <div class="space-y-2 text-center lg:text-left">
                    <h2 class="text-2xl font-semibold text-base-content" x-text="$store.uiTheme.t('news_listing_featured_title')">Tin tức nổi bật</h2>
                    <p class="text-sm text-base-content/70" x-text="$store.uiTheme.t('news_listing_featured_description')">Cập nhật những câu chuyện được quan tâm nhiều nhất trong tuần.</p>
                </div>

                <div id="newsContent" class="grid gap-6 lg:grid-cols-2">
                    @forelse($trangTinTucs as $trangTinTuc)
                        <x-ui.card hover class="flex h-full flex-col overflow-hidden p-0">
                            <a href="{{ route('showTinTuc', $trangTinTuc->slug) }}" class="block">
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" alt="{{ $trangTinTuc->tieu_de }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                </div>
                            </a>
                            <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-5">
                                <div class="flex items-center gap-3 text-xs font-medium text-base-content/60">
                                    <span>{{ date('d/m/Y', strtotime($trangTinTuc->created_at)) }}</span>
                                    <span class="inline-flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $trangTinTuc->doc }} <span x-text="$store.uiTheme.t('home_news_views')">lượt xem</span>
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-base-content">
                                    <a href="{{ route('showTinTuc', $trangTinTuc->slug) }}" class="transition hover:text-primary">{{ $trangTinTuc->tieu_de }}</a>
                                </h3>
                                <p class="text-sm text-base-content/70" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $trangTinTuc->noidung_rutgon }}</p>
                                <div class="mt-auto">
                                    <x-ui.button href="{{ route('showTinTuc', $trangTinTuc->slug) }}" variant="ghost" class="px-0 text-primary">
                                        <span x-text="$store.uiTheme.t('home_read_more')">Đọc tiếp</span>
                                    </x-ui.button>
                                </div>
                            </div>
                        </x-ui.card>
                    @empty
                        <div class="lg:col-span-2">
                            <x-ui.empty title-key="news_listing_empty_title" description-key="news_listing_empty_description" />
                        </div>
                    @endforelse
                </div>

                @if(method_exists($trangTinTucs, 'links'))
                    <div class="pt-6">
                        {{ $trangTinTucs->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@push('script-alt')
    <script>
        const form = document.getElementById('category-filter-form');
        const applyBtn = document.getElementById('apply-filter');
        const resetBtn = document.getElementById('reset-filter');

        applyBtn.addEventListener('click', () => {
            const url = new URL(window.location.href);
            url.search = new URLSearchParams(new FormData(form)).toString();
            window.location.href = url.toString();
        });

        resetBtn.addEventListener('click', () => {
            form.reset();
            const url = new URL(window.location.href);
            url.search = '';
            window.location.href = url.toString();
        });
    </script>
@endpush