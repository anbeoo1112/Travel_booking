@extends('layouts.moldUser')

@section('content')
<div class="flex flex-col gap-16">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary/20 via-accent/15 to-primary/30 px-6 py-20 shadow-inner sm:px-10 lg:px-16">
        <div class="absolute inset-0 -z-10 bg-[url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="mx-auto flex max-w-5xl flex-col gap-6 text-center lg:text-left">
            <span class="inline-flex items-center self-center rounded-full bg-primary/15 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary lg:self-start">Hanoitourist</span>
            <h1 class="text-3xl font-bold leading-tight text-base-content sm:text-4xl lg:text-5xl">Về chúng tôi</h1>
            <p class="text-base text-base-content/70 lg:max-w-3xl">Hơn 60 năm đồng hành cùng du khách khám phá Việt Nam và thế giới, Hanoitourist tự hào mang đến những trải nghiệm khác biệt với dịch vụ tận tâm và lịch trình tinh tế.</p>
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-base-content/70 lg:justify-start">
                <span class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow">Thành lập từ năm 1963</span>
                <span class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow">Top Ten lữ hành quốc tế</span>
                <span class="inline-flex items-center gap-2 rounded-full bg-base-100/80 px-4 py-2 shadow">Đối tác chiến lược Vietnam Airlines</span>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="mx-auto w-full max-w-3xl px-4">
            <x-ui.toast variant="success" dismissible>{{ session('success') }}</x-ui.toast>
        </div>
    @endif

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[2fr_1fr]">
            <x-ui.card class="space-y-4 bg-base-100/90">
                <h2 class="text-2xl font-semibold text-base-content">Giới thiệu Hanoitourist</h2>
                <p class="text-base text-base-content/70">Công ty Lữ hành Hanoitourist là đơn vị trực thuộc Tổng Công ty Du lịch Hà Nội, tiên phong trong các lĩnh vực lữ hành quốc tế, khách sạn, nhà hàng, vận chuyển và nhiều dịch vụ du lịch bổ trợ.</p>
                <p class="text-base text-base-content/70">Tiền thân là Công ty Du lịch Hà Nội thành lập ngày 25/3/1963, đến năm 2004 Hanoitourist được tái cấu trúc thành Tổng công ty hoạt động theo mô hình công ty mẹ - công ty con, quy tụ các doanh nghiệp du lịch đầu ngành tại Thủ đô.</p>
                <p class="text-base text-base-content/70">Trong nhiều năm liên tiếp, Hanoitourist giữ vững vị thế "Top Ten lữ hành quốc tế" của Tổng cục Du lịch và là một trong những đối tác có doanh thu cao nhất của Vietnam Airlines. Chúng tôi cũng vinh dự nhận giải thưởng "Đối tác triển vọng nhất" từ Tổng cục Du lịch Hàn Quốc cùng nhiều vinh danh uy tín khác.</p>
                <p class="text-base text-base-content/70">Sứ mệnh của chúng tôi là kiến tạo hành trình chuẩn mực, giàu trải nghiệm bản địa, góp phần nâng tầm thương hiệu du lịch Việt Nam trên bản đồ thế giới.</p>
            </x-ui.card>

            <div class="space-y-4">
                <x-ui.card class="bg-primary text-primary-content">
                    <h3 class="text-xl font-semibold">Tầm nhìn</h3>
                    <p class="mt-3 text-sm text-primary-content/90">Trở thành thương hiệu lữ hành đáng tin cậy nhất tại Việt Nam, gắn liền với dịch vụ đẳng cấp và trải nghiệm cảm xúc.</p>
                </x-ui.card>
                <x-ui.card class="bg-base-100/90">
                    <h3 class="text-xl font-semibold text-base-content">Giá trị cốt lõi</h3>
                    <ul class="mt-3 space-y-2 text-sm text-base-content/70">
                        <li>- Tận tâm với khách hàng, chăm sóc từng hành trình.</li>
                        <li>- Sáng tạo trong thiết kế tour và dịch vụ đi kèm.</li>
                        <li>- Hợp tác bền vững với đối tác trong và ngoài nước.</li>
                        <li>- Trách nhiệm với cộng đồng và môi trường.</li>
                    </ul>
                </x-ui.card>
            </div>
        </div>
    </section>

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-2">
            <x-ui.card class="space-y-4 bg-base-100/90">
                <h2 class="text-xl font-semibold text-base-content">Dấu ấn nổi bật</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-ui.stat label="Khách hàng hài lòng" value="500.000+" description="phục vụ trong và ngoài nước" />
                    <x-ui.stat label="Điểm đến" value="150+" description="trải rộng khắp Việt Nam và thế giới" />
                    <x-ui.stat label="Đối tác chiến lược" value="200+" description="hãng bay, khách sạn, dịch vụ" />
                    <x-ui.stat label="Năm kinh nghiệm" value="60+" description="xây dựng hành trình đáng nhớ" />
                </div>
            </x-ui.card>

            <x-ui.card class="space-y-4 bg-base-100/90">
                <h2 class="text-xl font-semibold text-base-content">Hành trình phát triển</h2>
                <ul class="space-y-3 text-sm text-base-content/70">
                    <li><span class="font-semibold text-base-content">1963</span>: Thành lập Công ty Du lịch Hà Nội.</li>
                    <li><span class="font-semibold text-base-content">2004</span>: Chính thức hoạt động theo mô hình Tổng công ty Hanoitourist.</li>
                    <li><span class="font-semibold text-base-content">2010 - nay</span>: Top Ten lữ hành quốc tế, nhiều giải thưởng du lịch uy tín.</li>
                    <li><span class="font-semibold text-base-content">Hiện tại</span>: Mở rộng hệ sinh thái du lịch, ứng dụng công nghệ vào trải nghiệm khách hàng.</li>
                </ul>
            </x-ui.card>
        </div>
    </section>

    <section class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1.3fr_1fr]">
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-base-content">Liên hệ với chúng tôi</h2>
                <div class="overflow-hidden rounded-3xl shadow-lg">
                    <iframe class="h-80 w-full" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7448.515768307514!2d105.855372!3d21.022365!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abecf5c5a0a9%3A0x663f15b4628b3028!2zQ8O0bmcgdHkgTOG7ryBow6BuaCBIYW5vaXRvdXJpc3Q!5e0!3m2!1svi!2sus!4v1729341598681!5m2!1svi!2sus" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="space-y-4">
                <x-ui.card class="space-y-4 bg-base-100/90">
                    <h3 class="text-lg font-semibold text-base-content">Thông tin liên hệ</h3>
                    <div class="space-y-3 text-sm text-base-content/70">
                        <p><span class="font-semibold text-base-content">Hotline:</span> 1900 1900</p>
                        <p><span class="font-semibold text-base-content">Email:</span> info@hanoitourist.vn</p>
                        <p><span class="font-semibold text-base-content">Hỗ trợ khẩn:</span> 0338 869 605</p>
                        <p><span class="font-semibold text-base-content">Địa chỉ:</span> 18 Lý Thường Kiệt, Hoàn Kiếm, Hà Nội</p>
                    </div>
                    <div class="pt-2">
                        @include('user.guiGopY')
                    </div>
                </x-ui.card>

                <x-ui.card class="space-y-3 bg-base-100/90">
                    <h3 class="text-lg font-semibold text-base-content">Kết nối với chúng tôi</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" class="btn btn-ghost btn-sm gap-2">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12.07c0-5.52-4.48-10-10-10s-10 4.48-10 10c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.77l-.44 2.89h-2.33v6.99C18.34 21.19 22 17.06 22 12.07z" />
                            </svg>
                            Facebook
                        </a>
                        <a href="#" class="btn btn-ghost btn-sm gap-2">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2.2A2.8 2.8 0 1110.2 12 2.8 2.8 0 0112 9.2zm4.75-.95a1 1 0 11-1.5-1.3 1 1 0 011.5 1.3z" />
                            </svg>
                            Instagram
                        </a>
                        <a href="#" class="btn btn-ghost btn-sm gap-2">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21.8 8.001a2.749 2.749 0 00-1.94-1.94C18.26 5.75 12 5.75 12 5.75s-6.26 0-7.86.311A2.749 2.749 0 002.2 8.001 28.61 28.61 0 002 12a28.61 28.61 0 00.2 3.999 2.749 2.749 0 001.94 1.94c1.6.311 7.86.311 7.86.311s6.26 0 7.86-.311a2.749 2.749 0 001.94-1.94A28.61 28.61 0 0022 12a28.61 28.61 0 00-.2-3.999zM9.75 14.651V9.35l4.5 2.65-4.5 2.65z" />
                            </svg>
                            YouTube
                        </a>
                        <a href="#" class="btn btn-ghost btn-sm gap-2">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                            TikTok
                        </a>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>
</div>
@endsection
