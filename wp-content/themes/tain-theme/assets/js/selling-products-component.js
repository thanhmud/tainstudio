var swiper_selling_com_product = new Swiper(".swiper-selling_com_product", {
  slidesPerView: 4,
	      navigation: {
        nextEl: ".swiper-selling_com_product .swiper-button-next",
        prevEl: ".swiper-selling_com_product .swiper-button-prev",
      },
  spaceBetween: 10,
	  pagination: {
        el: ".swiper-pagination-com",
      },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 13,
      grid: {
        rows: 2,
		fill: 'row'
      },
    },
    769: {
      slidesPerView: 4,
      spaceBetween: 16,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 16,
    },
  },
});