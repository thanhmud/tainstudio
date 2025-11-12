const navBody = document.querySelector("#ez-toc-container nav ");
document.addEventListener("DOMContentLoaded", function () {
  const label = document.querySelector("#ez-toc-container label");

  if (label) {
    label.innerHTML = `
        <div class="label_table">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.75 6C15.75 5.80109 15.671 5.61032 15.5303 5.46967C15.3897 5.32902 15.1989 5.25 15 5.25H1C0.801088 5.25 0.610322 5.32902 0.46967 5.46967C0.329018 5.61032 0.25 5.80109 0.25 6C0.25 6.19891 0.329018 6.38968 0.46967 6.53033C0.610322 6.67098 0.801088 6.75 1 6.75H15C15.1989 6.75 15.3897 6.67098 15.5303 6.53033C15.671 6.38968 15.75 6.19891 15.75 6ZM15.75 1C15.75 0.801088 15.671 0.610322 15.5303 0.46967C15.3897 0.329018 15.1989 0.25 15 0.25H1C0.801088 0.25 0.610322 0.329018 0.46967 0.46967C0.329018 0.610322 0.25 0.801088 0.25 1C0.25 1.19891 0.329018 1.38968 0.46967 1.53033C0.610322 1.67098 0.801088 1.75 1 1.75H15C15.1989 1.75 15.3897 1.67098 15.5303 1.53033C15.671 1.38968 15.75 1.19891 15.75 1ZM15.75 11C15.75 10.8011 15.671 10.6103 15.5303 10.4697C15.3897 10.329 15.1989 10.25 15 10.25H1C0.801088 10.25 0.610322 10.329 0.46967 10.4697C0.329018 10.6103 0.25 10.8011 0.25 11C0.25 11.1989 0.329018 11.3897 0.46967 11.5303C0.610322 11.671 0.801088 11.75 1 11.75H15C15.1989 11.75 15.3897 11.671 15.5303 11.5303C15.671 11.3897 15.75 11.1989 15.75 11Z" fill="#222222"/>
          </svg>
          <span>Mục lục</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none">
          <path d="M0 6.00016L1.41 7.41016L6 2.83016L10.59 7.41016L12 6.00016L6 0.000156403L0 6.00016Z" fill="#444444"/>
        </svg>
      `;
  }
	if(navBody){
	  navBody.style.height = "0";
	  navBody.style.display = "block";
	  navBody.style.maxHeight = "0";
	  navBody.style.opacity = "0";
	}
});

const checkBox = document.querySelector(
  "#ez-toc-container input[type=checkbox]"
);
const ulBody = document.querySelector(
  "#ez-toc-container nav .ez-toc-list-level-1"
);
let iconLabel = document.querySelector(
  "#ez-toc-container .ez-toc-cssicon-toggle-label"
);


if(checkBox){
	checkBox.checked = false;
	let toggle = false;
  checkBox.addEventListener("click", () => {
    toggle = !toggle;
    iconLabel.classList.toggle("active");
    if (toggle) {
      navBody.style.height = `${ulBody.scrollHeight}px`;
      navBody.style.maxHeight = `${ulBody.scrollHeight}px`;
      navBody.style.opacity = "1";
    } else {
      navBody.style.height = "0";
      navBody.style.maxHeight = "0";
      navBody.style.opacity = "0";
    }
  });
}
const tooltip_link = document.querySelector(".news_details-body .iconfb_share-wrapper .tooltip_share .tooltip_link");
const tooltip_btn = document.querySelector(".news_details-body .iconfb_share-wrapper .tooltip_share .tooltip_link button");
const toggle_tooltip_link = document.querySelector(".news_details-body .iconfb_share-wrapper .tooltip_share #ToggleTooltipLink");
if(toggle_tooltip_link && tooltip_link && tooltip_btn){
	toggle_tooltip_link.addEventListener('click',()=>{
	tooltip_link.classList.add("active");
})	
	document.addEventListener('click', function(event) {
    if (!toggle_tooltip_link.contains(event.target) && !tooltip_link.contains(event.target)) {
        tooltip_link.classList.remove("active");
    }
});
	function HandleCoppyUrl () { 
	navigator.clipboard.writeText(window.location.href);
	tooltip_btn.innerHTML = "";
	tooltip_btn.classList.add("success");
	setTimeout(()=>{
		tooltip_btn.innerHTML = "copied";
		tooltip_btn.classList.remove("success");
	},2000)
}
}



document.addEventListener('DOMContentLoaded', function() {
    const ez_toc_list_link = document.querySelectorAll('.ez-toc-list a');
    console.log(ez_toc_list_link);

    ez_toc_list_link.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - parseFloat(getComputedStyle(document.documentElement).fontSize),
                    behavior: 'smooth'
                });
            }
        });
    });
});