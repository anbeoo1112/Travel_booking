<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tour';

    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 
        'id_LoaiTour', 
        'ten_tour',
        'thoigian_tour', 
        'slug',
        'noi_khoi_hanh', 
        'ngay_bat_dau',
        'gia', 
        'mo_ta',
    ];

    public function hinhAnhTours()
    {
        return $this->hasMany(HinhAnhTour::class, 'id_tour');
    }

    public function loaiTour()
    {
        return $this->belongsTo(LoaiTour::class, 'id_LoaiTour');
    }

    public function datTours()
    {
        return $this->hasMany(DatTour::class, 'id_tour');
    }
}
