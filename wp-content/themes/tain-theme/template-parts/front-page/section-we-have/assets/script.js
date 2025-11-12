var swiper = new Swiper(".best_deal-slide .swiper-container", {
  slidesPerView: 3, // Hiển thị 4 phần tử trên một slide
  spaceBetween: 30, // Khoảng cách giữa các slide (tuỳ chỉnh theo ý bạn)
  grid: {
    rows: 1,
  },
  breakpoints: {
    0: {
      slidesPerView: 2, 
      grid: {
        rows: 2,
    fill: 'row'
      },
      spaceBetween: 10, 
    },
    769: {
      slidesPerView: 3, 
      spaceBetween: 20, 
    },
  },
  navigation: {
    nextEl: ".best_deal-slide .swiper-button-next",
    prevEl: ".best_deal-slide .swiper-button-prev",
  },
  pagination: {
    el: ".best_deal-slide .swiper-pagination", // Chỉ định phần tử phân trang
    clickable: true, 
  },
});

// countdown
// function startCountdown() {
//     const countdownElement = document.getElementById("countdown");
//     if (countdownElement != null) {
//         function updateCountdown() {
//             const now = new Date(); // Thời gian hiện tại
//             const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59, 999); // Ngày cuối tháng

//             const timeDifference = endOfMonth - now; // Tính thời gian còn lại

//             if (timeDifference > 0) {
//                 // Chuyển đổi thời gian còn lại sang ngày, giờ, phút, giây
//                 const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
//                 const hours = Math.floor((timeDifference / (1000 * 60 * 60)) % 24);
//                 const minutes = Math.floor((timeDifference / (1000 * 60)) % 60);
//                 const seconds = Math.floor((timeDifference / 1000) % 60);

//                 // Hiển thị thời gian
//                 countdownElement.textContent = `${days}d : ${hours}h : ${minutes}m : ${seconds}s`;
//             } else {
//                 // Khi hết tháng, lặp lại
//                 setTimeout(startCountdown, 1000); // Reset sau 1 giây
//             }
//         }

//         updateCountdown(); // Gọi ngay khi trang được tải
//         const interval = setInterval(updateCountdown, 1000); // Cập nhật mỗi giây
//     }
// }

// startCountdown();


// function startCountdown(duration) {
//     let timeLeft = duration;
//     const countdownEl = document.getElementById("countdown");

//     function updateCountdown() {
//         let hours = Math.floor(timeLeft / 3600);
//         let minutes = Math.floor((timeLeft % 3600) / 60);
//         let seconds = timeLeft % 60;

//         countdownEl.textContent = 
//             String(hours).padStart(2, "0") + "h : " + 
//             String(minutes).padStart(2, "0") + "m : " + 
//             String(seconds).padStart(2, "0") + "s";

//         if (timeLeft > 0) {
//             timeLeft--;
//         } else {
//             timeLeft = duration; // Reset lại khi hết giờ
//         }
//     }

//     updateCountdown(); // Hiển thị ngay lập tức
//     setInterval(updateCountdown, 1000); // Cập nhật mỗi giây
// }

// startCountdown(3600); // 1 giờ = 3600 giây