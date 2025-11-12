document.addEventListener('DOMContentLoaded', function () {
    let page = 2; // Start with page 2
    const loadMoreButton = document.getElementById('load-more');
    const newsContainer = document.querySelector('.news_category-container');
    const skeleton = document.getElementById('skeleton');

    loadMoreButton.addEventListener('click', function () {
        // Hiển thị skeleton
        skeleton.style.display = 'block';

        // Create a FormData object to send data via POST
        const formData = new FormData();
        formData.append('action', 'load_more_posts_category');
        formData.append('page', page);

        // Send an AJAX request using Fetch API
        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                // Ẩn skeleton
                skeleton.style.display = 'none';

                // Kiểm tra nếu không còn bài viết nào để tải thêm
                if (data.trim() === '') {
                    loadMoreButton.style.display = 'none';
                } else {
                    // Append the new posts to the news container
                    newsContainer.innerHTML += data;
                    page++;
                }
            })
            .catch(error => {
                // Ẩn skeleton nếu có lỗi
                skeleton.style.display = 'none';
                console.error('Error:', error);
            });
    });
});