// Listen for the modal to be shown
var deleteAccountModal = document.getElementById('deleteAccountModal');
deleteAccountModal.addEventListener('show.bs.modal', function (event) {
	var button = event.relatedTarget; 
	var userId = button.getAttribute('data-user-id');
	
	// Update the action of the form
	var form = deleteAccountModal.querySelector('#deleteAccountForm');
	form.action = "/quanlytaikhoan/" + userId;
});