@vite('resources/js/addUser-admin.js')

<!-- Nút thêm modal -->
<form action="{{ route('them_tai_khoan') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addAccountModal"><i
            class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Tài Khoản -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addAccountModalLabel">Thêm Tài Khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAccountForm" action="{{ route('luu_tai_khoan') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ho_ten" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                            placeholder="Vui lòng nhập họ tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="tai_khoan" class="form-label">Tài Khoản</label>
                        <input type="text" class="form-control" id="tai_khoan" name="tai_khoan"
                            placeholder="Vui lòng nhập tài khoản" required>
                    </div>
                    <div class="mb-3">
                        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                            placeholder="Vui lòng nhập số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Vui lòng nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Mật khẩu</label>
                        <input type="text" class="form-control" id="mat_khau" name="mat_khau"
                            placeholder="Vui lòng nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="vai_tro" class="form-label">Vai trò</label>
                        <select class="form-select" id="vai_tro" name="vai_tro" required>
                            <option value="Nhân Viên Quản Lý Website">Nhân Viên Quản Lý Website</option>
                            <option value="Nhân Viên Chăm Sóc Khách Hàng">Nhân Viên Chăm Sóc Khách Hàng</option>
                            <option value="Nhân Viên Thống Kê">Nhân Viên Thống Kê</option>
                            <option value="Khách Hàng">Khách Hàng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Avartar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary" id="addTK">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>