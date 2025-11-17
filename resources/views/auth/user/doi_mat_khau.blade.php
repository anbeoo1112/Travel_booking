@extends('layouts.moldMain-User')

@section('content-min')
<div class="flex flex-col gap-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-base-content">Đổi mật khẩu</h1>
        <p class="mt-2 text-base-content/70">Cập nhật mật khẩu mới để bảo mật tài khoản</p>
    </div>

    <x-ui.card class="mx-auto max-w-lg">
        <form action="{{ url('/doi-mat-khau-user') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-4">
                <x-ui.input
                    name="mat_khau_cu"
                    label="Mật khẩu hiện tại"
                    type="password"
                    autocomplete="current-password"
                    required
                    prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z' /></svg>"
                />

                <x-ui.input
                    name="mat_khau_moi"
                    label="Mật khẩu mới"
                    type="password"
                    autocomplete="new-password"
                    required
                    prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2L2.257 8.257a6 6 0 018.486-8.486L17 6.257V6a2 2 0 012 2z' /></svg>"
                    hint="Mật khẩu ít nhất 8 ký tự, bao gồm chữ và số"
                />

                <x-ui.input
                    name="mat_khau_moi_confirmation"
                    label="Xác nhận mật khẩu mới"
                    type="password"
                    autocomplete="new-password"
                    required
                    prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' /></svg>"
                />
            </div>

            <div class="flex gap-3 pt-4">
                <x-ui.button type="submit" variant="primary" class="flex-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Đổi mật khẩu
                </x-ui.button>
                <a href="{{ route('thong_tin_ca_nhan_user') }}" class="flex-1">
                    <x-ui.button type="button" variant="ghost" class="w-full justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Hủy bỏ
                    </x-ui.button>
                </a>
            </div>
        </form>

        <div class="mt-6 rounded-lg bg-base-200/50 p-4">
            <h3 class="font-medium text-base-content">Lưu ý bảo mật</h3>
            <ul class="mt-2 space-y-1 text-sm text-base-content/70">
                <li>• Sử dụng mật khẩu mạnh với ít nhất 8 ký tự</li>
                <li>• Kết hợp chữ hoa, chữ thường, số và ký tự đặc biệt</li>
                <li>• Không chia sẻ mật khẩu với người khác</li>
                <li>• Thay đổi mật khẩu định kỳ để tăng bảo mật</li>
            </ul>
        </div>
    </x-ui.card>
</div>
@endsection
