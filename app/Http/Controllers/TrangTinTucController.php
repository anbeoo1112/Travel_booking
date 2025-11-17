<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\TheLoai;
use App\Models\TrangTinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrangTinTucController extends Controller
{
    public function index(Request $request)
    {
        $theLoais = TheLoai::all();
        $nguoiDungs = NguoiDung::all();
        $keyword = $request->input('keyword');
        $trangTinTucs = TrangTinTuc::when($keyword, function ($query) use ($keyword) {
            return $query->where('tieu_de', 'LIKE', "%{$keyword}%");
        })->get();
        return view('admin.QuanLyTrangTinTuc.index', compact('trangTinTucs', 'nguoiDungs', 'theLoais'));
    }

    public function create()
    {
        return view('admin.QuanLyTaiKhoan.themTaiKhoan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_theloai' => 'required|integer',
            'id_nguoidung' => 'required', // KHÔNG ĐỂ integer, vì id của bạn là dạng string như KH-1
            'tieu_de' => 'required|max:100',
            'slug' => 'required|string|max:255',
            'hinh_anh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'noidung_rutgon' => 'required|string',
            'mo_ta' => 'required|string',
        ]);

        $data = $request->all(); // Dữ liệu đã có id_nguoidung từ input hidden

        if ($request->hasFile('hinh_anh')) {
            $avatarPath = $request->file('hinh_anh')->store('imgTrangTinTucs', 'public');
            $data['hinh_anh'] = $avatarPath;
        }

        TrangTinTuc::create($data);

        return redirect()->route('quanlytrangtintuc')->with('success', 'Thêm tin tức thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_theloai' => 'required|integer',
            'tieu_de' => 'required|max:100',
            'slug' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'noidung_rutgon' => 'required|string',
            'mo_ta' => 'required|string',
        ]);

        $trangTinTuc = TrangTinTuc::findOrFail($id);

        $trangTinTuc->id_theloai = $request->id_theloai;
        $trangTinTuc->id_nguoidung = $request->id_nguoidung;
        $trangTinTuc->tieu_de = $request->tieu_de;
        $trangTinTuc->slug = $request->slug;
        $trangTinTuc->noidung_rutgon = $request->noidung_rutgon;
        $trangTinTuc->mo_ta = $request->mo_ta;
        $trangTinTuc->id_nguoidung = Auth::id();

        if ($request->hasFile('hinh_anh')) {
            if ($trangTinTuc->hinh_anh) {
                Storage::disk('public')->delete($trangTinTuc->hinh_anh);
            }
            $avatarPath = $request->file('hinh_anh')->store('imgTrangTinTucs', 'public');
            $trangTinTuc->hinh_anh = $avatarPath;
        }

        $trangTinTuc->save();

        return redirect()->route('quanlytrangtintuc')->with('success', 'Sửa tin tức thành công!');
    }

    public function destroy($id)
    {
        $trangTinTuc = TrangTinTuc::findOrFail($id);

        if ($trangTinTuc->hinh_anh) {
            Storage::disk('public')->delete($trangTinTuc->hinh_anh);
        } else if ($trangTinTuc->hinh_anh == null) {
            $trangTinTuc->delete($trangTinTuc->hinh_anh);
        }

        $trangTinTuc->delete();

        return redirect()->route('quanlytrangtintuc')->with('success', 'Xóa tin tức thành công!');
    }
}