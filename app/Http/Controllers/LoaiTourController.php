<?php

namespace App\Http\Controllers;

use App\Models\LoaiTour;
use Illuminate\Http\Request;

class LoaiTourController extends Controller
{
    public function index()
    {
        $loaiTours = LoaiTour::all();
        return view('admin.QuanLyLoaiTour.index', compact('loaiTours'));
    }

    public function create()
    {
        return view('admin.QuanLyLoaiTour.themloaitour');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_loaitour' => 'required|max:100',
        ]);

        $data = $request->all();
        LoaiTour::create($data);
        
        return redirect()->route('quanlyloaitour')->with('success', 'Thêm loại tour thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_loaitour' => 'required|max:100',
        ]);

        $loaiTour = LoaiTour::findOrFail($id);
        $loaiTour->ten_loaitour = $request->ten_loaitour;

        $loaiTour->save();
    
        return redirect()->route('quanlyloaitour')->with('success', 'Cập nhật loại tour thành công!');
    }

    public function destroy($id)
    {
        $loaiTour = LoaiTour::findOrFail($id);

        // Kiểm tra loại tour có tour nào không
        if ($loaiTour->tours()->count() > 0) {
            return redirect()->route('quanlyloaitour')->with('error', 'Không thể xóa vì loại tour đang được sử dụng!');
        }

        $loaiTour->delete(); 
        
        return redirect()->route('quanlyloaitour')->with('success', 'Xóa loại tour thành công!');   
    }
}
