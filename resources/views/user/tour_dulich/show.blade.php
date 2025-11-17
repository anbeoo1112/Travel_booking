@extends('layouts.moldUser')

@section('content')
@php
    $galleryImages = $tour->hinhAnhTours;
    $relatedTours = $tours;
@endphp

<div class="flex flex-col gap-16">
    <section class="relative overflow-hidden rounded-3xl bg-neutral text-neutral-content">
        <div class="absolute inset-0">
            @if($galleryImages->isNotEmpty())
                <img src="{{ asset('storage/' . $galleryImages->first()->url_anh) }}" alt="Hình ảnh tour {{ $tour->ten_tour }}" class="h-full w-full object-cover">
            @else
                <img src="{{ asset('frontend/assets/images/banner/banner_travel_tour.jpg') }}" alt="Tour" class="h-full w-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-br from-neutral/90 via-neutral/70 to-neutral/40"></div>
        </div>

        <div class="relative mx-auto flex max-w-6xl flex-col gap-10 px-6 py-24 sm:px-8 lg:flex-row lg:items-end lg:px-12">
            <div class="flex-1 space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em]" x-text="$store.uiTheme.t('tour_detail_badge')">Tour đặc sắc</span>
                <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">{{ $tour->ten_tour }}</h1>
                <div class="flex flex-wrap gap-4 text-sm font-medium">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2">
                        <span class="text-lg">&#128205;</span>
                        <span x-text="$store.uiTheme.t('tour_detail_departure')">Khởi hành</span>: {{ $tour->noi_khoi_hanh }}
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2">
                        <span class="text-lg">&#9201;</span>
                        <span x-text="$store.uiTheme.t('tour_detail_duration')">Thời gian</span>: {{ $tour->thoigian_tour }}
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2"><span class="text-lg">&#128176;</span>{{ number_format($tour->gia) }} VNĐ</span>
                </div>
            </div>
            <div class="shrink-0 rounded-2xl bg-base-100/90 p-6 text-neutral shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-primary" x-text="$store.uiTheme.t('tour_detail_price_from')">Giá chỉ từ</p>
                <p class="mt-2 text-3xl font-bold text-base-content">{{ number_format($tour->gia) }} VNĐ</p>
                <p class="mt-3 text-sm text-base-content/60" x-text="$store.uiTheme.t('tour_detail_price_includes')">Giá đã bao gồm vé máy bay khứ hồi, khách sạn chuẩn 4 sao và lịch trình trải nghiệm địa phương.</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="#dat-tour" class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white shadow-lg transition hover:bg-primary/90">
                        <span x-text="$store.uiTheme.t('tour_detail_book_now')">Đặt tour ngay</span>
                    </a>
                    <a href="#lich-trinh" class="inline-flex items-center gap-2 rounded-full border border-primary/40 px-5 py-2 text-sm font-semibold text-white/80 transition hover:bg-white/10">
                        <span x-text="$store.uiTheme.t('tour_detail_view_itinerary')">Xem lịch trình</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if($galleryImages->count() > 1)
        <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($galleryImages as $image)
                    <div class="gallery-image">
                        <img src="{{ asset('storage/' . $image->url_anh) }}" alt="{{ $image->ten_anh }}" loading="lazy">
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section id="lich-trinh" class="mx-auto flex w-full max-w-6xl flex-col gap-10 px-4 sm:px-6 lg:px-8 lg:flex-row">
        <article class="flex-1 space-y-8">
            <x-ui.card class="space-y-6 bg-base-100/90">
                <div class="space-y-2">
                    <h2 class="text-2xl font-semibold text-base-content" x-text="$store.uiTheme.t('tour_detail_intro_title')">Giới thiệu hành trình</h2>
                    <p class="text-sm text-base-content/70" x-text="$store.uiTheme.t('tour_detail_intro_description')">Thông tin chi tiết về tour được cập nhật mới nhất để bạn dễ dàng lên kế hoạch.</p>
                </div>
                <div class="prose max-w-none text-base-content [&_*]:leading-relaxed">
                    {!! $tour->mo_ta !!}
                </div>
            </x-ui.card>

            <x-ui.card class="space-y-4 bg-base-100/90">
                <h3 class="text-xl font-semibold text-base-content" x-text="$store.uiTheme.t('tour_detail_highlights_title')">Điểm nổi bật</h3>
                <ul class="space-y-3 text-sm text-base-content/75">
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_highlight_1')">- Lịch trình cân bằng giữa thư giãn và khám phá địa phương.</span></li>
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_highlight_2')">- Hướng dẫn viên tận tâm đồng hành xuyên suốt chuyến đi.</span></li>
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_highlight_3')">- Bữa ăn tiêu chuẩn cao với thực đơn địa phương đặc sắc.</span></li>
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_highlight_4')">- Dịch vụ hỗ trợ 24/7 trong suốt hành trình.</span></li>
                </ul>
            </x-ui.card>
        </article>

        <aside id="dat-tour" class="w-full max-w-md space-y-6">
            <x-ui.card class="space-y-5 border border-base-200/80 bg-base-100 shadow-xl">
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold text-base-content" x-text="$store.uiTheme.t('tour_detail_booking_title')">Đặt tour</h2>
                    <p class="text-sm text-base-content/70" x-text="$store.uiTheme.t('tour_detail_booking_description')">Nhập thông tin cơ bản. Đội ngũ của chúng tôi sẽ liên hệ xác nhận trong vòng 24 giờ.</p>
                </div>
                <form action="{{ route('datTour') }}" method="post" id="datTourForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_tour" id="id_tour" value="{{ $tour->id }}" data-gia="{{ $tour->gia }}">
                    <input type="hidden" name="tong_gia" id="tong_gia_hidden">

                    <x-ui.input
                        name="ho_ten"
                        label-key="tour_detail_full_name"
                        placeholder-key="tour_detail_full_name_placeholder"
                        value="{{ Auth::user()->ho_ten ?? '' }}"
                        required
                    />
                    <x-ui.input
                        name="email"
                        type="email"
                        label-key="tour_detail_email"
                        placeholder-key="tour_detail_email_placeholder"
                        value="{{ Auth::user()->email ?? '' }}"
                        required
                    />
                    <x-ui.input
                        name="so_dien_thoai"
                        label-key="tour_detail_phone"
                        placeholder-key="tour_detail_phone_placeholder"
                        value="{{ Auth::user()->so_dien_thoai ?? '' }}"
                        required
                    />

                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.input
                            name="so_nguoi"
                            id="so_nguoi"
                            label-key="tour_detail_people_count"
                            type="number"
                            min="1"
                            value="1"
                            required
                        />
                        <div class="form-control">
                            <label for="ngay_di" class="label">
                                <span class="label-text font-medium" x-text="$store.uiTheme.t('tour_detail_departure_date')">Ngày khởi hành</span>
                            </label>
                            <input 
                                type="date" 
                                name="ngay_di" 
                                id="ngay_di"
                                class="input input-bordered w-full"
                                required
                            />
                        </div>
                    </div>

                    <div id="tongGia" class="rounded-xl bg-base-200/60 px-4 py-3 text-sm font-semibold text-base-content">
                        <span x-text="$store.uiTheme.t('tour_detail_unit_price')">Đơn giá</span>: {{ number_format($tour->gia) }} VNĐ
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary w-full justify-center">
                        <span x-text="$store.uiTheme.t('tour_detail_submit_booking')">Gửi yêu cầu đặt tour</span>
                    </button>
                </form>
            </x-ui.card>

            <x-ui.card class="space-y-4 bg-base-100/90">
                <h3 class="text-lg font-semibold text-base-content" x-text="$store.uiTheme.t('tour_detail_commitment_title')">Cam kết của Hanoitourist</h3>
                <ul class="space-y-2 text-sm text-base-content/70">
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_commitment_1')">- Hoàn tiền 100% nếu tour không khởi hành như cam kết.</span></li>
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_commitment_2')">- Hỗ trợ thay đổi lịch trình miễn phí trước 7 ngày.</span></li>
                    <li><span x-text="'- ' + $store.uiTheme.t('tour_detail_commitment_3')">- Ưu đãi giảm đến 10% cho khách hàng thân thiết.</span></li>
                </ul>
            </x-ui.card>
        </aside>
    </section>

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 text-center">
            <span class="text-sm font-semibold uppercase tracking-[0.35em] text-primary" x-text="$store.uiTheme.t('tour_detail_related_badge')">Gợi ý khác</span>
            <h2 class="text-3xl font-bold text-base-content" x-text="$store.uiTheme.t('tour_detail_related_title')">Những hành trình bạn có thể thích</h2>
            <p class="text-base text-base-content/70" x-text="$store.uiTheme.t('tour_detail_related_description')">Chọn thêm hành trình dự phòng hoặc gợi ý cho bạn bè cùng trải nghiệm.</p>
        </div>
        @if($relatedTours->isEmpty())
            <div class="mt-8">
                <x-ui.empty title-key="tour_detail_no_related_title" description-key="tour_detail_no_related_description" />
            </div>
        @else
            <div class="mt-12 grid gap-6 sm:grid-cols-2 xl:grid-cols-3" x-data="{ duration: '' }">
                @foreach($relatedTours as $item)
                    <x-ui.card hover class="flex h-full flex-col overflow-hidden p-0">
                        <a href="{{ route('showTourDuLich', $item->slug) }}" class="block">
                            <div class="tour-card-image">
                                <img src="{{ $item->hinhAnhTours->isNotEmpty() ? asset('storage/' . $item->hinhAnhTours[0]->url_anh) : asset('frontend/assets/images/logo/logo2.png') }}" alt="{{ $item->ten_tour }}" loading="lazy">
                            </div>
                        </a>
                        <div class="flex flex-1 flex-col gap-4 px-6 pb-6 pt-5">
                            <div class="flex items-center justify-between text-sm font-semibold">
                                <span class="rounded-full bg-primary/15 px-3 py-1 text-primary/90">{{ $item->noi_khoi_hanh }}</span>
                                <span class="text-base-content">{{ number_format($item->gia) }} VNĐ</span>
                            </div>
                            <h3 class="text-lg font-semibold text-base-content">
                                <a href="{{ route('showTourDuLich', $item->slug) }}" class="transition hover:text-primary">{{ $item->ten_tour }}</a>
                            </h3>
                            <p class="text-sm text-base-content/70" x-init="duration = '{{ $item->thoigian_tour }}'" x-text="$store.uiTheme.format('tour_detail_related_duration', { duration: duration })">Thời gian {{ $item->thoigian_tour }} với hoạt động trải nghiệm địa phương độc đáo.</p>
                            <div class="mt-auto flex items-center justify-between text-xs font-medium text-base-content/60">
                                <span x-text="$store.uiTheme.t('tour_detail_related_promo')">Ưu đãi mùa này</span>
                                <span>&rarr;</span>
                            </div>
                        </div>
                    </x-ui.card>
                @endforeach
            </div>
        @endif
    </section>
