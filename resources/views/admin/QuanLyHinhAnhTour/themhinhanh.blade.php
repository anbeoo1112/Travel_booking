@vite('resources/js/addUser-admin.js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Thêm -->
<form action="{{ route('them_hinh_anh_tour') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addHinhAnhModal"><i class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Hình Ảnh -->
<div class="modal fade" id="addHinhAnhModal" tabindex="-1" aria-labelledby="addHinhAnhModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addHinhAnhModalLabel">Thêm Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAccountForm" action="{{ route('luu_hinh_anh_tour') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_anh" class="form-label">Tên Ảnh</label>
                        <input type="text" class="form-control" id="ten_anh" name="ten_anh" placeholder="Vui lòng nhập tên ảnh" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_tour" class="form-label">Tour</label>
                        <select name="id_tour" id="id_tour" class="form-control" required>
                            <option value="">Chọn Tour</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}">{{ $tour->ten_tour }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="url_anh" class="form-label">URL Ảnh</label>
                        <input type="file" class="form-control" id="url_anh" name="url_anh" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addHA">Thêm</button>    
                </form>
            </div>
        </div>
    </div>
</div>