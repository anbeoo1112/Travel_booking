<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    public function index()
    {
        $theLoais = TheLoai::all();
        return view('admin.QuanLyTheLoai.index', compact('theLoais'));
    }

    public function create()
    {
        return view('admin.QuanLyTheLoai.themTheLoai');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten_the_loai' => 'required|max:100',
            'slug' => 'required|string|max:255',
        ]);

        TheLoai::create($validatedData);

        return redirect()->route('quanlytheloai')->with('success', 'Thêm thể loại thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_the_loai' => 'required|max:100',
            'slug' => 'required|string|max:255',
        ]);

        $theLoai = TheLoai::findOrFail($id);

        $theLoai->ten_the_loai = $request->ten_the_loai;
        $theLoai->slug = $request->slug;

        $theLoai->save();

        return redirect()->route('quanlytheloai')->with('success', 'Sửa thể loại thành công!');
    }

    public function destroy($id)
    {
        $theLoai = TheLoai::findOrFail($id);
        $theLoai->delete();

        return redirect()->route('quanlytheloai')->with('success', 'Xóa thể loại thành công!');
    }
}
