@extends('layouts.moldUser')

@section('content')
<div class="flex flex-col gap-20">
    @php
        $featuredTours = collect($tours)->take(6);
        $featuredArticles = collect($trangTinTucs)->take(3);
    @endphp

    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary/20 via-accent/10 to-primary/30 px-6 pb-24 pt-20 shadow-inner sm:px-10 lg:px-16">
        <div class="absolute inset-0 -z-10 bg-[url('https://images.unsplash.com/photo-1505761671935-60b3a7427bad?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center opacity-10"></div>
        <div class="mx-auto flex max-w-5xl flex-col gap-12 lg:flex-row lg:items-center">
            <div class="flex-1 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center rounded-full bg-primary/15 px-4 py-1 text-sm font-semibold text-primary">Trải nghiệm nhiệt đới sống động</span>
                <h1 class="text-3xl font-bold tracking-tight text-base-content sm:text-4xl lg:text-5xl">Khám phá hành trình mơ ước cùng Hanoitourist</h1>
                <p class="text-base leading-relaxed text-base-content/80 lg:max-w-xl">Từ biển xanh nắng vàng đến cao nguyên lộng gió, chúng tôi chọn lọc những hành trình đặc sắc nhất để bạn tận hưởng kỳ nghỉ trọn vẹn, an toàn và giàu cảm hứng.</p>
                <div class="flex flex-wrap items-center justify-center gap-4 lg:justify-start">
                    <x-ui.button href="{{ route('tourDuLich') }}" variant="primary" size="lg">Khám phá tour</x-ui.button>
                    <x-ui.button href="{{ route('tintuc') }}" variant="ghost" size="lg" class="backdrop-blur-sm">Đọc tin nổi bật</x-ui.button>
                </div>
            </div>

            <div class="flex-1">
                <form action="{{ route('tim-kiem-tour') }}" method="GET" class="rounded-2xl border border-base-100/40 bg-base-100/90 p-6 shadow-lg backdrop-blur">
                    <div class="space-y-5">
                        <div>
                            <h2 class="text-lg font-semibold text-base-content">Tìm tour phù hợp</h2>
                            <p class="mt-1 text-sm text-base-content/70">Lọc theo điểm đến, thời gian hoặc ngân sách để lên kế hoạch nhanh chóng.</p>
                        </div>

                        <x-ui.input
                            name="keyword"
                            label="Bạn muốn đi đâu?"
                            placeholder="Tìm kiếm điểm đến, tour hoặc trải nghiệm"
                            prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m21 21-4.35-4.35M18 10.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0z'/></svg>"
                        />

                        <div class="grid gap-4 sm:grid-cols-2">
                            <x-ui.input
                                name="start_date"
                                type="date"
                                label="Ngày khởi hành"
                                class="[&_input]:cursor-pointer"
                            />
                            <x-ui.input
                                name="price_max"
                                type="number"
                                min="0"
                                label="Ngân sách tối đa (VNĐ)"
                                placeholder="Ví dụ: 10000000"
                            />
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <label class="flex items-center gap-2 text-sm font-medium text-base-content">
                                <input type="checkbox" name="featured" value="1" class="checkbox checkbox-primary" />
                                Chỉ hiển thị tour nổi bật
                            </label>
                            <span class="text-xs text-base-content/60">Bạn có thể tinh chỉnh thêm sau khi xem kết quả.</span>
                        </div>

                        <div class="flex flex-wrap justify-between gap-3">
                            <x-ui.button type="submit" variant="primary" class="flex-1 justify-center">Tìm tour ngay</x-ui.button>
                            <x-ui.button type="reset" variant="ghost" class="justify-center">Xóa lọc</x-ui.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="mx-auto flex w-full max-w-6xl flex-col gap-12 px-4 sm:px-6 lg:px-8" id="popular">
        <div class="flex flex-col items-center gap-4 text-center">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-primary">Tour du lịch</span>
            <h2 class="text-3xl font-bold text-base-content sm:text-4xl">Gợi ý hành trình đáng nhớ</h2>
            <p class="max-w-2xl text-base text-base-content/70">Những hành trình được yêu thích nhất với lịch trình tinh gọn, dịch vụ tận tâm và trải nghiệm bản địa đặc sắc.</p>
        </div>

        @if($featuredTours->isEmpty())
            <x-ui.empty title="Chưa có tour khả dụng" description="Vui lòng quay lại sau hoặc thử tìm kiếm với tiêu chí khác." />
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredTours as $tour)
                    <x-ui.card hover class="flex h-full flex-col gap-4 overflow-hidden p-0">
                        <a href="{{ route('showTourDuLich', $tour->slug) }}" class="block">
                            <div class="aspect-[4/3] w-full overflow-hidden">
                                <img
                                    src="{{ $tour->hinhAnhTours->isNotEmpty() ? asset('storage/' . $tour->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}"
                                    alt="Hình ảnh tour {{ $tour->ten_tour }}"
                                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                >
                            </div>
                        </a>
                        <div class="flex flex-1 flex-col gap-3 px-6 pb-6 pt-4">
                            <div class="flex items-center justify-between text-sm font-semibold">
                                <span class="rounded-full bg-primary/15 px-3 py-1 text-primary/90">{{ $tour->noi_khoi_hanh }}</span>
                                <span class="text-base-content">{{ number_format($tour->gia) }} VNĐ</span>
                            </div>
                            <h3 class="text-lg font-semibold text-base-content">
                                <a href="{{ route('showTourDuLich', $tour->slug) }}" class="transition hover:text-primary">{{ $tour->ten_tour }}</a>
                            </h3>
                            <p class="text-sm text-base-content/70">Lịch trình {{ $tour->thoigian_tour }} với nhiều hoạt động địa phương và tiện nghi nghỉ dưỡng chuẩn quốc tế.</p>
                            <div class="mt-auto flex items-center justify-between text-sm text-base-content/60">
                                <span>Khởi hành linh hoạt</span>
                                <span>Xem chi tiết</span>
                            </div>
                        </div>
                    </x-ui.card>
                @endforeach
            </div>
            <div class="flex justify-center">
                <x-ui.button href="{{ route('tourDuLich') }}" variant="secondary" size="lg">Xem thêm tour</x-ui.button>
            </div>
        @endif
    </section>

    <section class="bg-base-200/40 py-20" id="value">
        <div class="mx-auto flex max-w-6xl flex-col gap-12 px-4 sm:px-6 lg:px-8 lg:flex-row lg:items-center">
            <div class="flex-1 space-y-6">
                <span class="text-sm font-semibold uppercase tracking-[0.3em] text-primary">Giá trị cốt lõi</span>
                <h2 class="text-3xl font-bold text-base-content sm:text-4xl">Bạn đồng hành đáng tin cậy trên mỗi hành trình</h2>
                <p class="text-base text-base-content/70">Chúng tôi dành thời gian khảo sát từng điểm đến, xây dựng lịch trình thông minh và lựa chọn đối tác uy tín để mỗi chuyến đi đều là trải nghiệm đáng nhớ.</p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-ui.card class="h-full bg-base-100/80 p-5 shadow-sm">
                        <h3 class="text-lg font-semibold text-base-content">Dịch vụ chuyên sâu</h3>
                        <p class="mt-2 text-sm text-base-content/70">Đội ngũ tư vấn tận tâm hỗ trợ bạn đặt tour, chọn phòng, đặt vé máy bay và thiết kế lịch trình riêng.</p>
                    </x-ui.card>
                    <x-ui.card class="h-full bg-base-100/80 p-5 shadow-sm">
                        <h3 class="text-lg font-semibold text-base-content">Chi phí minh bạch</h3>
                        <p class="mt-2 text-sm text-base-content/70">Cam kết không phát sinh chi phí ẩn, nhiều ưu đãi sớm và chương trình tri ân khách hàng thân thiết.</p>
                    </x-ui.card>
                    <x-ui.card class="h-full bg-base-100/80 p-5 shadow-sm">
                        <h3 class="text-lg font-semibold text-base-content">Đảm bảo an toàn</h3>
                        <p class="mt-2 text-sm text-base-content/70">Bảo hiểm du lịch toàn diện, đối tác vận chuyển kiểm định định kỳ và hướng dẫn viên giàu kinh nghiệm.</p>
                    </x-ui.card>
                    <x-ui.card class="h-full bg-base-100/80 p-5 shadow-sm">
                        <h3 class="text-lg font-semibold text-base-content">Hỗ trợ 24/7</h3>
                        <p class="mt-2 text-sm text-base-content/70">Đường dây nóng xử lý sự cố ngay lập tức cùng ứng dụng theo dõi lịch trình khi bạn đang trên đường.</p>
                    </x-ui.card>
                </div>
            </div>
            <div class="flex-1">
                <x-ui.card class="relative overflow-hidden border-primary/20 bg-primary/5 p-0 shadow-lg">
                    <img src="{{ asset('frontend/assets/images/team.jpg') }}" alt="Đội ngũ Hanoitourist" class="h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-base-100/90 via-base-100/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 space-y-3 p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-primary">Chúng tôi là Hanoitourist</p>
                        <h3 class="text-2xl font-bold text-base-content">20+ năm dẫn lối cho hàng trăm nghìn lượt khách khám phá Việt Nam</h3>
                        <p class="text-sm text-base-content/70">Sự hài lòng của bạn là động lực để chúng tôi không ngừng cải tiến dịch vụ và mở rộng điểm đến mới.</p>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8" id="blog">
        <div class="flex flex-col items-center gap-4 text-center">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-primary">Tin tức</span>
            <h2 class="text-3xl font-bold text-base-content sm:text-4xl">Cập nhật mới nhất từ hành trình</h2>
            <p class="max-w-2xl text-base text-base-content/70">Khám phá kinh nghiệm du lịch, gợi ý điểm đến theo mùa và thông tin ưu đãi để bạn luôn dẫn đầu xu hướng dịch chuyển.</p>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @forelse($featuredArticles as $article)
                <x-ui.card hover class="flex h-full flex-col overflow-hidden p-0">
                    <a href="{{ route('showTinTuc', $article->slug) }}" class="block">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('storage/' . $article->hinh_anh) }}" alt="{{ $article->tieu_de }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-5">
                        <div class="flex items-center gap-3 text-xs font-medium text-base-content/60">
                            <span>{{ date('d/m/Y', strtotime($article->created_at)) }}</span>
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $article->doc }} lượt xem
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-base-content">
                            <a href="{{ route('showTinTuc', $article->slug) }}" class="transition hover:text-primary">{{ $article->tieu_de }}</a>
                        </h3>
                        <p class="text-sm leading-relaxed text-base-content/70" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $article->noidung_rutgon }}
                        </p>
                        <div class="mt-auto">
                            <x-ui.button href="{{ route('showTinTuc', $article->slug) }}" variant="ghost" class="px-0 text-primary">Đọc tiếp</x-ui.button>
                        </div>
                    </div>
                </x-ui.card>
            @empty
                <div class="lg:col-span-3">
                    <x-ui.empty title="Chưa có tin tức" description="Hãy quay lại sau để cập nhật những câu chuyện hành trình mới nhất." />
                </div>
            @endforelse
        </div>

        @if($featuredArticles->isNotEmpty())
            <div class="mt-10 flex justify-center">
                <x-ui.button href="{{ route('tintuc') }}" variant="secondary" size="lg">Xem tất cả bài viết</x-ui.button>
            </div>
        @endif
    </section>
</div>
@endsection