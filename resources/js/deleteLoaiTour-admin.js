var deleteLoaiTourModal = document.getElementById('deleteLoaiTourModal');
deleteLoaiTourModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var loaiTourId = button.getAttribute('data-loaitour-id');
		
	var form = deleteLoaiTourModal.querySelector('#deleteLoaiTourForm');
	form.action = "/quanlyloaitour/" + loaiTourId;
});