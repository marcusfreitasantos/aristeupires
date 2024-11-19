let page = 2;
jQuery(document).ready(function ($) {
  $(".loadmore__btn").click(function (e) {
    e.preventDefault();

    const parts = window.location.href.split("/").filter(Boolean);
    const productCat = parts[parts.length - 1];

    document.querySelector(".custom__loader").style.display = "inline-block";
    document.querySelector(".loadmore__btn").style.display = "none";

    $.ajax({
      url: my_ajax_obj.ajax_url,
      type: "POST",
      data: {
        action: "get_products_by_ajax",
        products_page: page,
        category: productCat,
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

  $(".custom__popup_form").on("submit", function (e) {
    e.preventDefault();
    const userEmailInput = document.querySelector("#user_email");
    const userPhone = document.querySelector("#user_phone");
    const userCompanyInput = document.querySelector("#user_company_name");
    const currentUrl = window.location.href;

    document.querySelector(".custom__loader").style.display = "inline-block";
    document.querySelector(".custom__popup_form").style.display = "none";

    $.ajax({
      url: my_ajax_obj.ajax_url,
      type: "POST",
      data: {
        action: "send_email_by_ajax",
        userEmail: userEmailInput.value,
        userPhone: userPhone.value,
        userCompanyName: userCompanyInput.value,
        originUrl: currentUrl,
      },
      success: function (response) {
        document.querySelector(".custom__loader").style.display = "none";
        document.querySelector(".custom__popup_form").style.display = "block";
        userEmailInput.value = "";
        userCompanyInput.value = "";
        userPhone.value = "";

        if (response) {
          alert(
            "Email enviado com sucesso. Em breve retornaremos seu contato!"
          );
        } else {
          alert(
            "Email não enviado, tente novamente ou entre em contato com o suporte."
          );
        }
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  });
});
