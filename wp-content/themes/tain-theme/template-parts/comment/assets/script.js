document.addEventListener("DOMContentLoaded", function () {
  var stars = document.querySelectorAll(".count-star");
  stars.forEach(function (star) {
    var width = star.getAttribute("data-width");
    star.style.setProperty("--star-width", width);
  });

  // Open comment form
  const comments = document.getElementById("comments");
  const btn_open_comments = document.querySelector(".btn-open-form__comment");
  const btn_open_comments_mb = document.querySelector(
    ".btn-open-form__comment__mb"
  );
  if (btn_open_comments) {
    btn_open_comments.addEventListener("click", function () {
      comments.classList.toggle("comments--open");
    });
  }
  if (btn_open_comments_mb) {
    btn_open_comments_mb.addEventListener("click", function () {
      comments.classList.toggle("comments--open");
    });
  }
  const comment_item = document.querySelector(".comment");
  if (!comment_item) {
    comments.classList.add("comments--open");
  }
  // Validate form
  const commentForm = document.getElementById("commentform");
  if (commentForm) {
    commentForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Check if the user is an admin by looking for a specific body class added by WordPress
      const isAdmin =
        document.body.classList.contains("logged-in") &&
        document.body.classList.contains("role-administrator");

      // Skip validation for admins
      if (isAdmin) {
        HTMLFormElement.prototype.submit.call(commentForm);
        return;
      }

      const ratingFormComment = document.querySelectorAll(
        'input[name="rating"]'
      );
      const emailField = document.getElementById("email");
      const nameField = document.getElementById("author");
      const commentField = document.getElementById("comment");
      const errorField = document.querySelector(".cookies-error");

      let hasError = false;
      let errorMessage = "";

      // Hide the error message initially if it exists
      if (errorField) {
        errorField.style.display = "none";
        errorField.innerText = "";
      }

      // Check name field if it exists
      if (nameField) {
        const name = nameField.value.trim();
        if (name === "") {
          errorMessage += "Name is required. ";
          hasError = true;
        }
      }

      // Check email field if it exists
      if (emailField) {
        const email = emailField.value.trim();
        if (email === "") {
          emailField.value = "example@example.com"; // Set default email
        }
      }

      // Check comment field if it exists
      if (commentField) {
        const comment = commentField.value.trim();
        if (comment === "") {
          errorMessage += "Comment is required. ";
          hasError = true;
        }
      }

      // Check rating field
      let ratingSelected = false;
      ratingFormComment.forEach(function (rating) {
        if (rating.checked) {
          ratingSelected = true;
        }
      });

      if (!ratingSelected) {
        errorMessage += "Rating is required. ";
        hasError = true;
      }

      // If there are errors, show the error message and prevent form submission
      if (hasError) {
        if (errorField) {
          errorField.innerText = errorMessage.trim();
          errorField.style.display = "block";
        }
      } else {
        // If no errors, submit the form
        if (commentForm && commentForm.tagName === "FORM") {
          console.log("submit");
          HTMLFormElement.prototype.submit.call(commentForm);
        } else {
          console.error("Element with ID 'commentform' is not a form.");
        }
      }
    });
  }
});
document.addEventListener("DOMContentLoaded", function () {
  // Function to scroll to the .comment-info element
  function scrollToCommentInfo() {
    const commentInfoElement = document.querySelector(".comment-info");
    if (commentInfoElement) {
      const offset = 100; // Adjust this value to match the height of your fixed header
      const elementPosition = commentInfoElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - offset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    }
  }

  // Check if the URL contains a hash or a relevant parameter
  const hash = window.location.hash;
  const url = window.location.href;
  if (
    (hash && hash.startsWith("#comment-")) ||
    url.indexOf("comment-page-") !== -1 ||
    url.includes("sort")
  ) {
    scrollToCommentInfo();
  }
});
//ajax
