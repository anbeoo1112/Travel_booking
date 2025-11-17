@extends('layouts.moldUser')

@section('content')
<div class="mx-auto mt-24 w-full max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
    <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
        <aside class="flex flex-col gap-4">
            <x-ui.card class="border border-base-200/60 p-0 shadow-none">
                <div class="border-b border-base-200 px-6 py-5">
                    <p class="text-sm font-semibold uppercase tracking-widest text-primary">Tài khoản</p>
                    <h2 class="mt-1 text-xl font-semibold text-base-content">Cài đặt cá nhân</h2>
                    <p class="mt-2 text-sm text-base-content/70">Quản lý thông tin hồ sơ và bảo mật đăng nhập của bạn.</p>
                </div>
                <nav class="flex flex-col gap-1 px-2 py-4 text-sm">
                    <a href="{{ route('thong_tin_ca_nhan_user') }}" class="group flex items-center justify-between rounded-lg px-4 py-3 font-medium transition hover:bg-base-200 {{ request()->routeIs('thong_tin_ca_nhan_user') ? 'bg-primary/10 text-primary' : 'text-base-content/80' }}">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary/15 text-primary/90">TK</span>
                            Thông tin cá nhân
                        </span>
                        <span class="text-base-content/40 transition group-hover:text-base-content/70">&rarr;</span>
                    </a>
                    <a href="{{ route('doi_mat_khau_user') }}" class="group flex items-center justify-between rounded-lg px-4 py-3 font-medium transition hover:bg-base-200 {{ request()->routeIs('doi_mat_khau_user') ? 'bg-primary/10 text-primary' : 'text-base-content/80' }}">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary/15 text-primary/90">MK</span>
                            Đổi mật khẩu
                        </span>
                        <span class="text-base-content/40 transition group-hover:text-base-content/70">&rarr;</span>
                    </a>
                </nav>
            </x-ui.card>
        </aside>

        <section>
            <x-ui.card class="border border-base-200/60 shadow-sm">
                <div class="p-6">
                    @yield('content-min')
                </div>
            </x-ui.card>
        </section>
    </div>
</div>
@endsection