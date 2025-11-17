@extends('layouts.moldAdmin')

@section('content')
    @include('admin.QuanLyTrangTinTuc.timkiemtrangtintuc')            
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Quản Lý Trang Tin Tức</h3>
                @include('admin.QuanLyTrangTinTuc.themtrangtintuc')            
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Thể Loại</th>
                        <th>Tiêu Đề</th>
                        <th>Nôi Dung Rút Gọn</th>
                        <th>Slug</th>
                        <th>Hình Ảnh</th>
                        <th>Người Đăng</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th><center>Công cụ</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trangTinTucs as $trangTinTuc)
                        <tr>
                            <td><center>{{ $trangTinTuc->theLoai->ten_the_loai }}</center></td>
                            <td><center>{{ $trangTinTuc->tieu_de }}</center></td>
                            <td><center>{{ $trangTinTuc->noidung_rutgon }}</center></td>
                            <td><center>{{ $trangTinTuc->slug }}</center></td>
                            <td>
                                <center>
                                    <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" alt="{{ $trangTinTuc->tieu_de }}" style="width: 100px; height: 100px; border-radius: 8px;">    
                                </center>
                            </td>
                            <td><center>{{ $trangTinTuc->nguoiDung->ho_ten}}</center></td>
                            <td><center>{{ $trangTinTuc->created_at->format('d-m-Y H:i:s')}}</td>
                            <td><center>{{ $trangTinTuc->updated_at->format('d-m-Y H:i:s')}}</td>
                            <td>
                                <center>
                                    @include('admin.QuanLyTrangTinTuc.suatrangtintuc')            
                                    @include('admin.QuanLyTrangTinTuc.xoatrangtintuc')
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection