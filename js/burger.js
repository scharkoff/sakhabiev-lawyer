const menuBurger = document.querySelector(".menu__burger");
const menu = document.querySelector(".menu");
const menuItems = document.querySelectorAll(".menu__item");
const headerPhone = document.querySelector(".header__phone");

init();

function init() {
  if (window.innerWidth <= 1200) {
    menuBurger.classList.remove("hidden");
    headerPhone.classList.add("hidden");
  } else {
    menuBurger.classList.add("hidden");
    headerPhone.classList.remove("hidden");
  }
}

function toggleMenu() {
  menu.classList.toggle("opened");
}

menuBurger.addEventListener("click", toggleMenu);

window.addEventListener("resize", () => {
  if (window.innerWidth <= 1200 && menu.classList.contains("opened")) {
    toggleMenu();
  }

  init();
});

menuItems.forEach((item) => {
  item.addEventListener("click", () => {
    menu.classList.remove("opened");
  });
});
