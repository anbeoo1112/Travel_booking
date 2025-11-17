<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\NguoiDung;
use Illuminate\Auth\Events\PasswordReset;

class AuthResetController extends Controller
{
    public function create(Request $request, $token = null)
    {
        return view('user.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8', 'max:20'],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 20 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Sử dụng Crypt để mã hóa mật khẩu như hệ thống hiện tại
                $user->forceFill([
                    'mat_khau' => Crypt::encrypt($request->password)
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập với mật khẩu mới.')
            : back()->withErrors(['email' => $this->getResetErrorMessage($status)]);
    }

    private function getResetErrorMessage($status)
    {
        switch ($status) {
            case Password::INVALID_TOKEN:
                return 'Token không hợp lệ hoặc đã hết hạn. Vui lòng yêu cầu đặt lại mật khẩu mới.';
            case Password::INVALID_USER:
                return 'Email không tồn tại trong hệ thống.';
            default:
                return 'Có lỗi xảy ra. Vui lòng thử lại.';
        }
    }
}
