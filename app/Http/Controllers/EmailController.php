<?php

namespace App\Http\Controllers;

use App\Mail\phanHoiGopY;
use App\Models\GopY;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($id)
    {
        // Find the GopY record by its ID
        $gopY = GopY::find($id);

        if ($gopY && $gopY->email) {
            Mail::to($gopY->email)->send(new phanHoiGopY($gopY));
            $gopY->trangthai = 'Đã Phản Hồi';

            return redirect()->route('quanlygopy')->with('success', 'Gửi phản hồi góp ý thành công!');
        }
        
        return redirect()->route('quanlygopy')->with('error', 'Không tìm thấy thông tin góp ý hoặc email!');
    }
}

