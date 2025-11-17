@extends('layouts.moldMain-Admin')

@section('content-min')

<h1 class="text-center mb-4">Thông Tin Cá Nhân</h1>
<div class="card">
    <div class="card-body text-center">
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;" />
        <h2 class="card-title">{{ $user->ho_ten }}</h2>
        <p class="card-text">Tài khoản: <strong>{{ $user->tai_khoan }}</strong></p>
        <p class="card-text">Email: <strong>{{ $user->email }}</strong></p>
        <p class="card-text">Số điện thoại: <strong>{{ $user->so_dien_thoai }}</strong></p>
        <p class="card-text">Vai trò: <strong>{{ $user->vai_tro }}</strong></p>
        <a href="{{ route('thay_doi_thong_tin') }}" class="btn btn-primary">Cập nhật thông tin</a>
    </div>
</div>
@endsection


