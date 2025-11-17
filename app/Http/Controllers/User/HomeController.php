<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\TrangTinTuc;
use App\Models\HinhAnhTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::with('hinhAnhTours')->get();
        $trangTinTucs = TrangTinTuc::get()->take(3);

        return view('user.homepage', compact('tours', 'trangTinTucs'));
    }
}
