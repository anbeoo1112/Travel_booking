<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@vite('resources/js/theLoai-admin.js')

<!-- Nút Thêm -->
<form action="{{ route('them_the_loai') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addTheLoaiModal"><i
            class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Thể Loại -->
<div class="modal fade" id="addTheLoaiModal" tabindex="-1" aria-labelledby="addTheLoaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addTheLoaiModalLabel">Thêm Thể Loại</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTheLoaiForm" action="{{ route('luu_the_loai') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tenten_the_loaiheloai" class="form-label">Tên Thể Loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai"
                            placeholder="Vui lòng nhập tên thể loại" required oninput="generateSlug()">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug tự tạo"
                            readonly>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addTL">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>