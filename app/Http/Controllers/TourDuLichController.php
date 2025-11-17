<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrangTinTuc;
use App\Models\HinhAnhTour;
use App\Models\LoaiTour;
use App\Models\Tour;

class TourDuLichController extends Controller
{
    public function index()
    {
        $loaiTours = LoaiTour::all();
        $tours = Tour::with('hinhAnhTours')->get();
        return view('user.tour_dulich.index', compact('tours', 'loaiTours'));
    }

    public function timKiemTour(Request $request)
    {
        // Bắt đầu với tất cả các tour
        $query = Tour::query();
        $loaiTours = LoaiTour::all();
        // Lọc theo loại tour (checkbox)
        if ($request->has('loai_tour')) {
            $query->whereIn('id_LoaiTour', (array)$request->input('loai_tour'));
        }

        // Lọc theo tên tour (nếu nhập)
        if ($request->filled('ten_tour')) {
            $query->where('ten_tour', 'like', '%' . $request->input('ten_tour') . '%');
        }

        // Lọc theo giá
        if ($request->filled('min_price')) {
            $query->where('gia', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('gia', '<=', $request->input('max_price'));
        }

        // Lọc theo thời gian tour
        if ($request->filled('thoigian_tour')) {
            $query->where('thoigian_tour', 'like', '%' . $request->input('thoigian_tour') . '%');
        }

        // Lấy kết quả cuối cùng sau khi áp dụng các điều kiện
        $tours = $query->get();

        // Trả về view với dữ liệu tour đã lọc
        return view('user.tour_dulich.index', compact('tours', 'loaiTours'));
    }

    public function show(Tour $tour)
    {
        $tours = Tour::where('id', '!=', $tour->id)->get();
        return view('user.tour_dulich.show', compact('tour', 'tours'));
    }
}
