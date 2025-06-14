'use strict';

/**
 * navbar variables
 */

const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const header = document.querySelector("[data-header]");

navToggleBtn.addEventListener("click", function () {
  header.classList.toggle("active");
});

/**
 * Login & Signup
 */

const formOpenBtn = document.querySelector("#form-open");
const login = document.querySelector(".login");
const formContainer = document.querySelector(".form-container");
const formCloseBtn = document.querySelector(".form-close");
const signupBtn =  document.querySelector(".login-register");
const loginBtn = document.querySelector(".login-login");
const password = document.querySelectorAll(".password");

formOpenBtn.addEventListener("click", () => login.classList.add("show"));
formCloseBtn.addEventListener("click", () => login.classList.remove("show"));

password.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getpwInput = icon.parentElement.querySelector("input");
    if (getpwInput.type === "password") {
      getpwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    }else {
      getpwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});

loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});
