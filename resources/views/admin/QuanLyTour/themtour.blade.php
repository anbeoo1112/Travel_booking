<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@vite('resources/js/tour-admin.js', 'resources/css/images.css')

<!-- Nút Thêm -->
<form action="{{ route('them_tour') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addTourModal"><i
            class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Tour -->
<div class="modal fade" id="addTourModal" tabindex="-1" aria-labelledby="addTourModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="addTourDialog">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addTourModalLabel">Thêm Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTourorm" action="{{ route('luu_tour') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_tour" class="form-label">Tên Tour</label>
                        <input type="text" class="form-control" id="ten_tour" name="ten_tour"
                            placeholder="Vui lòng nhập tên tour" required oninput="generateSlug()">
                    </div>
                    <div class="mb-3">
                        <label for="id_LoaiTour">Loại Tour</label>
                        <select name="id_LoaiTour" id="id_LoaiTour" class="form-control" required>
                            <option value="">Chọn loại tour</option>
                            @foreach($loaiTours as $loaiTour)
                                <option value="{{ $loaiTour->id }}">{{ $loaiTour->ten_loaitour }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thoigian_tour" class="form-label">Thời Gian Tour</label>
                        <input type="text" class="form-control" id="thoigian_tour" name="thoigian_tour"
                            placeholder="Vui lòng nhập thời gian diễn ra tour tour" required>
                    </div>
                    <div class="form-group">
                        <label for="ngay_bat_dau">Ngày Bắt Đầu</label>
                        <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control"
                            min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="noi_khoi_hanh" class="form-label">Nơi Khởi Hành</label>
                        <input type="text" class="form-control" id="noi_khoi_hanh" name="noi_khoi_hanh"
                            placeholder="Vui lòng nhập nơi khởi hành" required>
                    </div>
                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá</label>
                        <input type="text" class="form-control" id="gia" name="gia" placeholder="Vui lòng nhập giá"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug tự tạo"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="mo_ta" name="type" id="mo_ta"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addT">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>