const callSearchForm = () => {
  const searchForm = document.querySelector(".header__search_form");

  console.log("callSearchForm");
  searchForm.classList.toggle("show__search_form");
};

document.addEventListener("DOMContentLoaded", function () {
  const searchBtn = document.querySelector(".header__search_form_btn");

  if (searchBtn) {
    searchBtn.addEventListener("click", callSearchForm);
  }
});
