var deleteTourModal = document.getElementById('deleteTrangTinTucModal');
deleteTourModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var trangTinTucId = button.getAttribute('data-trangtintuc-id');
    console.log('TrangTinTuc ID: ', trangTinTucId);
	var form = deleteTourModal.querySelector('#deleteTrangTinTucForm');
	form.action = "/quanlytrangtintuc/" + trangTinTucId;
});