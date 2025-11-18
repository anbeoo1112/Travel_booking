<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal"
    data-bs-target="#editTheLoaiModal{{ $theLoai->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Thể Loại -->
<div class="modal fade" id="editTheLoaiModal{{ $theLoai->id }}" tabindex="-1"
    aria-labelledby="editTheLoaiModalLabel{{ $theLoai->id }}" aria-hidden="true" style="left:190px; top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editTheLoaiModalLabel{{ $theLoai->id }}">Sửa Thể Loại</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $theLoai->id }}" action="{{ route('cap_nhat_the_loai', $theLoai->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="ten_the_loai" class="form-label">Tên Thể Loại</label>
                        <input type="text" class="form-control" id="ten_the_loai" name="ten_the_loai"
                            placeholder="Vui lòng nhập tên thể loại" value="{{ $theLoai->ten_the_loai }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Vui lòng nhập slug"
                            value="{{ $theLoai->slug }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editTL">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>