<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

class NguoiDung extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPasswordTrait;

    protected $table = 'nguoi_dung';

    // Khóa chính là ma_tour (không phải id mặc định)
    protected $primaryKey = 'id';

    public $incrementing = false; // Không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa chính là chuỗi

    protected $fillable = [
        'id',
        'ho_ten',
        'tai_khoan',
        'mat_khau',
        'so_dien_thoai',
        'email',
        'avatar',
        'vai_tro',
        'dang_nhap_qua',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    public function datTours()
    {
        return $this->hasMany(DatTour::class, 'id_nguoidung');
    }

    public function datTour()
    {
        return $this->hasMany(DatTour::class, 'id_nguoidung');
    }

    public function trangTinTucs()
    {
        return $this->hasMany(TrangTinTuc::class, 'id_nguoidung');
    }

    /**
     * Get the e-mail address where password reset links are sent.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Get the password for authentication (required for password reset).
     * Laravel cần method này để xác thực password reset.
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
