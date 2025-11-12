$(document).ready(function () {
  // Swiper: Slider
  const swiper = new Swiper(".swiper-container", {
    loop: false,
    slidesPerView: 1.5,
    centeredSlides: true,
    spaceBetween: 20,
    speed: 8000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      pauseOnMouseEnter: true
    }
  });
});
