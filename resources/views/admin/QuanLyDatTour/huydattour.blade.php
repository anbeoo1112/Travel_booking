<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@vite('resources/js/datTour-admin.js')

<button type="button" class="btn btn-danger fs-5" data-bs-toggle="modal" data-bs-target="#cancelDatTourModal" data-dattour-id="{{ $datTour->id }}">
    <i class='bx bxs-exit' style='color:#ffffff' ></i>
</button>

<!-- Modal xác nhận đặt tour -->
<div class="modal fade" id="cancelDatTourModal" tabindex="-1" aria-labelledby="cancelDatTourModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelDatTourModal">Hủy đặt tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn hủy đặt tour này không?
            </div>
            <div class="modal-footer">
                <form id="cancelDatTourForm" method="POST" action="{{ route('huy_dat_tour', $datTour->id) }}">
                    @csrf
                    @method('PATCH') <!-- Đây là phương thức PATCH -->
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>



