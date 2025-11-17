// Lắng nghe sự kiện mở modal
var xemChiTietGopYModal = document.getElementById('xemChiTietGopYModal');
xemChiTietGopYModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Nút đã nhấn để mở modal

    // Lấy các dữ liệu từ nút
    var hoTen = button.getAttribute('data-ho-ten');
    var soDienThoai = button.getAttribute('data-so-dien-thoai');
    var email = button.getAttribute('data-email');
    var noiDung = button.getAttribute('data-noi-dung');

    // Cập nhật nội dung modal
    document.getElementById('modalHoTen').textContent = hoTen;
    document.getElementById('modalSoDienThoai').textContent = soDienThoai;
    document.getElementById('modalEmail').textContent = email;
    document.getElementById('modalNoiDung').textContent = noiDung;
});