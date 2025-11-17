<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'nguoi_dung';

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];
}
