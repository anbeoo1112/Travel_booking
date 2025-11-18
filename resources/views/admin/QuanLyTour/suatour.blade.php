<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@vite('resources/js/tour-admin.js')
<script>
    window.tours = @json($tours);
</script>

<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal"
    data-bs-target="#editTourModal{{ $tour->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Tour -->
<div class="modal fade" id="editTourModal{{ $tour->id }}" tabindex="-1"
    aria-labelledby="editTourModalLabel{{ $tour->id }}" aria-hidden="true" style="left: 20%;width: 75%;">
    <div class="modal-dialog" id="editTourDialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editTourModalLabel{{ $tour->id }}">Sửa Tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $tour->id }}" action="{{ route('cap_nhat_tour', $tour->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ten_tour" class="form-label">Tên Tour</label>
                        <input type="text" class="form-control" id="ten_tour" name="ten_tour"
                            placeholder="Vui lòng nhập tên tour" value="{{ $tour->ten_tour }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_LoaiTour">Loại Tour</label>
                        <select name="id_LoaiTour" id="id_LoaiTour" class="form-control" required>
                            <option value="">Chọn loại tour</option>
                            @foreach($loaiTours as $loaiTour)
                                <option value="{{ $loaiTour->id }}" {{ $loaiTour->id == $tour->id_LoaiTour ? 'selected' : '' }}>
                                    {{ $loaiTour->ten_loaitour }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thoigian_tour" class="form-label">Thời Gian Tour</label>
                        <input type="text" class="form-control" id="thoigian_tour" name="thoigian_tour"
                            placeholder="Vui lòng nhập thời gian tour" value="{{ $tour->thoigian_tour }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngay_bat_dau">Ngày Bắt Đầu</label>
                        <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control"
                            min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="noi_khoi_hanh" class="form-label">Nơi Khởi Hành</label>
                        <input type="text" class="form-control" id="noi_khoi_hanh" name="noi_khoi_hanh"
                            placeholder="Vui lòng nhập nơi khởi hành" value="{{ $tour->noi_khoi_hanh }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá</label>
                        <input type="text" class="form-control" id="gia" name="gia" placeholder="Vui lòng nhập giá"
                            value="{{ $tour->gia }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Vui lòng nhập slug"
                            value="{{ $tour->slug }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta{{ $tour->id }}" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="mo_ta"
                            id="mo_ta{{ $tour->id }}">{{ $tour->mo_ta }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editT">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>