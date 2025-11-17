<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatTour extends Model
{
    use HasFactory;

    protected $table = 'dat_tour';

    // Khóa chính là ma_tour (không phải id mặc định)
    protected $primaryKey = 'id';

    public $incrementing = false; // Không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa chính là chuỗi

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_nguoidung',
        'id_khachhang',
        'id_tour',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'so_nguoi',
        'ngay_di',
        'trang_thai_dattour',
        'payment_status',
        'ngay_dat_tour',
        'ngay_huy_tour'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung');
    }

    public function nguoiDungs()
    {
        return $this->belongsTo(NguoiDung::class, 'id_khachhang');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id', 'id');
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'id')->latestOfMany();
    }

    public function hoaDon()
    {
        return $this->hasOne(HoaDonDatTour::class, 'id_dattour', 'id');
    }
}
