<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhTour extends Model
{
    use HasFactory;

    protected $table = 'hinhanh_tour';

    protected $guarded = ['id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, foreignKey: 'id_tour');
    }
}
