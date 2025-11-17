document.addEventListener('DOMContentLoaded', function () {
    var confirmModal = document.getElementById('confirmDatTourModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Nút đã kích hoạt modal
        var datTourId = button.getAttribute('data-dattour-id'); // Lấy ID đặt tour từ thuộc tính data
        var form = document.getElementById('confirmDatTourForm'); // Lấy form xác nhận
        form.action = '/quanlydattour/' + datTourId + '/xac-nhan'; // Cập nhật URL action cho form
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var cancelModal = document.getElementById('cancelDatTourModal');
    cancelModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var datTourId = button.getAttribute('data-dattour-id');
        var form = document.getElementById('cancelDatTourForm');
        form.action = '/quanlydattour/' + datTourId + '/huy';
    });
});