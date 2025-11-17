@extends('layouts.moldMain-Admin')

@section('content-min')
<div class="container" >
    <h1 class="text-center my-4">Đổi Mật Khẩu</h1>
    <div class="card mx-auto" style="max-width: 500px;"> <!-- Khung viền bao quanh -->
        <div class="card-body">
            <form action="{{ url('/doi-mat-khau') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="mat_khau_cu" class="form-label">Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="mat_khau_cu" required>
                </div>
                <div class="mb-3">
                    <label for="mat_khau_moi" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="mat_khau_moi" required>
                </div>
                <div class="mb-3">
                    <label for="mat_khau_moi_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" name="mat_khau_moi_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</div>
@endsection
