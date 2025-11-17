<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\LoaiTourController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HinhAnhTourController;
use App\Http\Controllers\Admin\TheLoaiController;
use App\Http\Controllers\Admin\TrangTinTucController;
use App\Http\Controllers\Admin\NguoiDungController;
use App\Http\Controllers\Admin\GopYController;
use App\Http\Controllers\Admin\BangDieuKhienController;
use App\Http\Controllers\Admin\HoaDonController;
use App\Http\Controllers\Admin\ThongKeController;

// User Controllers
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\TourDuLichController;
use App\Http\Controllers\User\TinTucController;
use App\Http\Controllers\User\DatTourController;

// Auth & Other Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthForgotController;
use App\Http\Controllers\AuthResetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmailController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::post('/gopy/phanhoi/{id}', [EmailController::class, 'sendEmail'])->name('guiPhanHoi');

// Register & Login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Password Reset
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [AuthForgotController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [AuthForgotController::class, 'store'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [AuthResetController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [AuthResetController::class, 'store'])->middleware('throttle:5,1')->name('password.update');
});

// Logout
Route::post('/logout-user', [AuthController::class, 'logoutUser'])->name('logoutUser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('auth/google', [AuthController::class, 'dieuHuongDenGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'xuLyGoogle']);

/*
|--------------------------------------------------------------------------
| Payment Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/momo/return', [PaymentController::class, 'momoReturn'])->name('momo.return');
Route::post('/momo/notify', [PaymentController::class, 'momoNotify'])->name('momo.notify');

/*
|--------------------------------------------------------------------------
| User Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Tours
Route::get('/tourdulich', [TourDuLichController::class, 'index'])->name('tourDuLich');
Route::get('/tim-kiem-tour', [TourDuLichController::class, 'timKiemTour'])->name('tim-kiem-tour');
Route::get('tourdulich/{tour:slug}', [TourDuLichController::class, 'show'])->name('showTourDuLich');

// News
Route::get('/tintuc', [TinTucController::class, 'index'])->name('tintuc');
Route::post('/tim-kiem-tin-tuc', [TinTucController::class, 'timKiemTinTuc']);
Route::get('/tintuc/{trangTinTuc:slug}', [TinTucController::class, 'show'])->name('showTinTuc')->middleware('increment.doc');

// About & Feedback
Route::get('/aboutus', function () {
    return view('user.aboutus');
})->name('aboutus');
Route::post('/aboutus/gopy', [GopYController::class, 'store'])->name('guiGopY');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'role:admin|Nhân Viên Quản Lý Website|Nhân Viên Chăm Sóc Khách Hàng|Nhân Viên Thống Kê']], function () {
    // Dashboard
    Route::get('/bangdieukhien', [BangDieuKhienController::class, 'index'])->name('bangdieukhien');

    // Tour Type Management
    Route::resource('quanlyloaitour', LoaiTourController::class)->except(['show'])->names([
        'create' => 'them_loai_tour',
        'store' => 'luu_loai_tour',
        'update' => 'cap_nhat_loai_tour',
        'destroy' => 'xoa_loai_tour',
    ]);
    Route::get('/quanlyloaitour', [LoaiTourController::class, 'index'])->name('quanlyloaitour');

    // Tour Management
    Route::resource('quanlytour', TourController::class)->except(['show'])->names([
        'create' => 'them_tour',
        'store' => 'luu_tour',
        'update' => 'cap_nhat_tour',
        'destroy' => 'xoa_tour',
    ]);
    Route::get('/quanlytour', [TourController::class, 'index'])->name('quanlytour');

    // Tour Images Management
    Route::resource('quanlyhinhanhtour', HinhAnhTourController::class)->except(['show'])->names([
        'create' => 'them_hinh_anh_tour',
        'store' => 'luu_hinh_anh_tour',
        'update' => 'cap_nhat_hinh_anh_tour',
        'destroy' => 'xoa_hinh_anh_tour',
    ]);
    Route::get('/quanlyhinhanhtour', [HinhAnhTourController::class, 'index'])->name('quanlyhinhanhtour');

    // Booking Management
    Route::get('/quanlydattour', [DatTourController::class, 'index'])->name('quanlydattour');
    Route::patch('/quanlydattour/{id}/xac-nhan', [DatTourController::class, 'xacNhan'])->name('xac_nhan_dat_tour');
    Route::patch('/quanlydattour/{id}/huy', [DatTourController::class, 'huy'])->name('huy_dat_tour');

    // Invoice Management
    Route::get('/hoadon', [HoaDonController::class, 'index'])->name('hoadondattour');
    Route::put('/hoadon/{id}', [HoaDonController::class, 'update'])->name('cap_nhat_hoa_don');

    // Category Management
    Route::resource('quanlytheloai', TheLoaiController::class)->except(['show'])->names([
        'create' => 'them_the_loai',
        'store' => 'luu_the_loai',
        'update' => 'cap_nhat_the_loai',
        'destroy' => 'xoa_the_loai',
    ]);
    Route::get('/quanlytheloai', [TheLoaiController::class, 'index'])->name('quanlytheloai');

    // News Management
    Route::resource('quanlytrangtintuc', TrangTinTucController::class)->except(['show'])->names([
        'create' => 'them_trang_tin_tuc',
        'store' => 'luu_trang_tin_tuc',
        'update' => 'cap_nhat_trang_tin_tuc',
        'destroy' => 'xoa_trang_tin_tuc',
    ]);
    Route::get('/quanlytrangtintuc', [TrangTinTucController::class, 'index'])->name('quanlytrangtintuc');

    // User Management
    Route::resource('quanlytaikhoan', NguoiDungController::class)->except(['show'])->names([
        'create' => 'them_tai_khoan',
        'store' => 'luu_tai_khoan',
        'update' => 'cap_nhat_tai_khoan',
        'destroy' => 'xoa_tai_khoan',
    ]);
    Route::get('/quanlytaikhoan', [NguoiDungController::class, 'index'])->name('quanlytaikhoan');

    // Feedback Management
    Route::get('/quanlygopy', [GopYController::class, 'index'])->name('quanlygopy');

    // Statistics
    Route::get('/thongke', [ThongKeController::class, 'index'])->name('thongke');
    Route::get('/thong-ke-dat-tour', [TinTucController::class, 'statistic'])->name('thong-ke-dat-tour');

    // Admin Profile
    Route::get('/thong-tin-ca-nhan', [AuthController::class, 'showProfile'])->name('thong_tin_ca_nhan');
    Route::get('/thay-doi-thong-tin', [AuthController::class, 'edit'])->name('thay_doi_thong_tin');
    Route::post('/thay-doi-thong-tin', [AuthController::class, 'update']);
    Route::get('/doi-mat-khau', [AuthController::class, 'showChangePasswordForm'])->name('doi_mat_khau');
    Route::post('/doi-mat-khau', [AuthController::class, 'changePassword']);
});

/*
|--------------------------------------------------------------------------
| Customer Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'role:Khách Hàng']], function () {
    // Booking History
    Route::get('/lich-su-dat-tour', [DatTourController::class, 'indexUser'])->name('lichSuDatTour');
    Route::post('/huy-dat-tour/{id}', [DatTourController::class, 'huyUser'])->name('huyDatTour');

    // Customer Profile
    Route::get('/thong-tin-ca-nhan-user', [AuthController::class, 'showProfileUser'])->name('thong_tin_ca_nhan_user');
    Route::get('/thay-doi-thong-tin-user', [AuthController::class, 'editUser'])->name('thay_doi_thong_tin_user');
    Route::post('/thay-doi-thong-tin-user', [AuthController::class, 'updateUser']);
    Route::get('/doi-mat-khau-user', [AuthController::class, 'showChangePasswordFormUser'])->name('doi_mat_khau_user');
    Route::post('/doi-mat-khau-user', [AuthController::class, 'changePasswordUser']);

    // Booking & Payment
    Route::post('/dattour', [DatTourController::class, 'store'])->name('datTour');
    Route::post('/momo/pay', [PaymentController::class, 'createMomoPayment'])->name('momo.pay');
});
