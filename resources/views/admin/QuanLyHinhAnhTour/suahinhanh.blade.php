<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal" data-bs-target="#editHinhAnhModal{{ $hinhAnhTour->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Hình Ảnh -->
<div class="modal fade" id="editHinhAnhModal{{ $hinhAnhTour->id }}" tabindex="-1" aria-labelledby="editHinhAnhModalLabel{{ $hinhAnhTour->id }}" aria-hidden="true" style="left:190px; top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editHinhAnhModalLabel{{ $hinhAnhTour->id }}">Sửa Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $hinhAnhTour->id }}" action="{{ route('cap_nhat_hinh_anh_tour', $hinhAnhTour->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ten_anh" class="form-label">Tên Ảnh</label>
                        <input type="text" class="form-control" id="ten_anh" name="ten_anh" placeholder="Vui lòng nhập tên ảnh" value="{{ $hinhAnhTour->ten_anh }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_tour" class="form-label">Tour</label>
                        <select name="id_tour" id="id_tour" class="form-select" required>
                            <option value="">Chọn tour</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" 
                                    {{ $tour->id == $hinhAnhTour->id_tour ? 'selected' : '' }}>
                                    {{ $tour->ten_tour }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="url_anh" class="form-label">URL Ảnh</label>
                        
                        @if($hinhAnhTour->url_anh)
                            <div>
                                <img src="{{ asset('storage/' . $hinhAnhTour->url_anh) }}" alt="Ảnh Tour" style="width: 150px; height: 150px; border-radius: 8px;">
                            </div><br>
                        @endif

                        <input type="file" class="form-control" id="url_anh" name="url_anh" value="{{ $hinhAnhTour->url_anh }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="editHA">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
