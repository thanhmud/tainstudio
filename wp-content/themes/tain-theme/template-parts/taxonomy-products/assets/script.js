const filterHeaderPc = document.querySelectorAll(
  ".filter_product_list .filter_product_list-header"
);
const contentFilBody = document.querySelectorAll(".filter_product_list-body");
contentFilBody.forEach((body) => {
  body.style.maxHeight = body.scrollHeight + "px";
});

filterHeaderPc.forEach((filHead) => {
  filHead.addEventListener("click", (even) => {
    filHead.classList.toggle("active");
    const filterBody = filHead.nextElementSibling;
    if (filHead.classList.contains("active")) {
      filterBody.style.maxHeight = 0;
    } else {
      filterBody.style.maxHeight = filterBody.scrollHeight + "px";
    }
  });
});

const contentFilMobi = document.querySelector(".content_filter-mobile");
const iconDropdown = document.querySelector(
  ".header_dropdown .icon_arrow-bottom"
);
const content_dropdown = document.querySelector(".content_dropdown");

const iconDropPrice = document.getElementById("iconDropPrice");
const contentDropPrice = document.getElementById("contentDropPrice");

let isDrop = false;
let isDropPrice = false;

const handleSidebarFilter = () => {
  contentFilMobi.style.top = 0;
  document.body.style.overflowY = "hidden";
};
const handleCloseModal = () => {
  contentFilMobi.style.top = "-100%";
  document.body.style.overflowY = "auto";
  handleDropdown(false);
  handleDropdownPrice(false);
};
const handleDropFunc = (tgStt, iconDrop, contentDrop, scrollHeight) => {
  if (tgStt) {
    iconDrop.style.transform = "rotate(0deg)";
    contentDrop.style.height = `${scrollHeight}px`;
    contentDrop.style.opacity = 1;
  } else {
    iconDrop.style.transform = "rotate(-180deg)";
    contentDrop.style.height = 0;
    contentDrop.style.opacity = 0;
  }
};
const handleDropdown = (toggle) => {
  isDrop = !isDrop;
  let newtg = toggle == undefined ? isDrop : toggle;
  handleDropFunc(
    newtg,
    iconDropdown,
    content_dropdown,
    content_dropdown.scrollHeight
  );
};
const handleDropdownPrice = (toggle) => {
  isDropPrice = !isDropPrice;
  let newtgPrice = toggle == undefined ? isDropPrice : toggle;
  handleDropFunc(
    newtgPrice,
    iconDropPrice,
    contentDropPrice,
    contentDropPrice.scrollHeight
  );
};

// Filter for PC
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth > 768) {
    // Function to update filters
    function updateFilters() {
      // Capture price filter values
      const priceFilters = Array.from(
        document.querySelectorAll(
          '.filter_product_list-body-price input[type="checkbox"]:checked'
        )
      ).map((checkbox) => checkbox.value);

      let url = new URL(window.location.href);

      // Remove pagination from the URL path
      const pathParts = url.pathname.split("/");
      const paginationIndex = pathParts.findIndex((part) =>
        part.startsWith("page")
      );
      if (paginationIndex !== -1) {
        pathParts.splice(paginationIndex, 2); // Remove the 'page' part and the number following it
        url.pathname = pathParts.join("/");
      }
      console.log(url.pathname);
      // Update URL parameters
      if (priceFilters.length > 0) {
        url.searchParams.set("price", priceFilters.join(","));
      } else {
        url.searchParams.delete("price");
      }

      // Reload the page with the updated URL
      window.location.href = url.toString();
    }

    // Function to set checkbox states based on URL parameters
    function setCheckboxStates() {
      const urlParams = new URLSearchParams(window.location.search);
      const priceParams = urlParams.get("price")
        ? urlParams.get("price").split(",")
        : [];

      // Set price checkboxes
      document
        .querySelectorAll(
          '.filter_product_list-body-price input[type="checkbox"]'
        )
        .forEach((checkbox) => {
          if (priceParams.includes(checkbox.value)) {
            checkbox.checked = true;
          }
        });
    }

    // Add event listeners to the checkboxes
    document
      .querySelectorAll('.filter_product_list-body input[type="checkbox"]')
      .forEach((checkbox) => {
        checkbox.addEventListener("change", updateFilters);
      });

    // Set checkbox states on page load
    setCheckboxStates();
  }
});

