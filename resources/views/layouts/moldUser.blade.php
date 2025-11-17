<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ mobileOpen: false }" x-bind:class="{ 'overflow-hidden lg:overflow-auto': mobileOpen }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">

    <title>@yield('title', config('app.name', 'Travel Tour'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-base-100 text-base-content antialiased">
    <div class="flex min-h-screen flex-col">
        @php
            $navLinks = [
                [
                    'label' => 'Trang chủ',
                    'route' => 'homepage',
                    'href' => route('homepage'),
                    'active' => request()->routeIs('homepage'),
                ],
                [
                    'label' => 'Tour du lịch',
                    'route' => 'tourDuLich',
                    'href' => route('tourDuLich'),
                    'active' => request()->routeIs('tourDuLich') || request()->routeIs('showTourDuLich'),
                ],
                [
                    'label' => 'Tin tức',
                    'route' => 'tintuc',
                    'href' => route('tintuc'),
                    'active' => request()->routeIs('tintuc') || request()->routeIs('showTinTuc'),
                ],
                [
                    'label' => 'Về chúng tôi',
                    'route' => 'aboutus',
                    'href' => route('aboutus'),
                    'active' => request()->routeIs('aboutus'),
                ],
            ];
        @endphp

        <header class="sticky top-0 z-50 border-b border-base-200 bg-base-100/90 backdrop-blur supports-[backdrop-filter]:bg-base-100/80">
            <div class="container flex h-20 items-center justify-between">
                <div class="flex items-center gap-3">
                    <button type="button" class="btn btn-ghost btn-sm lg:hidden" @click="mobileOpen = !mobileOpen" aria-label="Mở menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <a href="{{ route('homepage') }}" class="inline-flex items-center gap-2 text-lg font-semibold">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-primary/15 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21V3m0 0L3 9m9-6 9 6" />
                            </svg>
                        </span>
                        <span class="hidden sm:inline">Hanoitourist</span>
                    </a>
                </div>

                <nav class="hidden lg:flex items-center gap-1 text-sm font-medium">
                    @foreach($navLinks as $link)
                        <a
                            href="{{ $link['href'] }}"
                            @class([
                                'rounded-full px-4 py-2 transition',
                                'text-primary bg-primary/10' => $link['active'],
                                'text-base-content/70 hover:text-primary hover:bg-primary/10' => ! $link['active'],
                            ])
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-2">
                    <div class="dropdown dropdown-end hidden sm:block" x-data="{ open: false }">
                        <label tabindex="0" class="btn btn-sm btn-ghost gap-2 text-sm" @click="open = !open">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75l8.954 5.373a1.125 1.125 0 001.092 0l8.954-5.373M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.109a1.125 1.125 0 00-.553-.966l-9-5.25a1.125 1.125 0 00-1.194 0l-9 5.25a1.125 1.125 0 00-.553.966V17.25A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            <span class="hidden xl:inline">Chủ đề</span>
                        </label>
                        <ul tabindex="-1" class="menu dropdown-content z-[1] mt-3 w-48 rounded-xl bg-base-100 p-2 shadow-lg">
                            <li><button type="button" @click="$store.uiTheme.setTheme('tropical')" :class="{ 'active': $store.uiTheme.theme === 'tropical' }">Tropical</button></li>
                            <li><button type="button" @click="$store.uiTheme.setTheme('minimal-bw')" :class="{ 'active': $store.uiTheme.theme === 'minimal-bw' }">Minimal BW</button></li>
                            <li><button type="button" @click="$store.uiTheme.setTheme('pastel')" :class="{ 'active': $store.uiTheme.theme === 'pastel' }">Pastel</button></li>
                        </ul>
                    </div>

                    <button type="button" class="btn btn-sm btn-ghost" @click="$store.uiTheme.toggleDark()" :aria-pressed="$store.uiTheme.dark">
                        <span class="sr-only">Đổi chế độ sáng tối</span>
                        <svg x-show="!$store.uiTheme.dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.364 6.364l-1.06-1.06M7.697 7.697 6.636 6.636m0 10.728 1.06-1.06m10.728-10.728-1.06 1.06M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                        </svg>
                        <svg x-show="$store.uiTheme.dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0112 21.75 9.75 9.75 0 0110.5 2.31a9.75 9.75 0 0011.252 12.69z" />
                        </svg>
                    </button>

                    <a href="{{ route('tourDuLich') }}" class="hidden md:inline-flex">
                        <x-ui.button variant="primary" size="sm">Đặt ngay</x-ui.button>
                    </a>

                    @auth
                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full border border-base-300">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('frontend/assets/images/avatars/default.png') }}" alt="Avatar">
                                </div>
                            </label>
                            <ul tabindex="-1" class="menu dropdown-content z-[1] mt-3 w-56 rounded-xl bg-base-100 p-2 shadow-lg">
                                <li class="px-3 py-2 text-sm text-base-content/80">
                                    <div class="font-semibold text-base-content">{{ Auth::user()->ho_ten }}</div>
                                    <div class="text-xs text-base-content/60">{{ Auth::user()->email }}</div>
                                </li>
                                <li><hr class="my-1 border-base-200"></li>
                                <li><a href="{{ route('lichSuDatTour') }}">Lịch sử đặt tour</a></li>
                                <li><a href="{{ route('thong_tin_ca_nhan_user') }}">Thông tin cá nhân</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logoutUser') }}">
                                        @csrf
                                        <button type="submit" class="justify-start">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:inline-flex">
                            <x-ui.button variant="ghost" size="sm">Đăng nhập</x-ui.button>
                        </a>
                        <a href="{{ route('register') }}" class="hidden md:inline-flex">
                            <x-ui.button variant="secondary" size="sm">Đăng ký</x-ui.button>
                        </a>
                    @endauth
                </div>
            </div>

            <div
                class="lg:hidden"
                x-cloak
                x-show="mobileOpen"
                x-transition.opacity
            >
                <div class="fixed inset-0 z-40 bg-base-100/80 backdrop-blur" @click="mobileOpen = false"></div>
                <div class="fixed inset-y-0 left-0 z-50 w-80 max-w-full overflow-y-auto border-r border-base-200 bg-base-100 p-6" x-transition.duration.300ms>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-primary">Hanoitourist</div>
                            <div class="text-xs text-base-content/60">Trải nghiệm du lịch cảm hứng nhiệt đới</div>
                        </div>
                        <button type="button" class="btn btn-ghost btn-sm" aria-label="Đóng menu" @click="mobileOpen = false">
                            ✕
                        </button>
                    </div>
                    <nav class="mt-6 space-y-2">
                        @foreach($navLinks as $link)
                            <a href="{{ $link['href'] }}" class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium transition @if($link['active']) bg-primary text-primary-content shadow @else hover:bg-base-200/70 @endif">
                                <span>{{ $link['label'] }}</span>
                                @if($link['active'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l5 5L20 7" />
                                    </svg>
                                @endif
                            </a>
                        @endforeach
                    </nav>

                    <div class="mt-8 space-y-4">
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" class="btn btn-sm" @click="$store.uiTheme.setTheme('tropical')" :class="{ 'btn-active btn-primary text-primary-content': $store.uiTheme.theme === 'tropical' }">Tropical</button>
                            <button type="button" class="btn btn-sm" @click="$store.uiTheme.setTheme('minimal-bw')" :class="{ 'btn-active btn-primary text-primary-content': $store.uiTheme.theme === 'minimal-bw' }">Minimal</button>
                            <button type="button" class="btn btn-sm" @click="$store.uiTheme.setTheme('pastel')" :class="{ 'btn-active btn-primary text-primary-content': $store.uiTheme.theme === 'pastel' }">Pastel</button>
                            <button type="button" class="btn btn-sm" @click="$store.uiTheme.toggleDark()" :class="{ 'btn-active btn-primary text-primary-content': $store.uiTheme.dark }">Dark mode</button>
                        </div>

                        <a href="{{ route('tourDuLich') }}" class="block">
                            <x-ui.button variant="primary" class="w-full">Đặt tour ngay</x-ui.button>
                        </a>

                        @guest
                            <div class="flex gap-2">
                                <a href="{{ route('login') }}" class="flex-1">
                                    <x-ui.button variant="ghost" class="w-full">Đăng nhập</x-ui.button>
                                </a>
                                <a href="{{ route('register') }}" class="flex-1">
                                    <x-ui.button variant="secondary" class="w-full">Đăng ký</x-ui.button>
                                </a>
                            </div>
                        @else
                            <div class="space-y-2 text-sm text-base-content/80">
                                <div class="font-semibold text-base-content">{{ Auth::user()->ho_ten }}</div>
                                <a href="{{ route('lichSuDatTour') }}" class="block rounded-lg bg-base-200/70 px-4 py-2">Lịch sử đặt tour</a>
                                <a href="{{ route('thong_tin_ca_nhan_user') }}" class="block rounded-lg bg-base-200/70 px-4 py-2">Thông tin cá nhân</a>
                                <form method="POST" action="{{ route('logoutUser') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost btn-sm w-full justify-start">Đăng xuất</button>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="container py-6">
                @if (session('success'))
                    <div class="mb-4">
                        <x-ui.toast variant="success" title="Thành công" dismissible>
                            {{ session('success') }}
                        </x-ui.toast>
                    </div>
                @elseif (session('error'))
                    <div class="mb-4">
                        <x-ui.toast variant="danger" title="Có lỗi" dismissible>
                            {{ session('error') }}
                        </x-ui.toast>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4">
                        <x-ui.toast variant="danger" title="Vui lòng kiểm tra lại" dismissible>
                            <ul class="list-disc space-y-1 pl-5 text-left">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-ui.toast>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="border-t border-base-200 bg-base-100/95 py-12">
            <div class="container grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="space-y-4">
                    <a href="{{ route('homepage') }}" class="inline-flex items-center gap-3 text-lg font-semibold">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-primary/15 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21V3m0 0L3 9m9-6 9 6" />
                            </svg>
                        </span>
                        Hanoitourist
                    </a>
                    <p class="text-sm text-base-content/70">Đồng hành cùng bạn trên mọi hành trình khám phá, với cảm hứng nhiệt đới xanh mát và dịch vụ tận tâm.</p>
                    <div class="flex gap-3 text-base-content/60">
                        <a href="#" class="hover:text-primary" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12.07c0-5.52-4.48-10-10-10s-10 4.48-10 10c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.62.77-1.62 1.56v1.87h2.77l-.44 2.89h-2.33v6.99C18.34 21.19 22 17.06 22 12.07z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-primary" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 2c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2.2A2.8 2.8 0 1110.2 12 2.8 2.8 0 0112 9.2zm4.75-.95a1 1 0 11-1.5-1.3 1 1 0 011.5 1.3z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-primary" aria-label="Youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21.8 8.001a2.749 2.749 0 00-1.94-1.94C18.26 5.75 12 5.75 12 5.75s-6.26 0-7.86.311A2.749 2.749 0 002.2 8.001 28.61 28.61 0 002 12a28.61 28.61 0 00.2 3.999 2.749 2.749 0 001.94 1.94c1.6.311 7.86.311 7.86.311s6.26 0 7.86-.311a2.749 2.749 0 001.94-1.94A28.61 28.61 0 0022 12a28.61 28.61 0 00-.2-3.999zM9.75 14.651V9.35l4.5 2.65-4.5 2.65z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-primary" aria-label="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="space-y-3">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-base-content/80">Du lịch nổi bật</h3>
                    <ul class="space-y-2 text-sm text-base-content/70">
                        <li>Tour miền Bắc</li>
                        <li>Tour biển đảo</li>
                        <li>Combo nghỉ dưỡng</li>
                        <li>Trải nghiệm bản địa</li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-base-content/80">Hỗ trợ khách hàng</h3>
                    <ul class="space-y-2 text-sm text-base-content/70">
                        <li><a href="#" class="hover:text-primary">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="hover:text-primary">Chính sách hủy tour</a></li>
                        <li><a href="#" class="hover:text-primary">Hướng dẫn thanh toán</a></li>
                        <li><a href="{{ route('aboutus') }}" class="hover:text-primary">Liên hệ chúng tôi</a></li>
                    </ul>
                </div>

                <div class="space-y-3">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-base-content/80">Đăng ký nhận tin</h3>
                    <p class="text-sm text-base-content/70">Nhận ưu đãi tour mới nhất và gợi ý hành trình dành riêng cho bạn.</p>
                    <form class="space-y-3">
                        <label class="input input-bordered input-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.94 6.94a.75.75 0 011.06 0L10 12.94l6-6a.75.75 0 111.06 1.06l-6.53 6.53a.75.75 0 01-1.06 0L2.94 8a.75.75 0 010-1.06z" />
                            </svg>
                            <input type="email" placeholder="Email của bạn" class="grow" autocomplete="email">
                        </label>
                        <x-ui.button type="button" variant="primary" size="sm" class="w-full">Đăng ký</x-ui.button>
                    </form>
                </div>
            </div>

            <div class="mt-8 border-t border-base-200 pt-6 text-center text-xs text-base-content/60">
                © {{ now()->year }} Hanoitourist. Giữ tất cả quyền.
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
