const inputField = document.querySelector(".find-input");
const placeholders = [
    "Nhập địa điểm bạn muốn tìm...",
    "Bạn muốn khám phá điều gì?",
    "Tìm kiếm các tour du lịch...",
    "Nhập tên địa điểm hoặc loại tour...",
];
let index = 0;
function changePlaceholder() {
    inputField.setAttribute("placeholder", placeholders[index]);
    inputField.classList.add("placeholder-active");
    index = (index + 1) % placeholders.length;
    setTimeout(function () {
        inputField.classList.remove("placeholder-active");
    }, 3000);
}
setInterval(changePlaceholder, 4000);

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".slide");
    const slideCount = slides.length;
    let currentIndex = 0;

    setInterval(() => {
        currentIndex = (currentIndex + 1) % slideCount;
        updateSlide();
    }, 4000);

    function updateSlide() {
        const offset = -currentIndex * 100;
        slider.style.transform = `translateX(${offset}%)`;
    }
});
