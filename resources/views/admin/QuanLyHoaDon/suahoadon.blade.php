<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal" data-bs-target="#editHoaDonModal{{ $hoaDonDatTour->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Loại Tour -->
<div class="modal fade" id="editHoaDonModal{{ $hoaDonDatTour->id }}" tabindex="-1" aria-labelledby="editHoaDonModalLabel{{ $hoaDonDatTour->id }}" aria-hidden="true" style="left:190px; top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editHoaDonModalLabel{{ $hoaDonDatTour->id }}">Sửa Hóa Đơn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $hoaDonDatTour->id }}" action="{{ route('cap_nhat_hoa_don', $hoaDonDatTour->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="phuong_thuc_thanh_toan" class="form-label">Phương Thức Thanh Toán</label>
                        <select class="form-select" id="phuong_thuc_thanh_toan" name="phuong_thuc_thanh_toan" required>
                            <option value="Thanh toán trực tiếp tại quầy" {{ $hoaDonDatTour->phuong_thuc_thanh_toan == 'Thanh toán trực tiếp tại quầy' ? 'selected' : '' }}>Thanh toán trực tiếp tại quầy</option>
                            <option value="Thanh toán chuyển khoản qua ngân hàng" {{ $hoaDonDatTour->phuong_thuc_thanh_toan == 'Thanh toán chuyển khoản qua ngân hàng' ? 'selected' : '' }}>Thanh toán chuyển khoản qua ngân hàng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="trang_thai" name="trang_thai" required>
                            <option value="Chưa thanh toán" {{ $hoaDonDatTour->trang_thai == 'Chưa thanh toán' ? 'selected' : '' }}>Chưa thanh toán</option>
                            <option value="Đã thanh toán" {{ $hoaDonDatTour->trang_thai == 'Đã thanh toán' ? 'selected' : '' }}>Đã thanh toán</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editLT">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
