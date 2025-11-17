@extends('layouts.moldAdmin')

@section('content')
        @include('admin.QuanLyDatTour.timkiemdattour')            
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Quản lý đặt tour</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Mã Đặt Tour</th>
                            <th>Tour</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoai</th>
                            <th>Số Người</th>
                            <th>Ngày Đi</th>
                            <th>Ngày Đặt</th>
                            <th>Giá</th>
                            <th>Thanh toán</th>
                            <th>Người Phụ Trách</th>
                            <th>Ngày Hủy</th>
                            <th>Trạng Thái</th>
                            <th><center>Công cụ</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datTours as $datTour)
                            <tr>
                                <td><center>{{ $datTour->id }}</center></td>
                                <td><center>{{ $datTour->tour->ten_tour }}</center></td>
                                <td><center>{{ $datTour->ho_ten }}</center></td>
                                <td><center>{{ $datTour->email }}</center></td>
                                <td><center>{{ $datTour->so_dien_thoai }}</center></td>
                                <td><center>{{ $datTour->so_nguoi }}</center></td>
                                <td><center>{{ $datTour->ngay_di }}</center></td>
                                <td><center>{{ $datTour->ngay_dat_tour}}</center></td>
                                <td><center>{{ number_format($datTour->tour->gia * $datTour->so_nguoi) }}</center><span>VND</span></td>
                                <td><center>
                                    @if($datTour->payment_status === 'paid')
                                        <span class="badge bg-success">Đã thanh toán</span>
                                    @else
                                        <span class="badge bg-warning">Chưa thanh toán</span>
                                    @endif
                                </center></td>
                                <td><center>{{ $datTour->nguoiDung->ho_ten ?? '' }}</center></td>
                                <td><center>{{ $datTour->ngay_huy_tour }}</center></td>
                                <td><center>{{ $datTour->trang_thai_dattour }}</center></td>
                                <td>
                                    <center>
                                        @include('admin.QuanLyDatTour.xacnhandattour')
                                        @include('admin.QuanLyDatTour.huydattour')
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection