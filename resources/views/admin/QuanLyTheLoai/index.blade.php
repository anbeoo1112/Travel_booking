@extends('layouts.moldAdmin')

@section('content')
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Quản lý thể loại</h3>
                @include('admin.QuanLyTheLoai.themtheloai')
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tên Thể Loại</th>
                        <th>Slug</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th>
                            <center>Công cụ</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($theLoais as $theLoai)
                        <tr>
                            <td>
                                <center>{{ $theLoai->ten_the_loai }}</center>
                            </td>
                            <td>
                                <center>{{ $theLoai->slug }}</center>
                            </td>
                            <td>
                                <center>{{ $theLoai->created_at->format('d-m-Y H:i:s')}}
                            </td>
                            <td>
                                <center>{{ $theLoai->updated_at->format('d-m-Y H:i:s')}}
                            </td>
                            <td>
                                <center>
                                    @include('admin.QuanLyTheLoai.suatheloai')
                                    @include('admin.QuanLyTheLoai.xoatheloai')
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection