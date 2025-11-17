<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
@vite('resources/js/trangTinTuc-admin.js')
<script>
    window.trangTinTuc = @json($trangTinTucs); // Output the array of articles from the backend
</script>

<!-- Nút Sửa -->
<button type="button" class="btn btn-warning text-light fs-5" data-bs-toggle="modal" data-bs-target="#editTrangTinTucModal{{ $trangTinTuc->id }}">
    <i class='bx bxs-edit'></i>
</button>

<!-- Modal Sửa Trang Tin Tức -->
<div class="modal fade" id="editTrangTinTucModal{{ $trangTinTuc->id }}" tabindex="-1" aria-labelledby="editTrangTinTucModalLabel{{ $trangTinTuc->id }}" aria-hidden="true" style="left:20%; width: 75%;">
    <div class="modal-dialog" id="editTrangTinTuc">
        <div class="modal-content" id="editModalContent">
            <div class="modal-header">
                <h5 class="modal-title edit" id="editTrangTinTucModalLabel{{ $trangTinTuc->id }}">Sửa Trang Tin Tức</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left">
                <form id="editForm{{ $trangTinTuc->id }}" action="{{ route('cap_nhat_trang_tin_tuc', $trangTinTuc->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_theloai">Thể Loại</label>
                        <select name="id_theloai" id="id_theloai" class="form-control" required>
                            <option value="">Chọn thể loại</option>
                            @foreach($theLoais as $theLoai)
                                <option value="{{ $theLoai->id }}" 
                                    {{ $theLoai->id == $trangTinTuc->id_theloai ? 'selected' : '' }}>
                                    {{ $theLoai->ten_the_loai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id_nguoidung" value="{{ Auth::id() }}">
                    </div>
                    <div class="mb-3">
                        <label for="tieu_de" class="form-label">Tiêu Đề</label>
                        <input type="text" class="form-control" id="tieu_de" name="tieu_de" placeholder="Vui lòng nhập tiêu đề" value="{{ $trangTinTuc->tieu_de }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="noidung_rutgon" class="form-label">Nội Dung Rút Gọn</label>
                        <input type="text" class="form-control" id="noidung_rutgon" name="noidung_rutgon" placeholder="Vui lòng nhập nội dung rút gọn" value="{{ $trangTinTuc->noidung_rutgon }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Vui lòng nhập slug" value="{{ $trangTinTuc->slug }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="hinh_anh" class="form-label">Hình Ảnh</label>
                        
                        @if($trangTinTuc->hinh_anh)
                            <div>
                                <img src="{{ asset('storage/' . $trangTinTuc->hinh_anh) }}" alt="Ảnh Trang Tin Tức" style="width: 150px; height: 150px; border-radius: 8px;">
                            </div><br>
                        @endif
                        <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                    </div>
                    <div class="mb-3">
                        <label for="mo_ta{{ $trangTinTuc->id }}" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="mo_ta" id="mo_ta{{ $trangTinTuc->id }}">{{ $trangTinTuc->mo_ta }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editTTT">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
