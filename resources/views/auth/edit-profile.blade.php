@extends('layouts.moldMain-Admin')

@section('content-min')
<div class="container">
    <h1 class="text-center my-4">Cập Nhật Thông Tin Cá Nhân</h1>
    <div class="card mx-auto" style="max-width: 600px;"> <!-- Khung viền bao quanh -->
        <div class="card-body">
            <form action="{{ url('/thay-doi-thong-tin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ho_ten" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="avatar">
                </div>
                <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection