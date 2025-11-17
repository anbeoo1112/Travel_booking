var deleteTourModal = document.getElementById('deleteTourModal');
deleteTourModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var tourId = button.getAttribute('data-tour-id');
		
	var form = deleteTourModal.querySelector('#deleteTourForm');
	form.action = "/quanlytour/" + tourId;
});