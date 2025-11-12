// document.addEventListener('DOMContentLoaded', function() {
//   var form = document.getElementById('form-footer');
//   if (form) {
//       form.addEventListener('submit', function(event) {
//           var submitButton = form.querySelector('input[type="submit"]');
//           if (submitButton) {
//               submitButton.disabled = true;
//               submitButton.value = 'Sending';
//           }
//       });
//       form.addEventListener('wpcf7submit', function(event) {
//           var submitButton = form.querySelector('input[type="submit"]');
//           if (submitButton) {
//               submitButton.disabled = false;
//               submitButton.value = 'Submit';
//           }
//       });
//     }
//   });

// Selectors for inputs and labels
const inputs = {
  name: document.querySelector("span[data-name=your-name] input"),
  email: document.querySelector("span[data-name=your-email] input"),
  phone: document.querySelector("span[data-name=phone-number] input"),
  message: document.querySelector("span[data-name=your-message] input"),
};

const placeholders = {
  email: inputs.email.placeholder,
  message: inputs.message.placeholder,
};

const labels = {
  required: document.querySelectorAll("form .field_required p span"),
  emailError: document.querySelector("form p .errorEmail"),
  phoneError: document.querySelector(".span-phone"),
  validationFields: document.querySelectorAll(".contact_form form .field_required"),
};

// Utility functions
const toggleDisplay = (element, show) => {
  element.style.display = show ? "block" : "none";
};

const setPlaceholder = (input, placeholder) => {
  input.placeholder = placeholder;
};

const validateEmail = (email) => {
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailRegex.test(email) && !/\s/.test(email);
};

const validatePhone = (phone) => {
  const phoneRegex = /^[0-9]+(\.[0-9]+)?$/;
  return phoneRegex.test(phone) && phone.trim().length < 11;
};

// Event Listeners for input fields
inputs.name.addEventListener("focus", () => toggleDisplay(labels.required[1], false));
inputs.name.addEventListener("blur", () => toggleDisplay(labels.required[1], inputs.name.value === ""));
inputs.name.addEventListener("input", () => {
  const isValid = inputs.name.value !== "";
  toggleDisplay(labels.required[1], !isValid);
  labels.validationFields[0].classList.toggle("validation", !isValid);
});

inputs.email.addEventListener("focus", () => setPlaceholder(inputs.email, ""));
inputs.email.addEventListener("blur", () => setPlaceholder(inputs.email, placeholders.email));
inputs.email.addEventListener("change", () => {
  const isValid = validateEmail(inputs.email.value);
  labels.emailError.innerText = isValid || inputs.email.value === "" ? "" : "Invalid your email address";
});

inputs.phone.addEventListener("focus", () => toggleDisplay(labels.phoneError, false));
inputs.phone.addEventListener("blur", () => toggleDisplay(labels.phoneError, inputs.phone.value === ""));
inputs.phone.addEventListener("input", () => {
  const isValid = validatePhone(inputs.phone.value);
  labels.validationFields[1].classList.toggle("validation", !isValid);
  toggleDisplay(labels.required[3], inputs.phone.value === "");
});

inputs.message.addEventListener("focus", () => setPlaceholder(inputs.message, ""));
inputs.message.addEventListener("blur", () => setPlaceholder(inputs.message, placeholders.message));

// Handling form submission
const form = document.querySelector(".wpcf7 form");
const submitButton = form.querySelector(".wpcf7-submit");
const popupNotification = document.querySelector(".popup_notification");
const overPopup = document.getElementById("overPopup");

// Move popups to body
document.body.prepend(overPopup, popupNotification);

form.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  const isValidName = inputs.name.value !== "";
  const isValidEmail = inputs.email.value ? validateEmail(inputs.email.value) : true;
  const isValidPhone = validatePhone(inputs.phone.value);

  labels.validationFields[0].classList.toggle("validation", !isValidName);
  labels.emailError.innerText = isValidEmail ? "" : "Invalid your email address";
  labels.validationFields[1].classList.toggle("validation", !isValidPhone);

  if (isValidName && isValidEmail && isValidPhone) {
    // Manually submit the form via AJAX
    // wpcf7.submit(form);
    overPopup.classList.add("active");
    popupNotification.classList.add("active");
    document.body.style.overflow = "hidden";
  }

});

// Handling form submission success
// document.addEventListener("wpcf7mailsent", () => {
//   overPopup.classList.add("active");
//   popupNotification.classList.add("active");
//   document.body.style.overflow = "hidden";
// });

// Close notification popup
const closeModalNotification = () => {
  overPopup.classList.remove("active");
  popupNotification.classList.remove("active");
  document.body.style.overflow = "auto";
  toggleDisplay(labels.required[1], true);
  toggleDisplay(labels.required[3], true);
};

// Assuming there is a close button for the popup
document.querySelector(".close-popup").addEventListener("click", closeModalNotification);
