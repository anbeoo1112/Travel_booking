<?php

namespace App\Http\Controllers;

use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $loaiTours = LoaiTour::all();

        $keyword = $request->input('keyword');
        $tours = Tour::when($keyword, function ($query) use ($keyword) {
            return $query->where('ten_tour', 'LIKE', "%{$keyword}%")
                ->orWhere('id', 'LIKE', "%{$keyword}%")
                ->orWhere('thoigian_tour', 'LIKE', "%{$keyword}%")
                ->orWhere('noi_khoi_hanh', 'LIKE', "%{$keyword}%");
        })->get();

        return view('admin.QuanLyTour.index', compact('tours', 'keyword', 'loaiTours'));
    }

    public function create()
    {
        return view('admin.QuanLyTour.themTour');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten_tour' => 'required|string',
            'id_LoaiTour' => 'required|integer',
            'thoigian_tour' => 'required|string',
            'noi_khoi_hanh' => 'required|string',
            'ngay_bat_dau' => 'required|date|after_or_equal:today',
            'gia' => 'required|numeric',
            'slug' => 'required|string',
            'mo_ta' => 'nullable|string',
        ]);

        // Lấy tour cuối cùng dựa trên phần số của id
        $lastTour = Tour::selectRaw("CAST(SUBSTRING(id, 3) AS UNSIGNED) as so_tour")
            ->orderBy('so_tour', 'desc')
            ->first();

        // Tính toán số mới
        $newNumber = $lastTour ? $lastTour->so_tour + 1 : 1;

        // Format ID với padding số 0: T-001, T-002, ...
        $validatedData['id'] = 'T-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Tạo tour
        Tour::create($validatedData);

        return redirect()->route('quanlytour')->with('success', 'Thêm tour thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_tour' => 'required|string',
            'id_LoaiTour' => 'required|integer',
            'thoigian_tour' => 'required|string',
            'noi_khoi_hanh' => 'required|string',
            'ngay_bat_dau' => 'required|date|after_or_equal:today',
            'gia' => 'required|numeric',
            'slug' => 'required|string',
            'mo_ta' => 'nullable|string',
        ]);
        $tour = Tour::findOrFail($id);
        $tour->ten_tour = $request->ten_tour;
        $tour->id_LoaiTour = $request->id_LoaiTour;
        $tour->thoigian_tour = $request->thoigian_tour;
        $tour->noi_khoi_hanh = $request->noi_khoi_hanh;
        $tour->ngay_bat_dau = $request->ngay_bat_dau;
        $tour->gia = $request->gia;
        $tour->slug = $request->slug;
        $tour->mo_ta = $request->mo_ta;

        $tour->save();

        return redirect()->route('quanlytour')->with('success', 'Sửa tour thành công!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        // Lấy tất cả các đặt tour liên quan đến tour này
        $datTours = \App\Models\DatTour::where('id_tour', $tour->id)->get();

        // Nếu có đặt tour nào chưa "Đã Hủy" thì không cho xóa
        $canDelete = true;
        foreach ($datTours as $datTour) {
            if ($datTour->trang_thai_dattour !== 'Đã Hủy') {
                $canDelete = false;
                break;
            }
        }

        if (!$canDelete) {
            return redirect()->route('quanlytour')->with('error', 'Không thể xóa tour vì tour đã có người đặt!');
        }

        // Nếu tất cả đặt tour đã hủy, xóa các đặt tour và hóa đơn liên quan
        foreach ($datTours as $datTour) {
            \App\Models\HoaDonDatTour::where('id_dattour', $datTour->id)->delete();
            $datTour->delete();
        }

        // XÓA HÌNH ẢNH TOUR LIÊN QUAN
        \App\Models\HinhAnhTour::where('id_tour', $tour->id)->delete();

        $tour->delete();

        return redirect()->route('quanlytour')->with('success', 'Xóa tour thành công!');
    }
}
