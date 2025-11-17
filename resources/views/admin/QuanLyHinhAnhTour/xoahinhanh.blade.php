@vite('resources/js/deleteHinhAnhTour-admin.js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Xóa -->
<button type="button" class="btn btn-danger fs-5" data-bs-toggle="modal" data-bs-target="#deleteHinhAnhModal" data-hinhanh-id="{{ $hinhAnhTour->id }}">
    <i class='bx bx-trash'></i>
</button>

<!-- Modal Xác nhận Xóa -->
<div class="modal fade" id="deleteHinhAnhModal" tabindex="-1" aria-labelledby="deleteHinhAnhModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg" style="border-radius: 10px;" id="deleteModalContent">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteHinhAnhModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Xác nhận
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p><strong>Bạn có chắc chắn muốn xóa?</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                <form id="deleteHinhAnhtForm" method="POST" action="{{ route('xoa_hinh_anh_tour', $hinhAnhTour->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Có, Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

