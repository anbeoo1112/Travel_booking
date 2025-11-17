var deleteHinhAnhModal = document.getElementById('deleteHinhAnhModal');
deleteHinhAnhModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var hinhAnhTourId = button.getAttribute('data-hinhanh-id');
		
	var form = deleteHinhAnhModal.querySelector('#deleteHinhAnhtForm');
	form.action = "/quanlyhinhanhtour/" + hinhAnhTourId;
});