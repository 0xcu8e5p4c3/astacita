document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-auto-slide]").forEach((carouselContainer) => {
        const carousel = carouselContainer.querySelector("#carousel");
        const slides = carousel.children;
        const totalSlides = slides.length;
        let currentIndex = 0;

        const nextButton = carouselContainer.querySelector("#next");
        const prevButton = carouselContainer.querySelector("#prev");

        const autoSlide = carouselContainer.dataset.autoSlide === "true";
        const hasControls = carouselContainer.dataset.hasControls === "true";

        function getSlideWidth() {
            return carouselContainer.offsetWidth; // Setiap slide memuat 4 konten
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlide();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlide();
        }

        function updateSlide() {
            const offset = -currentIndex * getSlideWidth();
            carousel.style.transform = `translateX(${offset}px)`;
            carousel.style.padding = "9px";
        }

        // Auto-slide jika diaktifkan
        let slideInterval;
        if (autoSlide) {
            slideInterval = setInterval(nextSlide, 3000);
        }

        // Navigasi manual jika tombol tersedia
        if (hasControls) {
            if (nextButton) {
                nextButton.addEventListener("click", () => {
                    clearInterval(slideInterval);
                    nextSlide();
                    if (autoSlide) slideInterval = setInterval(nextSlide, 3000);
                });
            }

            if (prevButton) {
                prevButton.addEventListener("click", () => {
                    clearInterval(slideInterval);
                    prevSlide();
                    if (autoSlide) slideInterval = setInterval(nextSlide, 3000);
                });
            }
        }

        // Perbarui ukuran slide saat layar di-resize
        window.addEventListener("resize", updateSlide);
    });
});