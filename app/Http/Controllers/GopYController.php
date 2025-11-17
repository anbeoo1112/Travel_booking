<?php

namespace App\Http\Controllers;

use App\Models\GopY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GopYController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $gopYs = GopY::when($keyword, function ($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%");
        })->orderByDesc('created_at')
            ->get();

        return view('admin.QuanLyGopY.index', compact('gopYs', 'keyword'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ho_ten' => 'required|max:100',
            'so_dien_thoai' => 'required|max:20',
            'email' => 'required|max:50',
            'noidung_gopy' => 'required',
        ]);

        $validatedData['trangthai'] = 'Chưa Phản Hồi';

        GopY::create($validatedData);

        return redirect()->route('aboutus')->with('success', 'Gửi góp ý thành công!');
    }

    // ✅ HÀM GỬI EMAIL + CẬP NHẬT TRẠNG THÁI
    public function sendEmail(Request $request, $id)
    {
        $gopy = GopY::findOrFail($id);

        // nội dung email phản hồi
        $noiDungPhanHoi = $noiDungPhanHoi = "
        Xin chào {$gopy->ho_ten},

        Cảm ơn bạn đã gửi góp ý cho chúng tôi.
        Chúng tôi đã nhận được ý kiến của bạn và 
        sẽ phản hồi chi tiết sớm nhất có thể.

        Trân trọng,
        Đội ngũ hỗ trợ khách hàng
    ";

        // Gửi email
        Mail::raw($noiDungPhanHoi, function ($message) use ($gopy) {
            $message->to($gopy->email)
                ->subject('Phản hồi góp ý từ công ty');
        });

        // ✅ Cập nhật trạng thái sau khi gửi thành công
        $gopy->update(['trangthai' => 'Đã Phản Hồi']);

        return redirect()->back()->with('success', 'Phản hồi và cập nhật trạng thái thành công!');
    }
}
