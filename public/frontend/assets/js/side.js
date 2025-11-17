const carouselInner = document.getElementById('carouselInner');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const indicators = document.querySelectorAll('.carousel-indicators button');
let currentIndex = 0;

// Chuyển slide
function goToSlide(index) {
  currentIndex = index;
  carouselInner.style.transform = `translateX(-${index * 100}%)`;
  updateIndicators();
}

// Cập nhật trạng thái của chỉ báo (dots)
function updateIndicators() {
  indicators.forEach((indicator, index) => {
    indicator.classList.toggle('active', index === currentIndex);
  });
}

// Điều hướng tới slide trước
prevBtn.addEventListener('click', () => {
  const newIndex = (currentIndex - 1 + indicators.length) % indicators.length;
  goToSlide(newIndex);
});

// Điều hướng tới slide tiếp theo
nextBtn.addEventListener('click', () => {
  const newIndex = (currentIndex + 1) % indicators.length;
  goToSlide(newIndex);
});

// Điều hướng bằng cách nhấn vào chỉ báo (dots)
indicators.forEach((indicator, index) => {
  indicator.addEventListener('click', () => {
    goToSlide(index);
  });
});

// Tự động chuyển slide sau 5 giây (tùy chọn)
setInterval(() => {
  nextBtn.click();
}, 5000);