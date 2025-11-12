document.addEventListener("click", function (event) {
    if (event.target.closest('.ecommerce-main .image')) {
        let clickedElement = event.target.closest('.image'); // Phần tử được click
        let firstClass = clickedElement.classList[0]; // Lấy class đầu tiên của phần tử
        let allSameClass = document.querySelectorAll('.' + firstClass);

        // Xóa class 'active' khỏi tất cả phần tử có cùng class đầu tiên
        allSameClass.forEach(el => el.classList.remove('active'));

        // Thêm class 'active' vào phần tử được click
        clickedElement.classList.add('active');

        // Cập nhật href cho nút .btn-visit a
        let rel = clickedElement.getAttribute('rel');
        let visitBtn = document.querySelector('.btn-visit a');
        if (visitBtn && rel) {
            visitBtn.setAttribute('href', rel);
        }
    }
});