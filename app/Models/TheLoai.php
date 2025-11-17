<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;

    protected $table = 'the_loai';

    protected $guarded = ['id'];

    public function trangTinTucs()
    {
        return $this->hasMany(TrangTinTuc::class, 'id_theloai');
    }
}
