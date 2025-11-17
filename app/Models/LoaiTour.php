<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTour extends Model
{
    use HasFactory;

    protected $table = 'loai_tour';

    protected $guarded = ['id'];

    public function tours() {
        return $this->hasMany(\App\Models\Tour::class, 'id_loaitour');
    }
}
