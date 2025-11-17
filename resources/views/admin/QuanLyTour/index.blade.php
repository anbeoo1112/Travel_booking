@extends('layouts.moldAdmin')

@section('content')
    @include('includes.alert')
    @include('admin.QuanLyTour.timkiemtour')

    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Quản lý tour</h3>
                @include('admin.QuanLyTour.themtour')
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Mã Tour</th>
                        <th>Tên Tour</th>
                        <th>Loại Tour</th>
                        <th>Thời Gian Tour</th>
                        <th>Ngày khởi hành</th>
                        <th>Nơi Khởi Hành</th>
                        <th>Giá</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th>
                            <center>Công cụ</center>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tours->sortByDesc('created_at') as $tour)
                        <tr>
                            <td>
                                <center>{{ $tour->id }}</center>
                            </td>
                            <td>
                                <center>{{ $tour->ten_tour }}</center>
                            </td>
                            <td>
                                <center>{{ $tour->loaiTour->ten_loaitour }}</center>
                            </td>
                            <td>
                                <center>{{ $tour->thoigian_tour }}</center>
                            </td>

                            <td>
                                <center>
                                    @if ($tour->ngay_bat_dau)
                                        {{ \Carbon\Carbon::parse($tour->ngay_bat_dau)->format('d-m-Y') }}
                                    @else
                                        <span style="color:#999;">Chưa cập nhật</span>
                                    @endif
                                </center>
                            </td>

                            <td>
                                <center>{{ $tour->noi_khoi_hanh }}</center>
                            </td>
                            <td>
                                <center>{{ number_format($tour->gia) }} <span>VNĐ</span></center>
                            </td>
                            <td>
                                <center>{{ $tour->created_at->format('d-m-Y H:i:s') }}</center>
                            </td>
                            <td>
                                <center>{{ $tour->updated_at->format('d-m-Y H:i:s') }}</center>
                            </td>

                            <td>
                                <center>
                                    @include('admin.QuanLyTour.suatour')
                                    @include('admin.QuanLyTour.xoatour')
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection