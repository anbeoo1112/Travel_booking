@extends('layouts.moldAdmin')

@section('content')
@include('admin.QuanLyHinhAnhTour.timkiemhinhanhtour')
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Quản lý hình ảnh tour</h3>
                    @include('admin.QuanLyHinhAnhTour.themhinhanh')
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Tên Ảnh</th>
                            <th>Tên Tour</th>
                            <th>Ảnh</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Cập Nhật</th>
                            <th><center>Công cụ</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hinhAnhTours as $hinhAnhTour)
                            <tr >
                                <td><center>{{ $hinhAnhTour->ten_anh }}</center></td>
                                <td><center>{{ $hinhAnhTour->tour->ten_tour }}</center></td>
                                <td>
                                  <center><img src="{{ asset('storage/' . $hinhAnhTour->url_anh) }}" alt="{{ $hinhAnhTour->ten_anh }}" style="width: 150px; height: 150px; border-radius: 8px; "></center>
                                </td>
                                <td><center>{{ $hinhAnhTour->created_at->format('d-m-Y H:i:s')}}</td>
                                <td><center>{{ $hinhAnhTour->updated_at->format('d-m-Y H:i:s')}}</td>
                                <td>
                                    <center>
                                        @include('admin.QuanLyHinhAnhTour.suahinhanh')
                                        @include('admin.QuanLyHinhAnhTour.xoahinhanh')
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection