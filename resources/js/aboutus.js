document.getElementById('showFormButton').addEventListener('click', function() {
    const formDiv = document.getElementById('contactForm');

    // Toggle form visibility
    formDiv.classList.toggle('show');
});

// Close form when clicking outside
document.addEventListener('click', function(event) {
    const formDiv = document.getElementById('contactForm');
    const button = document.getElementById('showFormButton');

    if (!button.contains(event.target) && formDiv.classList.contains('show') && !formDiv.contains(event.target)) {
        formDiv.classList.remove('show');
    }
});