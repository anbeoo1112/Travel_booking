<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@vite(['resources/js/xemChiTietGopY.js'])

<button type="button" class="btn btn-warning fs-5" data-bs-toggle="modal" data-bs-target="#xemChiTietGopYModal" data-ho-ten="{{ $gopY->ho_ten }}" data-so-dien-thoai="{{ $gopY->so_dien_thoai }}" data-email="{{ $gopY->email }}" data-noi-dung="{{ $gopY->noidung_gopy }}">
    <i class='bx bx-show-alt' style='color:#ffffff'></i>
</button>

<!-- Modal Xem Chi Tiết Góp Ý -->
<div class="modal fade" id="xemChiTietGopYModal" tabindex="-1" aria-labelledby="xemChiTietGopYModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="left: 10%;">
        <div class="modal-content shadow-lg" style="border-radius: 10px;">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="xemChiTietGopYModalLabel">Chi Tiết Góp Ý</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" style="font-size: 26px;"><strong>Họ Tên</strong></label>
                    <p class="form-text" style="font-size: 24px;" id="modalHoTen"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 26px;"><strong>Số Điện Thoại</strong></label>
                    <p class="form-text" style="font-size: 24px;" id="modalSoDienThoai"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 26px;"><strong>Email</strong></label>
                    <p class="form-text" style="font-size: 24px;" id="modalEmail"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 26px;"><strong>Nội Dung Góp Ý</strong></label>
                    <p class="form-text" style="font-size: 24px;" id="modalNoiDung"></p>
                </div>
            </div>
        </div>
    </div>
</div>
