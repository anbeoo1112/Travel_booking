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
    
    <!-- Bootstrap JS (for modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin Modal & Sidebar Styles -->
    <style>
        /* Modal backdrop styling */
        .modal-backdrop.show {
            opacity: 0.3 !important;
            background-color: #000 !important;
            z-index: 1040 !important;
        }
        
        .modal {
            z-index: 1050 !important;
        }
        
        .modal-content {
            background: white !important;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px 8px 0 0;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        .modal-body {
            padding: 20px;
        }

        /* ========================================
           SIDEBAR ACCORDION MENU - COMPLETE FIX
           ======================================== */
        
        /* Menu Group Container */
        #sidebar .side-menu li.menu-group {
            height: auto !important;
            margin: 4px 0;
            padding: 0;
            background: transparent !important;
            margin-left: 0 !important;
            border-radius: 0 !important;
        }

        /* Group Label (Header) */
        #sidebar .side-menu li.menu-group > .group-label {
            padding: 10px 24px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: transparent;
        }

        #sidebar .side-menu li.menu-group > .group-label:hover {
            color: var(--blue);
        }

        #sidebar .side-menu li.menu-group > .group-label i:first-child {
            min-width: calc(60px - ((4px + 6px) * 2));
            display: flex;
            justify-content: center;
            font-size: 18px;
        }

        #sidebar .side-menu li.menu-group > .group-label i.toggle-icon {
            margin-left: auto;
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        #sidebar .side-menu li.menu-group.collapsed > .group-label i.toggle-icon {
            transform: rotate(-90deg);
        }

        /* Submenu Container */
        #sidebar .side-menu li.menu-group .submenu {
            max-height: 600px;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, opacity 0.3s ease;
            opacity: 1;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebar .side-menu li.menu-group.collapsed .submenu {
            max-height: 0;
            opacity: 0;
        }

        /* Submenu Items */
        #sidebar .side-menu li.menu-group .submenu li {
            height: 48px !important;
            background: transparent !important;
            margin-left: 0 !important;
            border-radius: 0 !important;
            padding: 0 !important;
        }

        #sidebar .side-menu li.menu-group .submenu li a {
            width: 100% !important;
            height: 100% !important;
            padding: 0 16px 0 24px !important;
            font-size: 14px !important;
            color: var(--dark) !important;
            background: var(--light) !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px;
            border-radius: 0 !important;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }

        #sidebar .side-menu li.menu-group .submenu li a i {
            min-width: calc(60px - ((4px + 6px) * 2));
            display: flex;
            justify-content: center;
            font-size: 18px;
        }

        #sidebar .side-menu li.menu-group .submenu li a p {
            color: inherit !important;
            margin: 0 !important;
            white-space: nowrap;
        }

        #sidebar .side-menu li.menu-group .submenu li a:hover {
            color: var(--blue) !important;
            border-left-color: var(--blue);
            padding-left: 28px !important;
        }

        #sidebar .side-menu li.menu-group .submenu li.active a {
            color: var(--blue) !important;
            background: var(--grey) !important;
            border-left-color: var(--blue);
            font-weight: 600;
        }

        /* Collapsed Sidebar State */
        #sidebar.hide .side-menu li.menu-group {
            margin: 2px 0;
        }

        #sidebar.hide .side-menu li.menu-group > .group-label {
            width: calc(60px - 8px);
            padding: 12px;
            justify-content: center;
            overflow: hidden;
        }

        #sidebar.hide .side-menu li.menu-group > .group-label span,
        #sidebar.hide .side-menu li.menu-group > .group-label i.toggle-icon {
            display: none;
        }

        #sidebar.hide .side-menu li.menu-group > .group-label i:first-child {
            margin: 0;
            min-width: 24px;
        }

        #sidebar.hide .side-menu li.menu-group .submenu {
            display: none;
        }

        #sidebar.hide .side-menu > li:not(.menu-group) > a p {
            display: none;
        }

        /* Tooltips for Collapsed State */
        #sidebar.hide .side-menu li a:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 10px;
            padding: 8px 12px;
            background: var(--dark);
            color: white;
            border-radius: 6px;
            white-space: nowrap;
            font-size: 14px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            pointer-events: none;
        }

        #sidebar.hide .side-menu li a:hover::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 4px;
            border: 6px solid transparent;
            border-right-color: var(--dark);
            z-index: 9999;
            pointer-events: none;
        }

        #sidebar.hide .side-menu li.menu-group > .group-label:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 10px;
            padding: 8px 12px;
            background: var(--dark);
            color: white;
            border-radius: 6px;
            white-space: nowrap;
            font-size: 14px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            pointer-events: none;
        }

        #sidebar.hide .side-menu li.menu-group > .group-label:hover::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 4px;
            border: 6px solid transparent;
            border-right-color: var(--dark);
            z-index: 9999;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">  
        <a href="{{ route('bangdieukhien') }}" class="brand">
            <img src="{{ asset('frontend/assets/images/logo/logo1.png') }}" alt="Logo" class="logo">
            <span class="text">HANOITOURIST</span>
        </a>
        <ul class="side-menu top">
            <!-- Dashboard -->
            <li class="{{ request()->routeIs('bangdieukhien') ? 'active' : '' }}">
                <a href="{{ route('bangdieukhien') }}" data-title="Bảng Điều Khiển">
                    <i class='bx bxs-dashboard'></i>
                    <p>{{ __('Bảng Điều Khiển') }}</p>
                </a>
            </li>

            @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Quản Lý Website')
                <!-- Tour Management Group -->
                <li class="menu-group">
                    <div class="group-label" data-title="Quản Lý Tour">
                        <i class='bx bx-package'></i>
                        <span>QUẢN LÝ TOUR</span>
                        <i class='bx bx-chevron-down toggle-icon'></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('quanlytour') ? 'active' : '' }}">
                            <a href="{{ route('quanlytour') }}" data-title="Tours">
                                <i class='bx bx-trip'></i>
                                <p>{{ __('Tours') }}</p>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('quanlyloaitour') ? 'active' : '' }}">
                            <a href="{{ route('quanlyloaitour') }}" data-title="Loại Tour">
                                <i class='bx bx-category'></i>
                                <p>{{ __('Loại Tour') }}</p>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('quanlyhinhanhtour') ? 'active' : '' }}">
                            <a href="{{ route('quanlyhinhanhtour') }}" data-title="Hình Ảnh">
                                <i class='bx bx-image-alt'></i>
                                <p>{{ __('Hình Ảnh') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Content Management Group -->
                <li class="menu-group">
                    <div class="group-label" data-title="Nội Dung">
                        <i class='bx bx-news'></i>
                        <span>NỘI DUNG</span>
                        <i class='bx bx-chevron-down toggle-icon'></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('quanlytrangtintuc') ? 'active' : '' }}">
                            <a href="{{ route('quanlytrangtintuc') }}" data-title="Tin Tức">
                                <i class='bx bx-file'></i>
                                <p>{{ __('Tin Tức') }}</p>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('quanlytheloai') ? 'active' : '' }}">
                            <a href="{{ route('quanlytheloai') }}" data-title="Thể Loại">
                                <i class='bx bx-bookmarks'></i>
                                <p>{{ __('Thể Loại') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Chăm Sóc Khách Hàng')
                <!-- Business Operations Group -->
                <li class="menu-group">
                    <div class="group-label" data-title="Kinh Doanh">
                        <i class='bx bx-briefcase'></i>
                        <span>KINH DOANH</span>
                        <i class='bx bx-chevron-down toggle-icon'></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('quanlydattour') ? 'active' : '' }}">
                            <a href="{{ route('quanlydattour') }}" data-title="Đặt Tour">
                                <i class='bx bx-map-pin'></i>
                                <p>{{ __('Đặt Tour') }}</p>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('hoadondattour') ? 'active' : '' }}">
                            <a href="{{ route('hoadondattour') }}" data-title="Hóa Đơn">
                                <i class='bx bx-receipt'></i>
                                <p>{{ __('Hóa Đơn') }}</p>
                            </a>
                        </li>
                        @if(auth()->user()->vai_tro === 'admin' || auth()->user()->vai_tro === 'Nhân Viên Thống Kê')
                            <li class="{{ request()->routeIs('thongke') ? 'active' : '' }}">
                                <a href="{{ route('thongke') }}" data-title="Thống Kê">
                                    <i class='bx bx-bar-chart-alt-2'></i>
                                    <p>{{ __('Thống Kê') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <!-- Customer Service Group -->
                <li class="menu-group">
                    <div class="group-label" data-title="Khách Hàng">
                        <i class='bx bx-support'></i>
                        <span>KHÁCH HÀNG</span>
                        <i class='bx bx-chevron-down toggle-icon'></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('quanlygopy') ? 'active' : '' }}">
                            <a href="{{ route('quanlygopy') }}" data-title="Góp Ý">
                                <i class='bx bx-message-dots'></i>
                                <p>{{ __('Góp Ý') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->vai_tro === 'admin')
                <!-- System Group -->
                <li class="menu-group">
                    <div class="group-label" data-title="Hệ Thống">
                        <i class='bx bx-cog'></i>
                        <span>HỆ THỐNG</span>
                        <i class='bx bx-chevron-down toggle-icon'></i>
                    </div>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('quanlytaikhoan') ? 'active' : '' }}">
                            <a href="{{ route('quanlytaikhoan') }}" data-title="Tài Khoản">
                                <i class='bx bx-user-circle'></i>
                                <p>{{ __('Tài Khoản') }}</p>
                            </a>
                        </li>
                    </ul>
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
    </section>

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

        // Sidebar Accordion Menu
        const menuGroups = document.querySelectorAll('#sidebar .menu-group');
        
        menuGroups.forEach(group => {
            const label = group.querySelector('.group-label');
            const submenu = group.querySelector('.submenu');
            
            // Check if any submenu item is active
            const hasActiveItem = submenu.querySelector('li.active');
            if (!hasActiveItem) {
                group.classList.add('collapsed');
            }
            
            // Toggle on click
            label.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Close other groups (optional - remove if you want multiple open)
                menuGroups.forEach(otherGroup => {
                    if (otherGroup !== group) {
                        otherGroup.classList.add('collapsed');
                    }
                });
                
                // Toggle current group
                group.classList.toggle('collapsed');
            });
        });

        // Smooth scroll to active item
        const activeItem = document.querySelector('#sidebar .side-menu li.active');
        if (activeItem) {
            activeItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    });
</script>

</body>
</html>