// Sort for PC
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth > 768) {
    // Function to update the URL with the selected sort option
    function updateSort(sortOption) {
      const url = new URL(window.location.href);
      if (sortOption) {
        url.searchParams.set("sort", sortOption);
      } else {
        url.searchParams.delete("sort");
      }
      // Reload the page with the updated URL
      window.location.href = url.toString();
    }

    // Add event listeners to the dropdown items
    document.querySelectorAll(".dropdown_item").forEach((item) => {
      item.addEventListener("click", function () {
        const sortOption = this.getAttribute("data-sort");
        updateSort(sortOption);
      });
    });

    // Function to set the active sort option based on URL parameters
    function setActiveSort() {
      const urlParams = new URLSearchParams(window.location.search);
      const sortParam = urlParams.get("sort");
      const dropdownFilterText = document.querySelector(
        ".dropdown_filter > .bodytext-3"
      );

      if (sortParam) {
        document.querySelectorAll(".dropdown_item").forEach((item) => {
          if (item.getAttribute("data-sort") === sortParam) {
            item.classList.add("active");
            if (dropdownFilterText) {
              dropdownFilterText.textContent = item.textContent;
            }
          } else {
            item.classList.remove("active");
          }
        });
      } else {
        // Default to "Best sellers" if no sort parameter is present
        if (dropdownFilterText) {
          dropdownFilterText.textContent = "Best sellers";
        }
      }
    }

    // Set the active sort option on page load
    setActiveSort();
  }
});

// Sort for Mobile
document.addEventListener("DOMContentLoaded", function () {
  // Get all sort checkboxes
  const sortCheckboxes = document.querySelectorAll(
    '#sort-product-mobile input[type="checkbox"]'
  );

  // Function to handle checkbox change
  function handleSortCheckboxChange(event) {
    // Uncheck all other checkboxes
    sortCheckboxes.forEach((checkbox) => {
      if (checkbox !== event.target) {
        checkbox.checked = false;
      }
    });

    // Apply sorting logic here, if needed
    // For example, you might update the URL or apply the sorting to the product list
    // You can use the selected sort value like this: event.target.dataset.sort
  }

  // Add event listener to each checkbox
  sortCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", handleSortCheckboxChange);
  });
});

// Filter for Mobile
document.addEventListener("DOMContentLoaded", function () {
  // Function to apply filters on mobile
  function applyFiltersMobile() {
    // Capture price filter values on mobile
    const priceFilters_mb = Array.from(
      document.querySelectorAll(
        '#contentDropPrice input[type="checkbox"]:checked'
      )
    ).map((checkbox) => checkbox.value);

    // Capture sort option on mobile
    const sortOption_mb = Array.from(
      document.querySelectorAll(
        '#sort-product-mobile input[type="checkbox"]:checked'
      )
    ).map((checkbox) => checkbox.getAttribute("data-sort"))[0];

    let url = new URL(window.location.href);

    // Remove pagination from the URL path
    const pathParts = url.pathname.split("/");
    const paginationIndex = pathParts.findIndex((part) =>
      part.startsWith("page")
    );
    if (paginationIndex !== -1) {
      pathParts.splice(paginationIndex, 2); // Remove the 'page' part and the number following it
      url.pathname = pathParts.join("/");
    }

    // Update URL parameters
    if (priceFilters_mb.length > 0) {
      url.searchParams.set("price", priceFilters_mb.join(","));
    } else {
      url.searchParams.delete("price");
    }

    if (sortOption_mb) {
      url.searchParams.set("sort", sortOption_mb);
    } else {
      url.searchParams.delete("sort");
    }

    // Redirect to the updated URL
    window.location.href = url.toString();
  }

  // Function to set checkbox states based on URL parameters
  function setCheckboxStates() {
    const urlParams = new URLSearchParams(window.location.search);
    const priceParams = urlParams.get("price")
      ? urlParams.get("price").split(",")
      : [];
    const sortParam = urlParams.get("sort");

    // Set price checkboxes on mobile
    document
      .querySelectorAll('#contentDropPrice input[type="checkbox"]')
      .forEach((checkbox) => {
        if (priceParams.includes(checkbox.value)) {
          checkbox.checked = true;
        }
      });

    // Set sort checkboxes on mobile
    document
      .querySelectorAll('#sort-product-mobile input[type="checkbox"]')
      .forEach((checkbox) => {
        if (checkbox.getAttribute("data-sort") === sortParam) {
          checkbox.checked = true;
        }
      });
  }

  // Add event listener to the "Apply Filters" button on mobile
  const applyFiltersButtonMobile = document.getElementById(
    "applyFiltersButtonMobile"
  );
  if (applyFiltersButtonMobile) {
    applyFiltersButtonMobile.addEventListener("click", applyFiltersMobile);
  }

  // Set checkbox states on page load
  setCheckboxStates();
});
