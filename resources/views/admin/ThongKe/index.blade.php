@extends('layouts.moldAdmin')

@section('content')
    <ul class="nav nav-pills" id="tab-list">
        <li class="nav-item">
            <button class="nav-link active" data-target="home" onclick="showTab('home')">Thống Kê Doanh Thu</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-target="profile" onclick="showTab('profile')">Thống Kê Số Lượng Đặt Tour</button>
        </li>
    </ul>
    
    <div class="tab">
        <div class="tab-pane active" id="home">
            @include('admin.ThongKe.thongkedoanhthu')
        </div>
        <div class="tab-pane" id="profile">
            @include('admin.ThongKe.thongkesoluongdattour')
        </div>
    </div>
    
@endsection
