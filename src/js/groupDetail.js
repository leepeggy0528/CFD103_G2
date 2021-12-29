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
    console.log('click');
    if (e.target.title == "收藏活動") {
        e.target.src = "./images/icon/save.png";
        e.target.title = "取消收藏";
    } else {
        e.target.src = "./images/icon/unsave.png";
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

//動態產生留言
function leaveComment(json) {
    let memInfo = JSON.parse(json);
    let comment = document.getElementById('comment').value; //留言內容




    let today = new Date();
    let y = today.getFullYear();
    let m = today.getMonth() + 1;
    let d = today.getDate();
    let hh = today.getHours();
    let mm = today.getMinutes();
    let ss = today.getSeconds();
    let datetime = `${y}-${m}-${d} ${hh}:${mm}:${ss}`;

    if (comment == '') {
        alert('請輸入留言內容');
    } else {
        let parent = document.querySelector('.comment .wrap')
        let li = document.createElement('li');
        li.classList.add('wrap-item');
        let commentItem = `        
            <div class="user">
                <div class="pic smCircle">
                    <img class="circle" src="./images/user/${memInfo.mem_pt}">
                </div>
                <span id="userName">${memInfo.mem_name}</span>
            </div>
            <p>${comment}</p>
            <time>${datetime}</time>`;
        li.innerHTML = commentItem;
        parent.appendChild(li);

    }

}


//留言存進資料庫
function saveComment() {
    let textarea = document.getElementById('comment').value; //留言內容
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            console.log('success');
        } else {
            alert(xhr.status);
            console.log(xhr.responseText);
        }
    }

    let gro_id = location.href.split('?')[1]; // 取得gro_id

    xhr.open("Post", "./php/gpComment.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data = `${gro_id}&mem_id=9455001&comment=${textarea}`;
    console.log('data_info:', data);
    xhr.send(data);
    document.getElementById('comment').value = "";
}


function init() {

    // 收藏
    saveActivity = document.querySelectorAll('#saveActivity');
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

    //手機板資訊欄收合
    document.getElementById('info-toggle').onclick = () => {
        let btnIcon = document.querySelector('#info-toggle img');
        let info = document.querySelector('aside .info-wrap .main-info');
        console.log('click');

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
    for (let i = 0; i < card.length; i++) {
        card[i].title = groupTitle[i].innerText;
    }

    // 去除多餘字元
    sliceTitle();

    //send comment
    document.getElementById('sendComment').onclick = function () {

        //取得會員名稱、頭貼
        let xhr1 = new XMLHttpRequest();
        xhr1.onload = function () {
            if (xhr1.status == 200) {
                leaveComment(xhr1.responseText);
                saveComment();
            } else {
                alert(xhr1.status);
                console.log(xhr1.responseText);
            }
        }
        xhr1.open("Post", "./php/getMemberName.php", true);
        xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        let dataInfo = 'mem_id=9455001';
        console.log('data_info:', dataInfo);
        xhr1.send(dataInfo);
    }

    //取得網址

}


window.addEventListener("load", init, false);

window.onresize = () => {
    sliceTitle();
}
