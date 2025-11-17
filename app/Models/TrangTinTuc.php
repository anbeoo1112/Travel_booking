<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrangTinTuc extends Model
{
    use HasFactory;

    protected $table = 'trang_tintuc';

    protected $guarded = [];

    public function theLoai()
    {
        return $this->belongsTo(TheLoai::class, 'id_theloai');
    }

    // TrangTinTuc.php
public function nguoiDung()
{
    return $this->belongsTo(NguoiDung::class, 'id_nguoidung', 'id');
}

// NguoiDung.php
public function trangTinTucs()
{
    return $this->hasMany(TrangTinTuc::class, 'id_nguoidung', 'id');
}

    public function incrementReadCount() {
        $this->doc++;
        return $this->save();
    }
}
