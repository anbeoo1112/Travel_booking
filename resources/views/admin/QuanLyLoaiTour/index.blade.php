@extends('layouts.moldAdmin')

@section('content')
    @include('includes.alert')
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Quản lý loại tour</h3>
                @include('admin.QuanLyLoaiTour.themloaitour')
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tên Loại Tour</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th><center>Công cụ</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loaiTours as $loaiTour)
                        <tr>
                            <td><center>{{ $loaiTour->ten_loaitour }}</center></td>
                            <td><center>{{ $loaiTour->created_at->format('d-m-Y H:i:s')}}</td>
                            <td><center>{{ $loaiTour->updated_at->format('d-m-Y H:i:s')}}</td>
                            <td>
                                <center>
                                    @include('admin.QuanLyLoaiTour.sualoaitour')
                                    @include('admin.QuanLyLoaiTour.xoaloaitour')
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection