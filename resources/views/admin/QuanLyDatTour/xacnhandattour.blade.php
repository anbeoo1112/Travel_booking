<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@vite('resources/js/datTour-admin.js')

@if($datTour->payment_status === 'paid')
    <!-- Nếu đã thanh toán online thì disable nút xác nhận -->
    <button type="button" class="btn btn-secondary fs-5" disabled title="Tour đã thanh toán online và tự động xác nhận">
        <i class='bx bx-check-double' style='color:#ffffff'></i>
    </button>
    <small class="text-success d-block mt-1">Đã thanh toán online</small>
@elseif($datTour->trang_thai_dattour === 'Đã xác nhận')
    <!-- Nếu đã xác nhận thì disable -->
    <button type="button" class="btn btn-secondary fs-5" disabled title="Tour đã được xác nhận">
        <i class='bx bx-check-double' style='color:#ffffff'></i>
    </button>
@elseif($datTour->trang_thai_dattour === 'Đã Hủy')
    <!-- Nếu đã hủy thì không hiện nút -->
    <span class="text-danger">-</span>
@else
    <!-- Chỉ cho xác nhận nếu đang chờ xác nhận và chưa thanh toán online -->
    <button type="button" class="btn btn-success fs-5" data-bs-toggle="modal" data-bs-target="#confirmDatTourModal{{ $datTour->id }}">
        <i class='bx bx-check-double' style='color:#ffffff'></i>
    </button>
@endif

<!-- Modal xác nhận đặt tour -->
<div class="modal fade" id="confirmDatTourModal{{ $datTour->id }}" tabindex="-1" aria-labelledby="confirmDatTourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDatTourLabel">Xác nhận đặt tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xác nhận đặt tour này không?</p>
                <p class="text-muted"><small>Lưu ý: Chức năng này chỉ dành cho thanh toán trực tiếp tại quầy.</small></p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('xac_nhan_dat_tour', $datTour->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>


