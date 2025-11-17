<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Tour | Quên mật khẩu</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">
    <style>[x-cloak]{display:none !important;}</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200">
    <main class="flex min-h-screen items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <div class="text-center">
                <a href="{{ route('homepage') }}" class="btn btn-ghost btn-sm mb-4">
                    ← Trở về trang chủ
                </a>
                <div class="space-y-4">
                    <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary">HANOITOURIST</span>
                    <h1 class="text-3xl font-bold text-base-content">Quên mật khẩu?</h1>
                    <p class="text-base text-base-content/70">Không sao! Nhập email của bạn và chúng tôi sẽ gửi link đặt lại mật khẩu.</p>
                </div>
            </div>

            <div class="mt-8 space-y-6">
                @if(session('status'))
                    <div class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-error">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                @endif

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-6">
                        <form action="{{ route('password.email') }}" method="post" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                            @csrf
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Email đăng ký</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        class="input input-bordered w-full pl-10 @error('email') input-error @enderror" 
                                        placeholder="you@example.com"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        required
                                    >
                                </div>
                                @error('email')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-full">
                                <span x-show="!loading">Gửi link đặt lại mật khẩu</span>
                                <span x-show="loading" x-cloak>
                                    <span class="loading loading-spinner loading-sm"></span>
                                    Đang gửi...
                                </span>
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-base-content/70">
                                Nhớ mật khẩu rồi? 
                                <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Đăng nhập ngay</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-base-100/80 p-4 text-center text-sm text-base-content/60">
                    Cần hỗ trợ? Liên hệ hotline <span class="font-semibold text-base-content">0337265446</span> hoặc email <span class="font-semibold text-base-content">lean1112work2@gmail.com</span>
                </div>
            </div>
        </div>
    </main>
</body>

</html>