
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
        e.target.src = "../images/icon/save.png";
        e.target.title = "取消收藏";
    } else {
        e.target.src = "../images/icon/unsave.png";
        e.target.title = "收藏活動";
    }
}




// 去除多餘字元
function sliceTitle() {
    let groupTitle = document.querySelectorAll('.container .party_text .main h3 a');//活動名稱
    let cardTitle = document.querySelectorAll('.container .card'); //卡片title屬性值
    let screenWidth = window.screen.width; // 抓視窗大小

    for (let i = 0; i < groupTitle.length; i++) {
        if (screenWidth <= 375) {
            if (cardTitle[i].title.length > 15) {
                groupTitle[i].innerText = cardTitle[i].title.slice(0, 15) + "...";
            }

        } else {

            if (cardTitle[i].title.length > 25) {
                groupTitle[i].innerText = cardTitle[i].title.slice(0, 25) + "...";
            }
        }
    }
}
function init() {
    let screenW = window.screen.width;
    console.log(screenW);
    //收藏
    saveActivity = document.querySelectorAll('#saveActivity');
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

    //手機板資訊欄收合
    document.getElementById('info-toggle').onclick = () => {
        let btnIcon = document.querySelector('#info-toggle img');
        let info = document.querySelector('aside .info-wrap .main-info');


        if (btnIcon.title == '關閉資訊') {
            info.style.display = 'block';
            btnIcon.title = '展開資訊'
            btnIcon.src = './images/icon/down.png';
        } else {
            info.style.display = 'none';
            btnIcon.title = '關閉資訊'
            btnIcon.src = './images/icon/up.png';
        }

    }

    // 取得標題字
    let groupTitle = document.querySelectorAll('.container .party_text .main h3 a');
    let card = document.querySelectorAll('.container .card');
    console.log(card[0]);
    for (let i = 0; i < card.length; i++) {
        card[i].title = groupTitle[i].innerText;
    }

    // 去除多餘字元
    sliceTitle();
}

window.addEventListener("load", init, false);

window.onresize = () => {
    sliceTitle();
}
