@extends('layouts.moldAdmin')

@section('content')
<div style="padding:30px; background-color: rgb(238, 238, 238); margin: -24px; min-height: 950px;">
    @include('includes.alert')

    @include('admin.QuanLyHoaDon.timkiemhoadon')<br>
    
    <!-- Hóa đơn thanh toán trực tiếp -->
    <div class="table" style="background-color:rgb(255, 255, 255); padding: 20px; border-radius:30px; margin-bottom: 20px;">
        <div class="order">
            <div class="head">
                <h4 style="font-weight:600;">Hóa Đơn Thanh Toán Trực Tiếp</h4>
                <p class="text-muted"><small>Danh sách hóa đơn thanh toán tại quầy</small></p>
            </div>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th><center>Mã Hóa Đơn</center></th>
                        <th><center>Mã Tour</center></th>
                        <th><center>Mã Khách Hàng</center></th>
                        <th><center>Họ Tên</center></th>
                        <th><center>Email</center></th>
                        <th><center>Số Điện Thoại</center></th>
                        <th><center>Trạng Thái</center></th>
                        <th><center>Công Cụ</center></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hoaDonDatTours as $hoaDonDatTour)
                        <tr>
                            <td><center>{{ $hoaDonDatTour->id }}</center></td>
                            @if($hoaDonDatTour->datTour)
                                <td><center>{{ $hoaDonDatTour->datTour->id }}</center></td>
                                <td><center>{{ $hoaDonDatTour->datTour->id_khachhang }}</center></td>
                                <td><center>{{ $hoaDonDatTour->datTour->ho_ten }}</center></td>
                                <td><center>{{ $hoaDonDatTour->datTour->email }}</center></td>
                                <td><center>{{ $hoaDonDatTour->datTour->so_dien_thoai }}</center></td>
                            @else
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                            @endif
                            <td><center>{{ $hoaDonDatTour->trang_thai }}</center></td>
                            <td>
                                @include('admin.QuanLyHoaDon.xemhoadon', ['hoaDonDatTour' => $hoaDonDatTour])
                                @include('admin.QuanLyHoaDon.suahoadon')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Chưa có hóa đơn thanh toán trực tiếp nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Hóa đơn thanh toán online (MoMo) -->
    <div class="table" style="background-color:rgb(255, 255, 255); padding: 20px; border-radius:30px;">
        <div class="order">
            <div class="head">
                <h4 style="font-weight:600;">Hóa Đơn Thanh Toán Online</h4>
                <p class="text-muted"><small>Danh sách thanh toán qua MoMo</small></p>
            </div>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th><center>Mã Giao Dịch</center></th>
                        <th><center>Mã Tour</center></th>
                        <th><center>Khách Hàng</center></th>
                        <th><center>Email</center></th>
                        <th><center>Số Tiền</center></th>
                        <th><center>Phương Thức</center></th>
                        <th><center>Thời Gian</center></th>
                        <th><center>Trạng Thái</center></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($onlinePayments as $payment)
                        <tr>
                            <td><center><code>{{ $payment->order_code }}</code></center></td>
                            @if($payment->booking)
                                <td><center>{{ $payment->booking->id }}</center></td>
                                <td><center>{{ $payment->booking->ho_ten }}</center></td>
                                <td><center>{{ $payment->booking->email }}</center></td>
                            @else
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                                <td><center>N/A</center></td>
                            @endif
                            <td><center>{{ number_format($payment->amount, 0, ',', '.') }} VNĐ</center></td>
                            <td><center>
                                <span class="badge bg-pink-500" style="background-color: #d91876;">MoMo</span>
                            </center></td>
                            <td><center>{{ $payment->paid_at->format('d/m/Y H:i') }}</center></td>
                            <td><center>
                                <span class="badge bg-success">Đã thanh toán</span>
                            </center></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Chưa có thanh toán online nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
