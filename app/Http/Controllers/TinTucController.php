<?php

namespace App\Http\Controllers;

use App\Models\TrangTinTuc;
use App\Models\TheLoai;
use App\Models\HinhAnhTour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TinTucController extends Controller
{
    public function index()
    {
        $theLoais = TheLoai::all();
        $trangTinTucs = TrangTinTuc::get();

        return view('user.trang_tintuc.index', compact('trangTinTucs', 'theLoais'));
    }

    // Hiển thị form thêm tin tức
    public function create()
    {
        $theLoais = TheLoai::all();
        return view('user.trang_tintuc.create', compact('theLoais'));
    }

    // Xử lý lưu tin tức mới
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'id_theloai' => 'required|exists:the_loais,id',
            'id_nguoidung' => 'required|exists:users,id',
            'tieu_de' => 'required|string|max:255',
            'slug' => 'required|string|unique:trang_tin_tucs,slug',
            'hinh_anh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn file ảnh
            'noidung_rutgon' => 'required|string',
            'mo_ta' => 'nullable|string',
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('hinh_anh')) {
            $image = $request->file('hinh_anh');
            $imageName = time() . '-' . Str::slug($image->getClientOriginalName());
            $image->storeAs('public/images/tintuc', $imageName);
            $validated['hinh_anh'] = 'images/tintuc/' . $imageName;
        }

        // Tạo tin tức mới
        TrangTinTuc::create($validated);

        // Trả về phản hồi
        return redirect()->route('tintuc.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function timKiemTinTuc(Request $request)
    {
        $categories = $request->input('categories', []);

        // Lấy các tin tức thuộc thể loại đã chọn
        $trangTinTucs = TrangTinTuc::whereIn('id_theloai', $categories)->get();

        // Trả về dữ liệu dạng JSON
        return response()->json($trangTinTucs);
    }

    public function show(TrangTinTuc $trangTinTuc)
    {
        $relatedBlogs = TrangTinTuc::where('id', '!=', $trangTinTuc->id)
            ->where('id_theloai', $trangTinTuc->id_theloai)
            ->get();
        $tours = Tour::with('hinhAnhTours')->get()->take(2);

        $trangTinTuc->incrementReadCount('doc');

        return view('user.trang_tintuc.show', compact('trangTinTuc', 'tours', 'relatedBlogs'));
    }

    public function statistic()
    {
        // Lấy số lượng đặt tour theo tháng
        $tourData = TrangTinTuc::count();

        return view('thong_ke_dat_tour', compact('tourData'));
    }
}