function isMobileDevice() {
  return /Mobi|Android/i.test(navigator.userAgent);
}

const callSearchForm = () => {
  const searchForm = document.querySelector(".header__search_form");
  searchForm.classList.toggle("show__search_form");
};

const showMainMenu = () => {
  document.querySelector(".header__main_menu_btn").style.display = "none";
  document.querySelector(".header__main_menu_btn_close").style.display =
    "block";
  document
    .querySelector(".header__main_menu")
    .classList.add("show__header_main_menu");
};

const hideMainMenu = () => {
  document.querySelector(".header__main_menu_btn").style.display = "block";
  document.querySelector(".header__main_menu_btn_close").style.display = "none";
  document
    .querySelector(".header__main_menu")
    .classList.remove("show__header_main_menu");
};

document.addEventListener("DOMContentLoaded", function () {
  const isMobile = isMobileDevice();
  const searchBtn = document.querySelector(".header__search_form_btn");
  const headerMainMenu = document.querySelector(".custom__header");
  const headerMainMenuBtn = document.querySelector(".header__main_menu_btn");
  const headerMainMenuBtnClose = document.querySelector(
    ".header__main_menu_btn_close"
  );

  if (searchBtn && headerMainMenu) {
    searchBtn.addEventListener("click", callSearchForm);

    if (isMobile) {
      headerMainMenuBtn.addEventListener("click", showMainMenu);
      headerMainMenuBtnClose.addEventListener("click", hideMainMenu);
    } else {
      headerMainMenu.addEventListener("mouseover", showMainMenu);
      headerMainMenu.addEventListener("mouseleave", hideMainMenu);
    }
  }
});
