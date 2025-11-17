<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiTourController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HinhAnhTourController;
use App\Http\Controllers\DatTourController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\TrangTinTucController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\GopYController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourDuLichController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BangDieuKhienController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthForgotController;
use App\Http\Controllers\AuthResetController;
use App\Http\Controllers\PaymentController;


Route::post('/gopy/phanhoi/{id}', [EmailController::class, 'sendEmail'])->name('guiPhanHoi');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Quên mật khẩu - Guest only
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [AuthForgotController::class, 'create'])
        ->name('password.request');
    Route::post('/forgot-password', [AuthForgotController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.email');
    Route::get('/reset-password/{token}', [AuthResetController::class, 'create'])
        ->name('password.reset');
    Route::post('/reset-password', [AuthResetController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('password.update');
});

Route::post('/logout-user', [AuthController::class, 'logoutUser'])->name('logoutUser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/google', [AuthController::class, 'dieuHuongDenGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'xuLyGoogle']);

// Momo return & notify routes (không cần auth)
Route::get('/momo/return', [PaymentController::class, 'momoReturn'])->name('momo.return');
Route::post('/momo/notify', [PaymentController::class, 'momoNotify'])->name('momo.notify');

//Phía user
Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/tourdulich', [TourDuLichController::class, 'index'])->name('tourDuLich');
Route::get('/tim-kiem-tour', [TourDuLichController::class, 'timKiemTour'])->name('tim-kiem-tour');
Route::get('tourdulich/{tour:slug}', [TourDuLichController::class, 'show'])->name('showTourDuLich');

Route::get('/tintuc', [TinTucController::class, 'index'])->name('tintuc');
Route::post('/tim-kiem-tin-tuc', [TinTucController::class, 'timKiemTinTuc']);
Route::get('/tintuc/{trangTinTuc:slug}', [TinTucController::class, 'show'])->name('showTinTuc')->middleware('increment.doc');

Route::get('/aboutus', function () {
    return view('user.aboutus');
})->name('aboutus');

Route::post('/aboutus/gopy', [GopYController::class, 'store'])->name('guiGopY');

//Phía admin cần quyền
Route::group(['middleware' => ['auth', 'role:admin|Nhân Viên Quản Lý Website|Nhân Viên Chăm Sóc Khách Hàng|Nhân Viên Thống Kê']], function () {
    Route::get('/bangdieukhien', [BangDieuKhienController::class, 'index'])->name('bangdieukhien');
    // Quản lý loại tour
    Route::resource('quanlyloaitour', LoaiTourController::class)->except(['show'])->names([
        'create' => 'them_loai_tour',
        'store' => 'luu_loai_tour',
        'update' => 'cap_nhat_loai_tour',
        'destroy' => 'xoa_loai_tour',
    ]);

    // Quản lý tour
    Route::resource('quanlytour', TourController::class)->except(['show'])->names([
        'create' => 'them_tour',
        'store' => 'luu_tour',
        'update' => 'cap_nhat_tour',
        'destroy' => 'xoa_tour',
    ]);

    // Quản lý hình ảnh tour
    Route::resource('quanlyhinhanhtour', HinhAnhTourController::class)->except(['show'])->names([
        'create' => 'them_hinh_anh_tour',
        'store' => 'luu_hinh_anh_tour',
        'update' => 'cap_nhat_hinh_anh_tour',
        'destroy' => 'xoa_hinh_anh_tour',
    ]);

    // Xác nhận và hủy đặt tour
    Route::patch('/quanlydattour/{id}/xac-nhan', [DatTourController::class, 'xacNhan'])->name('xac_nhan_dat_tour');
    Route::patch('/quanlydattour/{id}/huy', [DatTourController::class, 'huy'])->name('huy_dat_tour');

    Route::get('/hoadon', [HoaDonController::class, 'index'])->name('hoadondattour');
    Route::put('/hoadon/{id}', [HoaDonController::class, 'update'])->name('cap_nhat_hoa_don');

    // Quản lý thể loại
    Route::resource('quanlytheloai', TheLoaiController::class)->except(['show'])->names([
        'create' => 'them_the_loai',
        'store' => 'luu_the_loai',
        'update' => 'cap_nhat_the_loai',
        'destroy' => 'xoa_the_loai',
    ]);

    // Quản lý trang tin tức
    Route::resource('quanlytrangtintuc', TrangTinTucController::class)->except(['show'])->names([
        'create' => 'them_trang_tin_tuc',
        'store' => 'luu_trang_tin_tuc',
        'update' => 'cap_nhat_trang_tin_tuc',
        'destroy' => 'xoa_trang_tin_tuc',
    ]);

    // Quản lý tài khoản
    Route::resource('quanlytaikhoan', NguoiDungController::class)->except(['show'])->names([
        'create' => 'them_tai_khoan',
        'store' => 'luu_tai_khoan',
        'update' => 'cap_nhat_tai_khoan',
        'destroy' => 'xoa_tai_khoan',
    ]);

    Route::get('/thongke', [ThongKeController::class, 'index'])->name('thongke');

    // Các route cho danh sách
    Route::get('/quanlyloaitour', [LoaiTourController::class, 'index'])->name('quanlyloaitour');
    Route::get('/quanlytour', [TourController::class, 'index'])->name('quanlytour');
    Route::get('/quanlyhinhanhtour', [HinhAnhTourController::class, 'index'])->name('quanlyhinhanhtour');
    Route::get('/quanlydattour', [DatTourController::class, 'index'])->name('quanlydattour');
    Route::get('/quanlytheloai', [TheLoaiController::class, 'index'])->name('quanlytheloai');
    Route::get('/quanlytrangtintuc', [TrangTinTucController::class, 'index'])->name('quanlytrangtintuc');
    Route::get('/quanlytaikhoan', [NguoiDungController::class, 'index'])->name('quanlytaikhoan');
    Route::get('/quanlygopy', [GopYController::class, 'index'])->name('quanlygopy');

    Route::get('/thong-ke-dat-tour', [TinTucController::class, 'statistic'])->name('thong-ke-dat-tour');
    Route::get('/thong-tin-ca-nhan', [AuthController::class, 'showProfile'])->middleware('auth')->name('thong_tin_ca_nhan');
    Route::get('/thay-doi-thong-tin', [AuthController::class, 'edit'])->middleware('auth')->name('thay_doi_thong_tin');
    Route::post('/thay-doi-thong-tin', [AuthController::class, 'update'])->middleware('auth');
    Route::get('/doi-mat-khau', [AuthController::class, 'showChangePasswordForm'])->middleware('auth')->name('doi_mat_khau');
    Route::post('/doi-mat-khau', [AuthController::class, 'changePassword'])->middleware('auth');
});

//Phía user cần quyền
Route::group(['middleware' => ['auth', 'role:Khách Hàng']], function () {
    Route::get('/lich-su-dat-tour', [DatTourController::class, 'indexUser'])->middleware('auth')->name('lichSuDatTour');
    Route::post('/huy-dat-tour/{id}', [DatTourController::class, 'huyUser'])->name('huyDatTour');

    Route::get('/thong-tin-ca-nhan-user', [AuthController::class, 'showProfileUser'])->middleware('auth')->name('thong_tin_ca_nhan_user');

    Route::get('/thay-doi-thong-tin-user', [AuthController::class, 'editUser'])->middleware('auth')->name('thay_doi_thong_tin_user');
    Route::post('/thay-doi-thong-tin-user', [AuthController::class, 'updateUser'])->middleware('auth');

    Route::get('/doi-mat-khau-user', [AuthController::class, 'showChangePasswordFormUser'])->middleware('auth')->name('doi_mat_khau_user');
    Route::post('/doi-mat-khau-user', [AuthController::class, 'changePasswordUser'])->middleware('auth');

    Route::post('/dattour', [DatTourController::class, 'store'])->middleware('auth')->name('datTour');

    Route::post('/momo/pay', [PaymentController::class, 'createMomoPayment'])
        ->name('momo.pay');
});
