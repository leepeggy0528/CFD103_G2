$(".edit").click(function (e) {
    $(e.target).closest("div").toggleClass("openControl");
   });

$("#afterLogin").click(function (e) {
    $(".smallMemInfo").toggleClass("openInfo");
   });
