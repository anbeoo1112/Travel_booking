@extends('layouts.moldMain-User')

@section('content-min')
<div class="flex flex-col gap-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-base-content">Thông tin cá nhân</h1>
        <p class="mt-2 text-base-content/70">Quản lý thông tin tài khoản của bạn</p>
    </div>

    <x-ui.card class="mx-auto max-w-2xl">
        <div class="flex flex-col items-center space-y-6 text-center">
            <div class="relative">
                <img 
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('frontend/assets/images/avatars/default.png') }}" 
                    alt="Avatar" 
                    class="h-32 w-32 rounded-full border-4 border-base-200 object-cover shadow-lg dark:border-base-300"
                />
                <div class="absolute -bottom-2 -right-2 rounded-full bg-primary p-2 text-primary-content shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <div class="space-y-1">
                <h2 class="text-2xl font-semibold text-base-content">{{ $user->ho_ten }}</h2>
                <p class="text-sm text-base-content/60">{{ $user->vai_tro }}</p>
            </div>

            <div class="grid w-full gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-base-200/50 p-4 text-left dark:bg-base-200/30">
                    <p class="text-sm font-medium text-base-content/70">Tài khoản</p>
                    <p class="mt-1 font-semibold text-base-content">{{ $user->tai_khoan }}</p>
                </div>
                <div class="rounded-lg bg-base-200/50 p-4 text-left dark:bg-base-200/30">
                    <p class="text-sm font-medium text-base-content/70">Email</p>
                    <p class="mt-1 font-semibold text-base-content">{{ $user->email }}</p>
                </div>
                <div class="rounded-lg bg-base-200/50 p-4 text-left sm:col-span-2 dark:bg-base-200/30">
                    <p class="text-sm font-medium text-base-content/70">Số điện thoại</p>
                    <p class="mt-1 font-semibold text-base-content">{{ $user->so_dien_thoai ?: 'Chưa cập nhật' }}</p>
                </div>
            </div>

            <div class="flex w-full gap-3">
                <a href="{{ route('thay_doi_thong_tin_user') }}" class="flex-1">
                    <x-ui.button variant="primary" class="w-full justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Cập nhật thông tin
                    </x-ui.button>
                </a>
                <a href="{{ route('doi_mat_khau_user') }}" class="flex-1">
                    <x-ui.button variant="secondary" class="w-full justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2L2.257 8.257a6 6 0 018.486-8.486L17 6.257V6a2 2 0 012 2z" />
                        </svg>
                        Đổi mật khẩu
                    </x-ui.button>
                </a>
            </div>
        </div>
    </x-ui.card>
</div>
@endsection