</div>

@if(session()->has('success'))
    <div class="mx-auto mt-8 max-w-3xl px-4">
        <x-ui.toast variant="success" dismissible> {{ session('success') }} </x-ui.toast>
    </div>
@endif
@endsection

@push('style-alt')
@endpush

@push('script-alt')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('ngay_di');
            const form = document.getElementById('datTourForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Set min date (NGÀY MAI - không phải hôm nay)
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const minDate = tomorrow.toISOString().split('T')[0];
            
            // Set max date (90 ngày sau ngày mai)
            const maxDate = new Date(tomorrow);
            maxDate.setDate(maxDate.getDate() + 90);
            const maxDateStr = maxDate.toISOString().split('T')[0];
            
            dateInput.min = minDate;
            dateInput.max = maxDateStr;
            
            // Validate khi chọn ngày
            dateInput.addEventListener('change', function() {
                if (!this.value) return;
                
                const selectedDate = new Date(this.value + 'T00:00:00');
                const dayOfWeek = selectedDate.getDay();
                
                // 5 = Thứ 6, 6 = Thứ 7, 0 = Chủ nhật
                const allowedDays = [5, 6, 0];
                const dayNames = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
                
                if (!allowedDays.includes(dayOfWeek)) {
                    const selectedDayName = dayNames[dayOfWeek];
                    alert(`⚠️ ${selectedDayName} không phục vụ tour.\n\nChỉ chọn được: Thứ 6, Thứ 7, hoặc Chủ nhật`);
                    this.value = '';
                    return;
                }
                
                // Hiện thông báo thành công
                const dateObj = new Date(this.value + 'T00:00:00');
                const formattedDate = dateObj.toLocaleDateString('vi-VN', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
                console.log('✅ Chọn ngày thành công: ' + formattedDate);
            });

            // Tính toán tổng giá
            const tourInput = document.getElementById('id_tour');
            const giaMotNguoi = Number(tourInput.dataset.gia);
            const soNguoiInput = document.getElementById('so_nguoi');
            const tongGiaEl = document.getElementById('tongGia');
            const tongGiaHidden = document.getElementById('tong_gia_hidden');

            function updateTotal() {
                const soNguoi = parseInt(soNguoiInput.value, 10) || 0;
                const lang = localStorage.getItem('tt_language') || 'vi';
                const unitPriceLabel = lang === 'en' ? 'Unit Price' : 'Đơn giá';
                const totalPriceLabel = lang === 'en' ? 'Total Price' : 'Tổng giá';
                
                if (soNguoi > 0) {
                    const tong = giaMotNguoi * soNguoi;
                    tongGiaEl.textContent = totalPriceLabel + ': ' + tong.toLocaleString('vi-VN') + ' VNĐ';
                    tongGiaHidden.value = tong;
                } else {
                    tongGiaEl.textContent = unitPriceLabel + ': ' + giaMotNguoi.toLocaleString('vi-VN') + ' VNĐ';
                    tongGiaHidden.value = '';
                }
            }

            soNguoiInput.addEventListener('input', updateTotal);
            updateTotal();

            // Submit form - handle validation
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Kiểm tra ngày đã chọn
                if (!dateInput.value) {
                    alert('❌ Vui lòng chọn ngày khởi hành');
                    dateInput.focus();
                    return;
                }
                
                // Kiểm tra user đã login chưa
                @if(Auth::check())
                    // User đã login - submit form
                    form.submit();
                @else
                    // User chưa login - redirect đến login
                    if (confirm('❌ Bạn cần đăng nhập để đặt tour.\n\nBạn muốn đăng nhập ngay?')) {
                        window.location.href = "{{ route('login') }}";
                    }
                @endif
            });
        });
    </script>
@endpush