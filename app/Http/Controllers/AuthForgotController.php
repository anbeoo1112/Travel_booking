<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthForgotController extends Controller
{
    public function create()
    {
        return view('user.auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        
        return back()->with('status', 'Đã gửi link đặt lại mật khẩu đến email của bạn (nếu email tồn tại trong hệ thống). Vui lòng kiểm tra hộp thư!');
    }
}