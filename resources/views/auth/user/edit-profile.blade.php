@extends('layouts.moldMain-User')

@section('content-min')
<div class="flex flex-col gap-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-base-content">Cập nhật thông tin cá nhân</h1>
        <p class="mt-2 text-base-content/70">Chỉnh sửa thông tin tài khoản của bạn</p>
    </div>

    <x-ui.card class="mx-auto max-w-2xl">
        <form action="{{ url('/thay-doi-thong-tin-user') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="flex justify-center">
                <div class="relative">
                    <img 
                        id="avatar-preview"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('frontend/assets/images/avatars/default.png') }}" 
                        alt="Avatar preview" 
                        class="h-24 w-24 rounded-full border-4 border-base-200 object-cover"
                    />
                    <label for="avatar" class="absolute -bottom-2 -right-2 cursor-pointer rounded-full bg-primary p-2 text-primary-content transition hover:bg-primary/90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input 
                            type="file" 
                            id="avatar" 
                            name="avatar" 
                            accept="image/*" 
                            class="hidden"
                            onchange="previewAvatar(this)"
                        />
                    </label>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-ui.input
                        name="ho_ten"
                        label="Họ và tên"
                        type="text"
                        value="{{ old('ho_ten', $user->ho_ten) }}"
                        required
                        prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' /></svg>"
                    />
                </div>

                <x-ui.input
                    name="email"
                    label="Email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207' /></svg>"
                />

                <x-ui.input
                    name="so_dien_thoai"
                    label="Số điện thoại"
                    type="tel"
                    value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}"
                    prefixIcon="<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z' /></svg>"
                />
            </div>

            <div class="flex gap-3 pt-4">
                <x-ui.button type="submit" variant="primary" class="flex-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Cập nhật thông tin
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
    </x-ui.card>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection