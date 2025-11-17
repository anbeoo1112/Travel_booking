<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use App\Models\GopY;
use App\Models\TrangTinTuc;
use App\Models\Tour;
use App\Models\DatTour;

use Illuminate\Http\Request;

class BangDieuKhienController extends Controller
{
    public function index()
    {
        $nguoiDungs = NguoiDung::all();

        $totalRevenue = DatTour::join('tour', 'dat_tour.id_tour', '=', 'tour.id')
            ->whereIn('dat_tour.trang_thai_dattour', ['Đã xác nhận']) // Chọn trạng thái
            ->selectRaw('SUM(tour.gia * dat_tour.so_nguoi) as total_revenue') // Tính tổng doanh thu
            ->first(); // Lấy kết quả đầu tiên

        $doanhThu = $totalRevenue->total_revenue ?? 0;

        $tourCount = DatTour::whereIn('trang_thai_dattour', ['Chờ xác nhận', 'Đã xác nhận'])
            ->selectRaw('count(*) as total, ngay_dat_tour')
            ->groupBy('ngay_dat_tour')
            ->get();
        $totalTours = $tourCount->sum('total'); // Tổng số lượng tour

        $tinTucs = TrangTinTuc::all();

        $gopYs = GopY::all();

        $tourCounts = DatTour::select('id_tour')
            ->whereIn('trang_thai_dattour', ['Chờ xác nhận', 'Đã xác nhận']) // Lọc theo trạng thái
            ->groupBy('id_tour') // Nhóm theo id_tour
            ->get() // Lấy kết quả
            ->map(function ($item) {
                // Đếm số lượng tour đã đặt
                return [
                    'ten_tour' => Tour::find($item->id_tour)->ten_tour, // Lấy tên tour từ bảng tour
                    'count' => DatTour::where('id_tour', $item->id_tour)
                        ->whereIn('trang_thai_dattour', ['Chờ xác nhận', 'Đã xác nhận'])
                        ->count() // Đếm số lượng đã đặt
                ];
            });
        $sortedTours = collect($tourCounts)->sortByDesc('count');

        return view('admin.BangDieuKhien.index', compact('nguoiDungs', 'doanhThu', 'totalTours', 'tinTucs', 'gopYs', 'tourCounts', 'sortedTours'));
    }
}
