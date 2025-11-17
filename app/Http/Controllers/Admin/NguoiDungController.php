<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class NguoiDungController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $nguoiDungs = NguoiDung::when($keyword, function ($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                ->orWhere('id', 'LIKE', "%{$keyword}%")
                ->orWhere('tai_khoan', 'LIKE', "%{$keyword}%")
                ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%");
        })->get();

        return view('admin.QuanLyTaiKhoan.index', compact('nguoiDungs', 'keyword'));
    }

    // Lưu người dùng mới
    public function store(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:100',
            'so_dien_thoai' => 'required|string|max:10',
            'email' => 'required|email|unique:nguoi_dung,email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
            'tai_khoan' => 'required|string|max:50|unique:nguoi_dung,tai_khoan',
            'mat_khau' => 'required|string|min:8|max:20',
        ]);

        $data = $request->all();
        // Dùng Crypt để mã hóa 2 chiều
        $data['mat_khau'] = Crypt::encrypt($request->mat_khau);

        // Prefix ID
        $vaiTro = $request->vai_tro ?? "Khách Hàng";
        $prefix = $vaiTro == "Khách Hàng" ? "KH" : "A";

        $lastNguoiDung = NguoiDung::where('id', 'like', $prefix . '-%')
            ->orderByRaw("CAST(SUBSTRING(id, LENGTH('$prefix-') + 1) AS UNSIGNED) DESC")
            ->first();

        if ($lastNguoiDung) {
            $lastNumber = intval(str_replace($prefix . '-', '', $lastNguoiDung->id));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $data['id'] = $prefix . '-' . $newNumber;
        $data['vai_tro'] = $vaiTro;

        NguoiDung::create($data);

        return redirect()->back()->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập.');
    }

    // Cập nhật người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'ho_ten' => 'required|max:100',
            'tai_khoan' => 'required|max:100',
            'so_dien_thoai' => 'required|max:20',
            'email' => 'required|email|max:50|unique:nguoi_dung,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vai_tro' => 'required|max:50',
            'mat_khau' => 'nullable|min:6',
        ]);

        $nguoiDung = NguoiDung::findOrFail($id);

        $nguoiDung->ho_ten = $request->ho_ten;
        $nguoiDung->tai_khoan = $request->tai_khoan;
        $nguoiDung->so_dien_thoai = $request->so_dien_thoai;
        $nguoiDung->email = $request->email;

        if ($request->filled('mat_khau')) {
            $nguoiDung->mat_khau = Crypt::encrypt($request->mat_khau);
        }

        if ($request->hasFile('avatar')) {
            if ($nguoiDung->avatar) {
                Storage::disk('public')->delete($nguoiDung->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $nguoiDung->avatar = $avatarPath;
        }

        $nguoiDung->vai_tro = $request->vai_tro;
        $nguoiDung->save();

        return redirect()->route('quanlytaikhoan')->with('success', 'Cập nhật tài khoản thành công!');
    }

    // Xóa người dùng
    public function destroy($id)
    {
        $nguoiDung = NguoiDung::findOrFail($id);

        $datTourIds = DB::table('dat_tour')->where('id_khachhang', $id)->pluck('id')->toArray();
        DB::table('hoadondattour')->whereIn('id_dattour', $datTourIds)->delete();
        DB::table('dat_tour')->where('id_khachhang', $id)->delete();

        if ($nguoiDung->avatar && $nguoiDung->avatar != 'avatars/default.png') {
            Storage::disk('public')->delete($nguoiDung->avatar);
        }

        $nguoiDung->delete();

        return redirect()->route('quanlytaikhoan')->with('success', 'Xóa tài khoản thành công!');
    }

    // Đăng nhập với Crypt::encrypt
    public function login(Request $request)
    {
        $request->validate([
            'tai_khoan' => 'required',
            'mat_khau' => 'required',
        ]);

        $nguoiDung = NguoiDung::where('tai_khoan', $request->tai_khoan)->first();

        if ($nguoiDung && Crypt::decrypt($nguoiDung->mat_khau) === $request->mat_khau) {
            // Lưu session hoặc token tuỳ theo hệ thống
            session(['nguoiDung' => $nguoiDung]);

            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('error', 'Sai tài khoản hoặc mật khẩu!');
    }
}
