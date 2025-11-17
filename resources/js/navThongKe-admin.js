<script>
    document.querySelectorAll('.nav-link').forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            document.querySelectorAll('.nav-link').forEach(btn => btn.classList.remove('active'));
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked button
            button.classList.add('active');
            // Show the corresponding tab pane
            const targetId = button.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });
</script>
