<?php

namespace App\Http\Controllers;

use App\Models\HinhAnhTour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HinhAnhTourController extends Controller
{
    public function index(Request $request)
    {
        $tours = Tour::all();

        // Bắt đầu query
        $query = HinhAnhTour::with('tour')->orderBy('id', 'desc');

        // Nếu có từ khóa tìm kiếm
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('ten_anh', 'like', "%{$keyword}%")
                ->orWhereHas('tour', function ($q) use ($keyword) {
                    $q->where('ten_tour', 'like', "%{$keyword}%");
                });
        }

        // Lấy kết quả
        $hinhAnhTours = $query->get();

        return view('admin.QuanLyHinhAnhTour.index', compact('hinhAnhTours', 'tours'));
    }
    public function create()
    {
        return view('admin.QuanLyHinhAnhTour.themhinhanh');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_anh' => 'required|string|max:100',
            'id_tour' => 'required|string',
            'url_anh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('url_anh')) {
            $avatarPath = $request->file('url_anh')->store('imgTours', 'public');
            $data['url_anh'] = $avatarPath;
        }

        HinhAnhTour::create($data);

        return redirect()->route('quanlyhinhanhtour')->with('success', 'Thêm hình ảnh thành công!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_anh' => 'required|string|max:100',
            'id_tour' => 'required|string',
            'url_anh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hinhAnhTour = HinhAnhTour::findOrFail($id);
        $hinhAnhTour->ten_anh = $request->ten_anh;
        $hinhAnhTour->id_tour = $request->id_tour;

        if ($request->hasFile('url_anh')) {
            if ($hinhAnhTour->url_anh) {
                Storage::disk('public')->delete($hinhAnhTour->url_anh);
            }
            $avatarPath = $request->file('url_anh')->store('imgTours', 'public');
            $hinhAnhTour->url_anh = $avatarPath;
        }

        $hinhAnhTour->save();

        return redirect()->route('quanlyhinhanhtour')->with('success', 'Sửa hình ảnh thành công!');
    }

    public function destroy($id)
    {
        $hinhAnhTour = HinhAnhTour::findOrFail($id);

        if ($hinhAnhTour->url_anh) {
            Storage::disk('public')->delete($hinhAnhTour->url_anh);
        } else if ($hinhAnhTour->url_anh == null) {
            $hinhAnhTour->delete($hinhAnhTour->url_anh);
        }

        $hinhAnhTour->delete();

        return redirect()->route('quanlyhinhanhtour')->with('success', 'Xóa hình ảnh thành công!');
    }
}
