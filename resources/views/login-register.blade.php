<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Tour | Đăng nhập &amp; Đăng ký</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">
    <style>[x-cloak]{display:none !important;}</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    $registerErrors = $errors->get('ho_ten') || $errors->get('so_dien_thoai') || $errors->get('email');
    $activeTab = $registerErrors || old('ho_ten') || old('so_dien_thoai') || old('email') ? 'register' : 'login';
@endphp

<body x-data="{ tab: @js($activeTab) }" class="min-h-screen bg-base-200">
    <main class="relative flex min-h-screen bg-gradient-to-br from-primary/5 via-base-200 to-accent/10">
        <div class="relative hidden w-1/2 overflow-hidden lg:block">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80" alt="Bãi biển nhiệt đới" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-neutral/90 via-neutral/60 to-transparent opacity-80"></div>
            </div>
            <div class="relative flex h-full flex-col justify-between p-12 text-neutral-content">
                <div class="space-y-6">
                    <a href="{{ route('homepage') }}" class="inline-flex items-center gap-3 text-sm font-semibold text-white/80 transition hover:text-white">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/10">TT</span>
                        Trở về trang chủ
                    </a>
                    <div class="space-y-4">
                        <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em]">HANOITOURIST</span>
                        <h1 class="text-4xl font-bold leading-tight text-white">Cùng bạn viết nên những hành trình đáng nhớ</h1>
                        <p class="text-base text-white/80">Đăng nhập để tiếp tục quản lý booking, theo dõi ưu đãi độc quyền và nhận gợi ý điểm đến phù hợp nhất dành riêng cho bạn.</p>
                    </div>
                </div>
                <div class="rounded-2xl bg-white/10 p-8 backdrop-blur">
                    <h2 class="text-lg font-semibold text-white">Đặc quyền cho thành viên</h2>
                    <ul class="mt-4 space-y-3 text-sm text-white/80">
                        <li>- Quản lý vé &amp; lịch trình chỉ trong vài giây</li>
                        <li>- Tích điểm đổi quà và hưởng ưu đãi sớm nhất</li>
                        <li>- Nhận tư vấn 1-1 từ Travel Coach kinh nghiệm</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex w-full items-center justify-center px-4 py-12 sm:px-6 lg:w-1/2 lg:px-12">
            <div class="w-full max-w-lg space-y-10">
                <div class="flex items-center justify-center gap-4 lg:justify-start">
                    <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" alt="Travel Tour" class="h-12 w-12 rounded-full border border-base-200 bg-base-100 p-1">
                    <div>
                        <h2 class="text-xl font-semibold text-base-content">Chào mừng trở lại!</h2>
                        <p class="text-sm text-base-content/70">Đăng nhập để tiếp tục hoặc tạo tài khoản mới chỉ mất một phút.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @if(session('success'))
                        <x-ui.toast variant="success">{{ session('success') }}</x-ui.toast>
                    @endif
                    @if(session('error'))
                        <x-ui.toast variant="danger">{{ session('error') }}</x-ui.toast>
                    @endif
                </div>

                <div class="rounded-3xl border border-base-200 bg-base-100 p-6 shadow-xl shadow-base-200/40 sm:p-8">
                    <div class="flex items-center gap-2 rounded-full bg-base-200/60 p-1">
                        <button type="button" class="flex-1 rounded-full px-4 py-2 text-sm font-semibold transition" :class="tab === 'login' ? 'bg-base-100 text-primary shadow' : 'text-base-content/60'" @click="tab = 'login'">
                            Đăng nhập
                        </button>
                        <button type="button" class="flex-1 rounded-full px-4 py-2 text-sm font-semibold transition" :class="tab === 'register' ? 'bg-base-100 text-primary shadow' : 'text-base-content/60'" @click="tab = 'register'">
                            Đăng ký
                        </button>
                    </div>

                    <div class="mt-8 space-y-8">
                        <form x-show="tab === 'login'" x-cloak action="{{ route('login') }}" method="post" class="space-y-6">
                            @csrf
                            <x-ui.input
                                name="tai_khoan"
                                label="Tài khoản"
                                placeholder="Nhập tài khoản"
                                value="{{ old('tai_khoan') }}"
                                autocomplete="username"
                                required
                                :error="$errors->first('tai_khoan')"
                            />
                            <x-ui.input
                                name="mat_khau"
                                type="password"
                                label="Mật khẩu"
                                placeholder="Nhập mật khẩu"
                                autocomplete="current-password"
                                required
                                :error="$errors->first('mat_khau')"
                            />
                            <div class="flex items-center justify-between text-sm">
                                <label class="inline-flex items-center gap-2 text-base-content/70">
                                    <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary">
                                    Ghi nhớ đăng nhập
                                </label>
                                <a href="{{ route('password.request') }}" class="font-medium text-primary/80 hover:underline">Quên mật khẩu?</a>
                            </div>
                            <x-ui.button type="submit" variant="primary" size="lg" class="w-full justify-center">Đăng nhập</x-ui.button>
                        </form>

                        <form x-show="tab === 'register'" x-cloak action="{{ route('register') }}" method="post" class="space-y-6">
                            @csrf
                            <div class="grid gap-5 sm:grid-cols-2">
                                <x-ui.input
                                    name="ho_ten"
                                    label="Họ và tên"
                                    placeholder="Ví dụ: Nguyễn Văn A"
                                    value="{{ old('ho_ten') }}"
                                    autocomplete="name"
                                    required
                                    :error="$errors->first('ho_ten')"
                                />
                                <x-ui.input
                                    name="so_dien_thoai"
                                    label="Số điện thoại"
                                    placeholder="0987 654 321"
                                    value="{{ old('so_dien_thoai') }}"
                                    autocomplete="tel"
                                    required
                                    :error="$errors->first('so_dien_thoai')"
                                />
                                <x-ui.input
                                    name="email"
                                    type="email"
                                    label="Email"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required
                                    :error="$errors->first('email')"
                                />
                                <x-ui.input
                                    name="tai_khoan"
                                    label="Tên đăng nhập"
                                    placeholder="Tên đăng nhập mong muốn"
                                    value="{{ old('tai_khoan') }}"
                                    autocomplete="username"
                                    required
                                    :error="$errors->first('tai_khoan')"
                                />
                            </div>
                            <div class="grid gap-5 sm:grid-cols-2">
                                <x-ui.input
                                    name="mat_khau"
                                    type="password"
                                    label="Mật khẩu"
                                    placeholder="Tối thiểu 8 ký tự"
                                    autocomplete="new-password"
                                    required
                                    :error="$errors->first('mat_khau')"
                                />
                                <div class="space-y-2 text-sm text-base-content/70">
                                    <p class="font-semibold text-base-content">Mẹo tạo mật khẩu mạnh</p>
                                    <ul class="space-y-1">
                                        <li>- Kết hợp chữ hoa, chữ thường và số</li>
                                        <li>- Thêm ký tự đặc biệt nếu có thể</li>
                                        <li>- Tránh dùng thông tin cá nhân dễ đoán</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rounded-xl bg-base-200/60 px-4 py-3 text-sm text-base-content/70">
                                Bằng việc đăng ký, bạn đồng ý với <a href="#" class="font-medium text-primary hover:underline">Điều khoản sử dụng</a> và <a href="#" class="font-medium text-primary hover:underline">Chính sách bảo mật</a> của chúng tôi.
                            </div>
                            <x-ui.button type="submit" variant="secondary" size="lg" class="w-full justify-center">Tạo tài khoản</x-ui.button>
                        </form>
                    </div>
                </div>

                <p class="text-center text-sm text-base-content/60">
                    Cần hỗ trợ? Liên hệ hotline <span class="font-semibold text-base-content">1800 1188</span> hoặc email <span class="font-semibold text-base-content">support@hanoitourist.vn</span>
                </p>
            </div>
        </div>
    </main>
</body>

</html>