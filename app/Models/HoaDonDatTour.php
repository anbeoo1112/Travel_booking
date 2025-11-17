<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonDatTour extends Model
{
    use HasFactory;

    protected $table = 'hoadondattour';

    protected $primaryKey = 'id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'id_dattour',
        'phuong_thuc_thanh_toan',
        'trang_thai',
    ];

    public function datTour()
    {
        return $this->belongsTo(DatTour::class, 'id_dattour');
    }
}
