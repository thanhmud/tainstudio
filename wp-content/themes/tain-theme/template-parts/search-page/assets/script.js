document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.querySelector('.search-box-page input[type="text"]');
    var searchIcon = document.querySelector('.search-box-page .foundicon');

    function performSearch() {
        var query = searchInput.value.trim();
        if (query) {
            var searchUrl = endPoint.langS + encodeURIComponent(query);
            localStorage.setItem('lastSearchUrl', searchUrl); // Save the search URL to local storage
            window.location.href = searchUrl;
        }
    }

    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            performSearch();
        }
    });

    searchIcon.addEventListener('click', function() {
        performSearch();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const sortOptions = document.querySelectorAll('.sort-option');
    const currentSort = document.querySelector('.filter-result-post > span');

    // Update currentSort based on URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const sortOrder = urlParams.get('sort_order');
    if (sortOrder) {
        const selectedOption = Array.from(sortOptions).find(option => option.getAttribute('data-sort') === sortOrder);
        if (selectedOption) {
            currentSort.textContent = selectedOption.textContent;
        }
    }

    sortOptions.forEach(option => {
        option.addEventListener('click', function () {
            const sortOrder = this.getAttribute('data-sort');
            currentSort.textContent = this.textContent; 

            const url = new URL(window.location.href);
            url.searchParams.set('sort_order', sortOrder);
            url.searchParams.set('paged_posts', 1);
            localStorage.setItem('lastSearchUrl', url.toString()); 
            window.location.href = url.toString();
        });
    });

    // Check if URL contains sort_order or paged_posts and scroll to .pagination with 6rem offset
    if (urlParams.has('sort_order') || urlParams.has('paged_posts')) {
        const paginationElement = document.querySelector('.filter-result-post');
        if (paginationElement) {
            const offset = 6 * parseFloat(getComputedStyle(document.documentElement).fontSize); 
            const elementPosition = paginationElement.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({ top: elementPosition, behavior: 'smooth' });
        }
    }
});
