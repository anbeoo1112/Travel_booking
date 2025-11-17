document.addEventListener('DOMContentLoaded', function() {
    const tenTourInput = document.getElementById('ten_the_loai');
    const slugInput = document.getElementById('slug');

    tenTourInput.addEventListener('input', function() {
        // Lấy giá trị từ tên tour
        let tenTourValue = tenTourInput.value;

        // Chuyển đổi thành chữ thường
        let slug = tenTourValue.toLowerCase();

        // Thay thế các ký tự có dấu bằng ký tự không dấu
        slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

        // Thay thế chữ Đ và đ thành d
        slug = slug.replace(/đ/g, 'd').replace(/Đ/g, 'd');

        // Thay thế khoảng trắng và các ký tự không phải chữ cái bằng dấu '-'
        slug = slug.replace(/[^a-z0-9]+/g, '-');

        // Xóa dấu '-' ở đầu và cuối chuỗi
        slug = slug.replace(/^-|-$/g, '');

        // Cập nhật giá trị vào trường slug
        slugInput.value = slug;
    });
});

document.getElementById('ten_the_loai').addEventListener('input', function() {
    var slugField = document.getElementById('slug');
    slugField.value = this.value.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
});

// Listen for the modal to be shown
var deleteTheLoaiModal = document.getElementById('deleteTheLoaiModal');
deleteTheLoaiModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var theLoaiId = button.getAttribute('data-theloai-id');
	
	// Update the action of the form
	var form = deleteTheLoaiModal.querySelector('#deleteTheLoaiForm');
	form.action = "/quanlytheloai/" + theLoaiId;
});