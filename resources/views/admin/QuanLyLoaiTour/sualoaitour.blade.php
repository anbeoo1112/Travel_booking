<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal" data-bs-target="#editLoaiTourModal{{ $loaiTour->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Loại Tour -->
<div class="modal fade" id="editLoaiTourModal{{ $loaiTour->id }}" tabindex="-1" aria-labelledby="editLoaiTourModalLabel{{ $loaiTour->id }}" aria-hidden="true" style="left:190px; top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editLoaiTourModalLabel{{ $loaiTour->id }}">Sửa Loại Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $loaiTour->id }}" action="{{ route('cap_nhat_loai_tour', $loaiTour->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ten_loaitour" class="form-label">Tên Loại Tour</label>
                        <input type="text" class="form-control" id="ten_loaitour" name="ten_loaitour" placeholder="Vui lòng nhập tên loại tour" value="{{ $loaiTour->ten_loaitour }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editLT">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
