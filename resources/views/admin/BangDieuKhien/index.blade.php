@extends('layouts.moldAdmin')

@section('content')
    <ul class="box-info">
        <li>
            <i class='bx bxs-group' ></i>
            <span class="text">
                <?php
                    $khachHangCount = 0;

                    foreach ($nguoiDungs as $nguoiDung) {
                        if ($nguoiDung->vai_tro === "Khách Hàng") {
                            $khachHangCount++;
                        }
                    }
                ?>
                <h3>{{ $khachHangCount }}</h3>
                <p>Người Dùng</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>{{ number_format($doanhThu, 0) }} VNĐ</h3>
                <p>Doanh Thu</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-calendar-check' ></i>
            <span class="text">
                <h3>{{ $totalTours }}</h3>
                <p>Tour Đã Đặt</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-file' ></i>
            <span class="text">
                <?php
                    $tinTucCount = 0;

                    foreach ($tinTucs as $tinTuc) {
                        if ($tinTuc->id) {
                            $tinTucCount++;
                        }
                    }
                ?>
                <h3>{{ $tinTucCount }}</h3>
                <p>Số Lượng Tin Tức</p>
            </span>
        </li>
        <li>
            <i class='bx bx-comment-detail'></i>
            <span class="text">
                <?php
                    $gopYCount = 0;

                    foreach ($gopYs as $gopY) {
                        if ($gopY->id) {
                            $gopYCount++;
                        }
                    }
                ?>
                <h3>{{ $gopYCount }}</h3>
                <p>Số Lượt Góp Ý</p>
            </span>
        </li>
    </ul>


    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Khách hàng mới</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Người Dùng</th>
                        <th>Ngày Đăng Ký</th>
                        <th>Đăng Ký Qua</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nguoiDungs as $nguoiDung)
                        @if($nguoiDung->vai_tro === "Khách Hàng")
                            <tr>
                                <td>
                                    <center>
                                        <img src="{{ $nguoiDung->avatar ? asset('storage/' . $nguoiDung->avatar) : asset('./frontend/assets/images/avatars/default.png') }}" alt="{{ $nguoiDung->taikhoan }}" width="100">
                                        <p>{{ $nguoiDung->ho_ten  }}</p>
                                    </center>
                                </td>
                                <td><center>{{ $nguoiDung->created_at->format('d-m-Y H:i:s')}}</center></td>
                                <td>
                                    <center>
                                        @if ($nguoiDung->tai_khoan)
                                            <span class="status process">Tài Khoản</span>
                                        @elseif ($nguoiDung->dang_nhap_qua == 'email')
                                            <span class="status pending">Gmail</span>
                                        @else
                                            {{ ucfirst($nguoiDung->dang_nhap_qua) }}
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="todo">
            <div class="head">
                <h3>Top Tour Đặt Nhiều</h3>
            </div>
            <ul class="todo-list">
                @foreach($sortedTours as $tour)
                <li>
                    <p>{{ $tour['ten_tour'] }}</p> <!-- Hiển thị tên tour -->
                    <div>{{ $tour['count'] }}</div> <!-- Hiển thị số lượng đã đặt -->
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection