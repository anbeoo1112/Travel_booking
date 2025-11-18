<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal" data-bs-target="#editHinhAnhModal{{ $hinhAnhTour->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Hình Ảnh -->
<div class="modal fade" id="editHinhAnhModal{{ $hinhAnhTour->id }}" tabindex="-1" aria-labelledby="editHinhAnhModalLabel{{ $hinhAnhTour->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editHinhAnhModalLabel{{ $hinhAnhTour->id }}">Sửa Hình Ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $hinhAnhTour->id }}" action="{{ route('cap_nhat_hinh_anh_tour', $hinhAnhTour->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ten_anh_{{ $hinhAnhTour->id }}" class="form-label">Tên Ảnh</label>
                        <input type="text" class="form-control" id="ten_anh_{{ $hinhAnhTour->id }}" name="ten_anh" placeholder="Vui lòng nhập tên ảnh" value="{{ $hinhAnhTour->ten_anh }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_tour_{{ $hinhAnhTour->id }}" class="form-label">Tour</label>
                        <select name="id_tour" id="id_tour_{{ $hinhAnhTour->id }}" class="form-select" required>
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
                        <label for="url_anh_{{ $hinhAnhTour->id }}" class="form-label">URL Ảnh</label>
                        
                        @if($hinhAnhTour->url_anh)
                            <div style="margin-bottom: 15px;">
                                <img src="{{ asset('storage/' . $hinhAnhTour->url_anh) }}" alt="Ảnh Tour" style="width: 100%; max-width: 200px; border-radius: 8px;">
                            </div>
                        @endif

                        <input type="file" class="form-control" id="url_anh_{{ $hinhAnhTour->id }}" name="url_anh">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="editHA_{{ $hinhAnhTour->id }}">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
