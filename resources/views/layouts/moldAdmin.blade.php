<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Travel Management</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/logo/logo1.png') }}">
    
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/styles-admin.css', 'resources/js/styles-admin.js'])
    
    <!-- Flatpickr Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">  
        <a href="{{ route('bangdieukhien') }}" class="brand">
            <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" alt="Logo" class="logo">
            <span class="text">HANOITOURIST</span>
        </a>
        <ul class="side-menu top">
            <li class="{{ request()->routeIs('bangdieukhien') ? 'active' : '' }}">
                <a href="{{ route('bangdieukhien') }}">
                    <i class='bx bxs-dashboard' ></i>
                    <p>{{ __('Bảng Điều Khiển') }}</p>
                </a>
            </li>
            @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Quản Lý Website')
                <li class="{{ request()->routeIs('quanlyloaitour') ? 'active' : '' }}">
                    <a href="{{ route('quanlyloaitour') }}">
                        <i class='bx bx-barcode'></i>
                        <p>{{ __('Quản Lý Loại Tour') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('quanlytour') ? 'active' : '' }}">
                    <a href="{{ route('quanlytour') }}">
                        <i class='bx bx-trip' ></i>
                        <p>{{ __('Quản Lý Tour') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('quanlyhinhanhtour') ? 'active' : '' }}">
                    <a href="{{ route('quanlyhinhanhtour') }}">
                        <i class='bx bx-image-alt'></i>
                        <p>{{ __('Quản Lý Hình Ảnh Tour') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('quanlytheloai') ? 'active' : '' }}">
                    <a href="{{ route('quanlytheloai') }}">
                        <i class='bx bxl-tailwind-css'></i>
                        <p>{{ __('Quản Lý Thể Loại tin tức') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('quanlytrangtintuc') ? 'active' : '' }}">
                    <a href="{{ route('quanlytrangtintuc') }}">
                        <i class='bx bxs-file' ></i>
                        <p>{{ __('Quản Lý Trang Tin Tức') }}</p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Chăm Sóc Khách Hàng')
                <li class="{{ request()->routeIs('quanlydattour') ? 'active' : '' }}">
                    <a href="{{ route('quanlydattour') }}">
                        <i class='bx bxs-map-pin' ></i>
                        <p>{{ __('Quản Lý Đặt Tour') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('hoadondattour') ? 'active' : '' }}">
                    <a href="{{ route('hoadondattour') }}">
                        <i class='bx bxs-folder-open'></i>
                        <p>{{ __('Quản Lý Hóa Đơn') }}</p>
                    </a>
                </li>
                <li class="{{ request()->routeIs('quanlygopy') ? 'active' : '' }}">
                    <a href="{{ route('quanlygopy') }}">
                        <i class='bx bxs-copy-alt'></i>
                        <p>{{ __('Quản Lý Góp Ý') }}</p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->vai_tro === 'admin')
                <li class="{{ request()->routeIs('quanlytaikhoan') ? 'active' : '' }}">
                    <a href="{{ route('quanlytaikhoan') }}">
                        <i class='bx bxs-group' ></i>
                        <p>{{ __('Quản Lý Tài Khoản') }}</p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Thống Kê') <!-- Check if the role is admin -->
                <li class="{{ request()->routeIs('thongke') ? 'active' : '' }}">
                    <a href="{{ route('thongke') }}">
                        <i class='bx bx-bar-chart-square' ></i>
                        <p>{{ __('Thống Kê') }}</p>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
			<i class='bx bx-menu' id="list-nav"></i>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="profile" id="profile-link" style="text-decoration: none">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('frontend/assets/images/avatars/default.png') }}" alt="Avatar" />
                <span>{{ Auth::user()->ho_ten }}</span>
            </a>
            <ul class="dropdown-menu" id="profile-dropdown" style="left:88%; top:100%;">
                <li>
                    <a href="{{ route('thong_tin_ca_nhan') }}" class="dropdown-item d-flex align-items-center">
                        <i class='bx bx-book-alt'></i>
                        <span>{{ __('Thông Tin Cá Nhân') }}</span>
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="" class="dropdown-item d-flex align-items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class='bx bx-log-out'></i>
                            <span>{{ __('Đăng Xuất') }}</span>
                        </a>
                    </form>
                </li>
            </ul>
		</nav>
        <!-- NAVBAR -->
        <main>
            @yield('content')
		</main>
    </div>
</div>

<!-- Flatpickr Script -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Vietnamese locale for Flatpickr
    flatpickr.localize({
        weekdays: {
            shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            longhand: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
        },
        months: {
            shorthand: ["Th1", "Th2", "Th3", "Th4", "Th5", "Th6", "Th7", "Th8", "Th9", "Th10", "Th11", "Th12"],
            longhand: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
        },
        ordinal: () => "",
        firstDayOfWeek: 1,
        rangeSeparator: " đến ",
        weekAbbreviation: "Tuần",
        scrollTitle: "Cuộn để thay đổi",
        toggleTitle: "Nhấn để bật/tắt"
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all date inputs with Flatpickr
        const dateInputs = document.querySelectorAll('input[type="date"].form-control');
        dateInputs.forEach(input => {
            flatpickr(input, {
                enableTime: false,
                dateFormat: 'Y-m-d',
                minDate: new Date(),
                disableMobile: false,
                static: false,
            });
        });
    });
</script>

</body>
</html>
    </section>
</body>
</html>