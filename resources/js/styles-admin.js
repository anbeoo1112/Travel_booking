// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

function getRandomBrightColors(num) {
	const colors = [];
	const usedHues = new Set();

	while (colors.length < num) {
		// Generate a random hue value between 0 and 360
		let hue = Math.floor(Math.random() * 360);

		// Ensure the hue hasn't been used before
		if (!usedHues.has(hue)) {
			usedHues.add(hue);
			const color = `hsl(${hue}, 80%, 65%)`;
			colors.push(color);
		}
	}
	return colors;
}

function applyColors() {
	const listItems = document.querySelectorAll('.todo-list li');
	const colors = getRandomBrightColors(listItems.length);

	listItems.forEach((item, index) => {
		item.style.backgroundColor = colors[index];
	});
}

applyColors();

document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and hide all tab panes
            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked tab and show the corresponding tab pane
            this.classList.add('active');
            const target = this.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
	const profileLink = document.getElementById('profile-link');
	const dropdownMenu = document.getElementById('profile-dropdown');

	profileLink.addEventListener('click', function() {
		dropdownMenu.classList.toggle('show'); // Thay đổi lớp CSS để hiển thị hoặc ẩn menu
	});

	// Đóng dropdown nếu người dùng nhấp bên ngoài
	window.addEventListener('click', function(event) {
		if (!profileLink.contains(event.target) && !dropdownMenu.contains(event.target)) {
			dropdownMenu.classList.remove('show');
		}
	});
});
