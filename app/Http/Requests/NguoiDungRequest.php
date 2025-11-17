<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NguoiDungRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request; adjust as necessary.
    }

    public function rules()
    {
        return [
            'ho_ten' => 'required|max:100',
            'tai_khoan' => 'required|max:100|regex:/^[\p{L}\p{N}]+$/u|unique:nguoi_dung',
            'mat_khau' => 'required|min:6',
            'so_dien_thoai' => 'required|unique:nguoi_dung|max:10',
            'email' => 'required|email|unique:nguoi_dung|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vai_tro' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tai_khoan.unique' => 'Tài khoản đã tồn tại!',
            'tai_khoan.max' => 'Tên tài khoản không được vượt quá :max ký tự.',
            'tai_khoan.regex' => 'Thông tin không hợp lệ!', // Kiểm tra ký tự đặc biệt
            
            'ho_ten.max' => 'Họ tên không được vượt quá :max ký tự.',
            
            'mat_khau.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại!',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá :max ký tự.', // Đã giới hạn tối đa 10 ký tự
            
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'email.max' => 'Email không được vượt quá :max ký tự.',
        ];
    }
}
