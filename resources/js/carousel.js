document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".carousel-slide");
    const dots = document.querySelectorAll(".carousel-dot");
    const prevBtn = document.querySelector(".carousel-prev");
    const nextBtn = document.querySelector(".carousel-next");

    if (!slides.length) return;

    let current = 0;
    let interval;

    function showSlide(index) {
        // Sembunyikan semua slide
        slides.forEach((slide) => {
            slide.classList.add("hidden");
        });

        // Reset semua dot
        dots.forEach((dot) => {
            dot.classList.remove("bg-white");
            dot.classList.add("bg-white/50");
        });

        // Tampilkan slide aktif
        slides[index].classList.remove("hidden");

        // Aktifkan dot
        if (dots[index]) {
            dots[index].classList.remove("bg-white/50");
            dots[index].classList.add("bg-white");
        }

        current = index;
    }

    function nextSlide() {
        let next = current + 1;

        if (next >= slides.length) {
            next = 0;
        }

        showSlide(next);
    }

    function prevSlide() {
        let prev = current - 1;

        if (prev < 0) {
            prev = slides.length - 1;
        }

        showSlide(prev);
    }

    function startAutoSlide() {
        interval = setInterval(nextSlide, 4000);
    }

    function resetAutoSlide() {
        clearInterval(interval);
        startAutoSlide();
    }

    nextBtn?.addEventListener("click", () => {
        nextSlide();
        resetAutoSlide();
    });

    prevBtn?.addEventListener("click", () => {
        prevSlide();
        resetAutoSlide();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
            resetAutoSlide();
        });
    });

    showSlide(0);
    startAutoSlide();
});