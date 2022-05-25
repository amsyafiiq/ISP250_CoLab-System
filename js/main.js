const hamburger = document.querySelector(".hamburger");
const navbar = document.querySelector(".navbar");
const darken = document.querySelector(".darken");

hamburger.addEventListener("click", openMenu);

function openMenu() {
  navbar.classList.toggle("active");
  darken.classList.toggle("active");
}

const navLink = document.querySelectorAll(".nav-link");

navLink.forEach((n) => n.addEventListener("click", closeMenu));

function closeMenu() {
  navbar.classList.remove("active");
  darken.classList.remove("active");
}

darken.addEventListener("click", closeMenu);