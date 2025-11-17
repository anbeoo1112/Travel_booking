document.addEventListener('DOMContentLoaded', function() {
    const profileLink = document.getElementById('profile-link');
    const dropdownMenu = document.getElementById('profile-dropdown');

    profileLink.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
    });

    // Đóng dropdown khi nhấn ra ngoài
    document.addEventListener('click', function(event) {
        if (!profileLink.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
