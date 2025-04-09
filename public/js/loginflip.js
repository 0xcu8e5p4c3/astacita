const wrapper = document.getElementById('flipWrapper');
const panels = document.querySelectorAll('.form-panel');

function flipTo(target) {
  wrapper.classList.remove('rotate-y-left', 'rotate-y-right');
  panels.forEach(p => p.classList.remove('active'));

  if (target === 'signup') {
    wrapper.classList.add('rotate-y-right');
  } else if (target === 'forgot') {
    wrapper.classList.add('rotate-y-left');
  }

  setTimeout(() => {
    document.querySelector(`.panel-${target === 'user' ? 'user' : target}`).classList.add('active');
  }, 400);
}

function togglePassword(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon = document.getElementById(iconId);
  input.type = input.type === "password" ? "text" : "password";
  icon.classList.toggle("fa-eye");
  icon.classList.toggle("fa-eye-slash");
}
function showSpinner(formId, buttonId) {
const form = document.getElementById(formId);
const button = document.getElementById(buttonId);

form.addEventListener("submit", function () {
  const spinner = button.querySelector(".spinner");
  const text = button.querySelector(".btn-text");

  spinner.classList.remove("hidden");
  text.textContent = "Processing...";
  button.disabled = true;
});
}

showSpinner("loginForm", "loginSubmitBtn");
showSpinner("registerForm", "registerSubmitBtn");
showSpinner("forgotForm", "forgotSubmitBtn");