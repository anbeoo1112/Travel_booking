@vite('resources/js/addUser-admin.js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Thêm -->
<form action="{{ route('them_loai_tour') }}" method="POST" style="display:inline-block;">
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#addLoaiTourModal"><i class='bx bx-plus'></i></button>
</form>

<!-- Modal Thêm Loại Tour -->
<div class="modal fade" id="addLoaiTourModal" tabindex="-1" aria-labelledby="addLoaiTourModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="addModalContent">
            <div class="modal-header">
                <h5 class="modal-title add" id="addLoaiTourModalLabel">Thêm Loại Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLoaiTourForm" action="{{ route('luu_loai_tour') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_loaitour" class="form-label">Tên Loại Tour</label>
                        <input type="text" class="form-control" id="ten_loaitour" name="ten_loaitour" placeholder="Vui lòng nhập tên loại tour" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addLT">Thêm</button>    
                </form>
            </div>
        </div>
    </div>
</div>