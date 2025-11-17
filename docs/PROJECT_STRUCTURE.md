# Cấu trúc dự án Travel Tour

## Tổng quan

Dự án Travel Tour là hệ thống quản lý và đặt tour du lịch được xây dựng trên Laravel 10.x

## Cấu trúc Controllers

### Admin Controllers (`app/Http/Controllers/Admin/`)

-   `BangDieuKhienController.php` - Dashboard quản trị
-   `LoaiTourController.php` - Quản lý loại tour
-   `TourController.php` - Quản lý tour
-   `HinhAnhTourController.php` - Quản lý hình ảnh tour
-   `TheLoaiController.php` - Quản lý thể loại tin tức
-   `TrangTinTucController.php` - Quản lý tin tức
-   `NguoiDungController.php` - Quản lý tài khoản
-   `GopYController.php` - Quản lý góp ý
-   `HoaDonController.php` - Quản lý hóa đơn
-   `ThongKeController.php` - Thống kê

### User Controllers (`app/Http/Controllers/User/`)

-   `HomeController.php` - Trang chủ
-   `TourDuLichController.php` - Danh sách và chi tiết tour
-   `TinTucController.php` - Danh sách và chi tiết tin tức
-   `DatTourController.php` - Đặt tour và lịch sử

### Auth Controllers (`app/Http/Controllers/`)

-   `AuthController.php` - Đăng ký, đăng nhập, quản lý profile
-   `AuthForgotController.php` - Quên mật khẩu
-   `AuthResetController.php` - Đặt lại mật khẩu
-   `PaymentController.php` - Thanh toán MoMo
-   `EmailController.php` - Gửi email

## Models (`app/Models/`)

-   `NguoiDung.php` - Người dùng (custom authentication)
-   `User.php` - Laravel default user model
-   `Tour.php` - Tour du lịch
-   `LoaiTour.php` - Loại tour
-   `HinhAnhTour.php` - Hình ảnh tour
-   `DatTour.php` - Đơn đặt tour
-   `HoaDonDatTour.php` - Hóa đơn
-   `Payment.php` - Thanh toán online
-   `TrangTinTuc.php` - Trang tin tức
-   `TheLoai.php` - Thể loại tin tức
-   `GopY.php` - Góp ý khách hàng

## Routes Structure

### Authentication Routes

-   Register, Login, Logout
-   Password Reset
-   Google OAuth

### Public User Routes

-   Homepage
-   Tour listing & details
-   News listing & details
-   About us & Feedback

### Admin Routes (require auth & role)

-   Dashboard
-   Tour Type Management
-   Tour Management
-   Tour Images Management
-   Booking Management
-   Invoice Management
-   Category Management
-   News Management
-   User Management
-   Feedback Management
-   Statistics

### Customer Routes (require auth)

-   Booking History
-   Profile Management
-   Tour Booking & Payment

## Payment Integration

-   **MoMo**: Thanh toán qua ví MoMo (duy nhất)
-   Callback URLs: `/momo/return`, `/momo/notify`

## Views Structure

-   `resources/views/admin/` - Admin views
-   `resources/views/user/` - User views
-   `resources/views/auth/` - Authentication views
-   `resources/views/emails/` - Email templates
-   `resources/views/components/` - Reusable components
-   `resources/views/layouts/` - Layout templates

## Database Backups

-   Location: `database/backups/`
-   Latest backup: `datntravel.sql`

## Frontend Assets

-   CSS Framework: TailwindCSS + DaisyUI
-   JavaScript: Alpine.js
-   Icons: BoxIcons
-   Charts: Chart.js
