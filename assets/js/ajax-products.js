let page = 2;
jQuery(document).ready(function ($) {
  $(".loadmore__btn").click(function (e) {
    e.preventDefault();

    document.querySelector(".custom__loader").style.display = "inline-block";
    document.querySelector(".loadmore__btn").style.display = "none";

    $.ajax({
      url: my_ajax_obj.ajax_url,
      type: "POST",
      data: {
        action: "get_products_by_ajax",
        products_page: page,
      },
      success: function (response) {
        $("#products__list").append(response);
        page++;
        document.querySelector(".custom__loader").style.display = "none";
        document.querySelector(".loadmore__btn").style.display = "inline-block";
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  });
});
