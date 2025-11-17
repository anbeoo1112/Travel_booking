@extends('layouts.moldAdmin')

@section('content')
    @include('includes.alert')
    @include('admin.QuanLyTaiKhoan.timKiemTaiKhoan')
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Quản lý tài khoản</h3>
                @include('admin.QuanLyTaiKhoan.themTaiKhoan')
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mã Tài Khoản</th>
                        <th>Họ Tên</th>
                        <th>Tài Khoản</th>
                        <th>Mật Khẩu</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Vai Trò</th>
                        <th>Đăng Ký Bằng</th>
                        <th>Ngày Đăng Ký</th>
                        <th>Ngày Cập Nhật</th>
                        <th>
                            <center>Công cụ</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nguoiDungs as $nguoiDung)
                        <tr>
                            <td>
                                <center>{{ $nguoiDung->id }}</center>
                            </td>
                            <td>
                                <center>
                                    <img src="{{ $nguoiDung->avatar ? asset('storage/' . $nguoiDung->avatar) : asset('./frontend/assets/images/avatars/default.png') }}"
                                        alt="{{ $nguoiDung->taikhoan }}" width="100">
                                    <p>{{ $nguoiDung->ho_ten  }}</p>
                                </center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->tai_khoan }}</center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->mat_khau == null ? '' : Crypt::decrypt($nguoiDung->mat_khau)}}</center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->so_dien_thoai }}</center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->email }}</center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->vai_tro }}</center>
                            </td>
                            <td>
                                <center>
                                    @if ($nguoiDung->tai_khoan)
                                        Tài Khoản
                                    @elseif ($nguoiDung->dang_nhap_qua == 'email')
                                        Gmail
                                    @else
                                        {{ ucfirst($nguoiDung->dang_nhap_qua) }}
                                    @endif
                                </center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->created_at->format('d-m-Y H:i:s')}}</center>
                            </td>
                            <td>
                                <center>{{ $nguoiDung->updated_at->format('d-m-Y H:i:s')}}</center>
                            </td>
                            <td>
                                <center>
                                    @include('admin.QuanLyTaiKhoan.suaTaiKhoan')
                                    @if($nguoiDung->id !== "admin")
                                        @include('admin.QuanLyTaiKhoan.xoaTaiKhoan')
                                    @endif
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection