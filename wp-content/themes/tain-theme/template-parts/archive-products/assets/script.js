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

const iconDropFlavor = document.getElementById("iconDropFlavor");
const contentDropFlavor = document.getElementById("contentDropFlavor");
let isDrop = false;
let isDropPrice = false;
let isDropFlavor = false;

const handleSidebarFilter = () => {
  contentFilMobi.style.top = 0;
  document.body.style.overflow = "hidden";
};
const handleCloseModal = () => {
  contentFilMobi.style.top = "-100%";
  document.body.style.overflowY = "auto";
  handleDropdown(false);
  handleDropdownPrice(false);
  handleDropdownFlavor(false);
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
const handleDropdownFlavor = (toggle) => {
  isDropFlavor = !isDropFlavor;
  let newTgFlavor = toggle == undefined ? isDropFlavor : toggle;
  handleDropFunc(
    newTgFlavor,
    iconDropFlavor,
    contentDropFlavor,
    contentDropFlavor.scrollHeight
  );
};
//filter pc multi
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

      // Capture flavor filter values
      const flavorFilters = Array.from(
        document.querySelectorAll(
          '.filter_product_list-body-category input[type="checkbox"]:checked'
        )
      ).map((checkbox) => checkbox.value);

      let url = new URL(window.location.href);

      // Remove pagination from the URL (page query parameter)
      if (url.searchParams.has("page")) {
        url.searchParams.delete("page"); // Remove the 'page' query parameter
      }

      // Update URL parameters
      if (priceFilters.length > 0) {
        url.searchParams.set("price", priceFilters.join(","));
      } else {
        url.searchParams.delete("price");
      }

      if (flavorFilters.length > 0) {
        url.searchParams.set("flavor", flavorFilters.join(","));
      } else {
        url.searchParams.delete("flavor");
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
      const flavorParams = urlParams.get("flavor")
        ? urlParams.get("flavor").split(",")
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

      // Set flavor checkboxes
      document
        .querySelectorAll(
          '.filter_product_list-body-category input[type="checkbox"]'
        )
        .forEach((checkbox) => {
          if (flavorParams.includes(checkbox.value)) {
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


//sort pc
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth > 768) {
    // Function to update the URL with the selected sort option
    function updateSort(sortOption) {
      const url = new URL(window.location.href);
      if (sortOption && sortOption !== "best-seller") {
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
          const bestSellerDiv = document.querySelector('.dropdown_item[data-sort="best-seller"]');

// Check if the element exists
if (bestSellerDiv) {
    // Set the text content of dropdownFilterText to the text content of the selected div
    dropdownFilterText.textContent = bestSellerDiv.textContent;
}
        }
      }
    }

    // Set the active sort option on page load
    setActiveSort();
  }
});
//sort mb muitli
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
      document.querySelectorAll('#sort-product-mobile input[type="checkbox"]:checked')
    ).map((checkbox) => checkbox.getAttribute("data-sort"))[0];

    // Capture flavor filter values on mobile
    const flavorFilters_mb = Array.from(
      document.querySelectorAll(
        '#contentDropFlavor input[type="checkbox"]:checked'
      )
    ).map((checkbox) => checkbox.value);

    let url = new URL(window.location.href);

    // Remove pagination from the URL (query parameter)
    if (url.searchParams.has("page")) {
      url.searchParams.delete("page"); // Remove the 'page' query parameter
    }

    // Update URL parameters
    if (priceFilters_mb.length > 0) {
      url.searchParams.set("price", priceFilters_mb.join(","));
    } else {
      url.searchParams.delete("price");
    }

    if (flavorFilters_mb.length > 0) {
      url.searchParams.set("flavor", flavorFilters_mb.join(","));
    } else {
      url.searchParams.delete("flavor");
    }

    if (sortOption_mb && sortOption_mb !== "best-seller") {
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
    const flavorParams = urlParams.get("flavor")
      ? urlParams.get("flavor").split(",")
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

    // Set flavor checkboxes on mobile
    document
      .querySelectorAll('#contentDropFlavor input[type="checkbox"]')
      .forEach((checkbox) => {
        if (flavorParams.includes(checkbox.value)) {
          checkbox.checked = true;
        }
      });

    // Set sort checkbox on mobile
    document
      .querySelectorAll('#sort-product-mobile input[type="checkbox"]')
      .forEach((checkbox) => {
        if (checkbox.getAttribute("data-sort") === sortParam) {
          checkbox.checked = true;
        } else {
          checkbox.checked = false;
        }
      });
  }

  // Function to handle single checkbox selection for sort options
  function handleSingleCheckboxSelection(event) {
    const checkboxes = document.querySelectorAll('#sort-product-mobile input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
      if (checkbox !== event.target) {
        checkbox.checked = false;
      }
    });
  }

  // Add event listener to the Apply button on mobile
  const applyFiltersButton = document.querySelector(".btn_apply");
  if (applyFiltersButton) {
    applyFiltersButton.addEventListener("click", applyFiltersMobile);
  }

  // Add event listeners to the sort checkboxes
  const sortCheckboxes = document.querySelectorAll('#sort-product-mobile input[type="checkbox"]');
  sortCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("click", handleSingleCheckboxSelection);
  });

  // Set checkbox states on page load
  setCheckboxStates();
});


