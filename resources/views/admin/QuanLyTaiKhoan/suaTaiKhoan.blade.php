<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal"
    data-bs-target="#editAccountModal{{ $nguoiDung->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Tài Khoản -->
<div class="modal fade" id="editAccountModal{{ $nguoiDung->id }}" tabindex="-1"
    aria-labelledby="editAccountModalLabel{{ $nguoiDung->id }}" aria-hidden="true" style="left:190px; top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editAccountModalLabel{{ $nguoiDung->id }}">Sửa Tài Khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $nguoiDung->id }}" action="{{ route('cap_nhat_tai_khoan', $nguoiDung->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ho_ten" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                            placeholder="Vui lòng nhập họ tên" value="{{ $nguoiDung->ho_ten }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tai_khoan" class="form-label">Tài Khoản</label>
                        <input type="text" class="form-control" id="tai_khoan" name="tai_khoan"
                            placeholder="Vui lòng nhập tài khoản" value="{{ $nguoiDung->tai_khoan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                            placeholder="Vui lòng nhập số điện thoại" value="{{ $nguoiDung->so_dien_thoai }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Vui lòng nhập email" value="{{ $nguoiDung->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control" id="mat_khau" name="mat_khau"
                            placeholder="Vui lòng nhập mật khẩu"
                            value="{{ $nguoiDung->mat_khau == null ? '' : Crypt::decrypt($nguoiDung->mat_khau)}}"
                            required>
                    </div>
                    @if($nguoiDung->id !== 1)
                        <div class="mb-3">
                            <label for="vai_tro" class="form-label">Vai trò</label>
                            <select class="form-select" id="vai_tro" name="vai_tro" required>
                                <option value="Nhân Viên Quản Lý Website" {{ $nguoiDung->vai_tro == 'Nhân Viên Quản Lý Website' ? 'selected' : '' }}>Nhân Viên Quản Lý Website</option>
                                <option value="Nhân Viên Chăm Sóc Khách Hàng" {{ $nguoiDung->vai_tro == 'Nhân Viên Chăm Sóc Khách Hàng' ? 'selected' : '' }}>Nhân Viên Chăm Sóc Khách Hàng</option>
                                <option value="Nhân Viên Thống Kê" {{ $nguoiDung->vai_tro == 'Nhân Viên Thống Kê' ? 'selected' : '' }}>Nhân Viên Thống Kê</option>
                                <option value="Khách Hàng" {{ $nguoiDung->vai_tro == 'Khách Hàng' ? 'selected' : '' }}>Khách
                                    Hàng</option>
                            </select>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="image" class="form-label">Avatar</label>

                        @if($nguoiDung->avatar)
                            <div>
                                <img src="{{ asset('storage/' . $nguoiDung->avatar) }}" alt="Avatar" class="img-thumbnail"
                                    style="max-width: 150px; max-height: 150px;">
                            </div>
                        @endif

                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary" id="editTK">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>