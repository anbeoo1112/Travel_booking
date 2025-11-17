<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@vite('resources/js/trangTinTuc-admin.js')

<!-- Nút Thêm -->
<form action="{{ route('them_trang_tin_tuc') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addTrangTinTucModal"><i class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Trang Tin Tức -->
<div class="modal fade" id="addTrangTinTucModal" tabindex="-1" aria-labelledby="addTrangTinTucModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="addTrangTinTuc">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addTrangTinTucModalLabel">Thêm Trang Tin Tức</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTrangTinTucForm" action="{{ route('luu_trang_tin_tuc') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="id_theloai" class="form-label">Thể Loại</label>
                        <select name="id_theloai" id="id_theloai" class="form-control" required>
                            <option value="">Chọn Thể Loại</option>
                            @foreach($theLoais as $theLoai)
                                <option value="{{ $theLoai->id }}">{{ $theLoai->ten_the_loai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id_nguoidung" value="{{ Auth::id() }}">
                    </div>
                    <div class="mb-3">
                        <label for="tieu_de" class="form-label">Tiêu Đề</label>
                        <input type="text" class="form-control" id="tieu_de" name="tieu_de" placeholder="Vui lòng nhập tiêu đề" required oninput="generateSlug()">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug tự tạo" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình Ảnh</label>
                        <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" required>
                    </div>
                    <div class="mb-3">
                        <label for="noidung_rutgon" class="form-label">Nội Dung Rút Gọn</label>
                        <input type="text" class="form-control" id="noidung_rutgon" name="noidung_rutgon" placeholder="Vui lòng nhập nội dung rút gọn" required>
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="mo_ta" id="mo_ta"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addTTT">Thêm</button>    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Hàm tạo slug từ tiêu đề
    function generateSlug() {
        const title = document.getElementById('tieu_de').value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Loại bỏ ký tự đặc biệt
            .trim()
            .replace(/\s+/g, '-') // Thay thế khoảng trắng bằng dấu gạch ngang
            .replace(/-+/g, '-'); // Loại bỏ dấu gạch ngang liên tiếp
        document.getElementById('slug').value = slug;
    }
</script>