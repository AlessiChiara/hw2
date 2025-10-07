
document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".mySwiper", {
        loop: true,
        grabCursor: true,
        spaceBetween:20,
        breakpoints: {
                550: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }},
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
    });
})

