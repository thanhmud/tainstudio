      const listBtn = document.querySelectorAll(
        ".introduce_product_details .wrap_btn_introduce .list_btn button"
      );
      const contentProductDetail = document.querySelectorAll(
        ".product_detail_contentBtn"
      );

      listBtn.forEach((item) => {
        item.addEventListener("click", () => {
          //xóa active button, content còn lại
          listBtn.forEach((btn) => btn.classList.remove("active"));
          contentProductDetail.forEach((conten) =>
            conten.classList.remove("active")
          );
          // thêm active vào button
          item.classList.add("active");

          //button trỏ đến id của content để thêm class actice vào content
          const targetId = item.getAttribute("data-target");
          const targetContent = document.getElementById(targetId);
          targetContent.classList.add("active");
        });
      });
// accordion mobile
// accordion content active
const accordionContentAcive = document.querySelectorAll('.accordion-content');
if(accordionContentAcive.length > 0){
accordionContentAcive[0].style.maxHeight = accordionContentAcive[0].scrollHeight + 'px';	
}

document.querySelectorAll('.accordion-header').forEach(button => {
  button.addEventListener('click', () => {
    const accordionContent = button.nextElementSibling;

    // Đóng tất cả các accordion khác
    document.querySelectorAll('.accordion-content').forEach(content => {
      if (content !== accordionContent) {
        content.style.maxHeight = null; // Đặt max-height về null để đóng các accordion khác
        content.previousElementSibling.classList.remove('active');
      }
    });

    // Toggle phần accordion đang được nhấp vào
    button.classList.toggle('active');

    if (button.classList.contains('active')) {
      accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
    } else {
      accordionContent.style.maxHeight = null; // Khi đóng lại
    }
  });
});


// end accordion 
 var galleryThumbs = new Swiper(".gallery-thumbs", {
        spaceBetween: 8,
        slidesPerView: 5,
        freeMode: true,
	 	 loop: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
          480: {
            spaceBetween: 7, // Giảm khoảng cách giữa các slides hơn nữa
          },
		  769: {
            spaceBetween: 10, // Giảm khoảng cách giữa các slides
          },
        },
      });
      var galleryTop = new Swiper(".gallery-top", {
        spaceBetween: 1,
		  loop: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: galleryThumbs,
        },
      });
// handle tooltip
const tooltip_link_product = document.querySelector(".product_details_content-right .wrap_price_share .tooltip_share_product .tooltip_link_product");
const tooltip_btn_procduct = document.querySelector(".product_details_content-right .wrap_price_share .tooltip_share_product .tooltip_link_product button");
const toggle_tooltip_Url_product = document.querySelector(".product_details_content-right .wrap_price_share .tooltip_share_product #toggle_ToolTip_Url_Prd");

if(toggle_tooltip_Url_product && tooltip_btn_procduct  && tooltip_link_product){
	toggle_tooltip_Url_product.addEventListener('click',()=>{
	tooltip_link_product.classList.add("active");
})	
document.addEventListener('click', function(event) {
    if (!toggle_tooltip_Url_product.contains(event.target) && !tooltip_link_product.contains(event.target)) {
        tooltip_link_product.classList.remove("active");
    }
});
function HandleCoppyUrlProduct () { 
	navigator.clipboard.writeText(window.location.href);
	tooltip_btn_procduct.innerHTML = "";
	tooltip_btn_procduct.classList.add("success");
	setTimeout(()=>{
		tooltip_btn_procduct.innerHTML = "copied";
		tooltip_btn_procduct.classList.remove("success");
	},2000)
}
}
