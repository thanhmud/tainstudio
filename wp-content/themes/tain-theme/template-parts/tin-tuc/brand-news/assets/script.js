const newSwiperIds = [
        "newsSwiper1",
        "newsSwiper2",
        "newsSwiper3",
        "newsSwiper4",
        "newsSwiper5",
      ];
      newSwiperIds.forEach((id) => {
        new Swiper(`#${id} .news_slide-content .swiper-container`, {
          slidesPerView: 4,
          spaceBetween: 24,
		  slidesPerGroup: 4,
			speed: 1000,
          navigation: {
            nextEl: `#${id} .news_slide-content .swiper-button-next`,
            prevEl: `#${id} .news_slide-content .swiper-button-prev`,
          },
          pagination: {
            el: `#${id} .news_slide-content .swiper-pagination`,
            clickable: true,
          },
        });
      });