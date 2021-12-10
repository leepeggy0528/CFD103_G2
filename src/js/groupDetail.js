
$(document).ready(function () {
    $(".owl-carousel").owlCarousel();
});

var owl = $('.owl-carousel');
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,

    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1024: {
            items: 1,
            stagePadding: 250,
        }
    }
});
$('.play').on('click', function () {
    owl.trigger('play.owl.autoplay', [5000])
});
$('.stop').on('click', function () {
    owl.trigger('stop.owl.autoplay')
});


let saveActivity;
function switchSaveActivity(e) {
    if (e.target.title == "收藏活動") {
        e.target.src = "./images/icon/save.png";
        e.target.title = "取消收藏";
    } else {
        e.target.src = "./images/icon/unsave.png";
        e.target.title = "收藏活動";
    }
}
function init() {
    //收藏
    saveActivity = document.querySelectorAll('#saveActivity');
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

}
window.addEventListener("load", init, false);