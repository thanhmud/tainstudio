document.addEventListener("DOMContentLoaded", function () {
    const searchbtn_Heder = document.querySelector(".input-box svg");
    const searchbtn_Heder_mb = document.querySelector(
        ".input-box-mb .search-icon"
    );
    const openSubmenu = document.querySelector(".opensubmenu");
    const subMenuMb = document.querySelector(".navbar-mb .sub-menu");
    const openmenuMobile = document.querySelector(".hamberger");
    const search_layout = document.querySelector(".container-search");
    const close_search = document.querySelector(".close-search-box");
    if (searchbtn_Heder) {
        searchbtn_Heder.addEventListener("click", function () {
            search_layout.classList.add("active-search-header");
        });
    }
    if (searchbtn_Heder_mb) {
        searchbtn_Heder_mb.addEventListener("click", function () {
        search_layout.classList.add("active-search-header");
        });
    }
    if (close_search) {
        close_search.addEventListener("click", function () {
        search_layout.classList.remove("active-search-header");
        });
    }
  
    if (openmenuMobile) {
        openmenuMobile.addEventListener("click", function () {
            const navContainer = document.querySelector(".container-nav-mb");
            openmenuMobile.classList.toggle("active-hamberger");
            navContainer.classList.toggle("active-nav-mb");
            if (navContainer.classList.contains("active-nav-mb")) {
                navContainer.style.height = navContainer.scrollHeight + "px";
            } else {
                navContainer.style.height = "0px";
            }
        });
    }

    openSubmenu.addEventListener("click", function (e) {
        e.preventDefault();
        const navContainer = document.querySelector(".container-nav-mb");
        subMenuMb.classList.toggle("active-sub-menu");
        const productMenu = document.querySelector(".menu-item-has-children");
        productMenu.classList.toggle("active-sub-menu-svg");
        if (subMenuMb.classList.contains("active-sub-menu")) {
            subMenuMb.style.height = subMenuMb.scrollHeight + "px";
        } else {
            subMenuMb.style.height = "0px";
        }
        adjustNavContainerHeight(navContainer, subMenuMb);
    });

    function adjustNavContainerHeight(navContainer, subMenuMb) {
        if (subMenuMb.classList.contains("active-sub-menu")) {
            navContainer.style.height = navContainer.scrollHeight + subMenuMb.scrollHeight + "px";
        } else {
            navContainer.style.height = navContainer.scrollHeight - subMenuMb.scrollHeight + "px";
        }
    }
	//xử lý search
	var searchInput_header = document.querySelector('.search-box input[type="text"]');
    var searchIcon_header = document.querySelector('.search-box svg');

    function performSearch_header() {
        var query_header = searchInput_header.value.trim();
        if (query_header) {
            window.location.href = endPoint.langS + encodeURIComponent(query_header);
        }
    }
    if (searchInput_header) {
        searchInput_header.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                performSearch_header();
            }
        });
    }

    if (searchIcon_header) {
      searchIcon_header.addEventListener('click', function() {
          performSearch_header();
      });
    }
});

AOS.init({
    duration: 2000, // thời gian animation (ms)
});