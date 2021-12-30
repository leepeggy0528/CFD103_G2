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


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
let saveActivity;
function switchSaveActivity(e) {
    e.stopPropagation();
    let groupId = e.currentTarget.children[1].children[0].href.split("?")[1];
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        member = JSON.parse(xhr.responseText);
        console.log(member);
        if (member.mem_id) { //已登入
            if (e.target.id == 'saveActivity') {
                if (e.target.title == "收藏活動") {
                    e.target.src = "./images/icon/save.png";
                    e.target.title = "取消收藏";
                    let xhr1 = new XMLHttpRequest();
                    xhr1.onload = function () {
                        if (xhr1.status == 200) {

                        } else {
                            alert(xhr1.status);
                        }
                    }
                    xhr1.open("Post", "./php/saveGroup.php", true);
                    xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let data_info = groupId + `&mem_id=${member.mem_id}`;

                    console.log('data_info:', data_info);
                    xhr1.send(data_info);

                } else {
                    e.target.src = "./images/icon/unsave.png";
                    e.target.title = "收藏活動";
                    let xhr1 = new XMLHttpRequest();
                    xhr1.onload = function () {
                        if (xhr1.status == 200) {

                        } else {
                            alert(xhr1.status);
                        }
                    }
                    xhr1.open("Post", "./php/unSaveGroup.php", true);
                    xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let data_info = groupId + `&mem_id=${member.mem_id}`;

                    console.log('data_info:', data_info);
                    xhr1.send(data_info);
                }
            }
        }
    }
    xhr.open("get", "./php/getMemberInfo.php", true);
    xhr.send(null);


}

//收藏this
let saveThis;
function switchSaveThis() {
    let groupId = location.href.split("?")[1];
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        member = JSON.parse(xhr.responseText);
        console.log(member);
        if (member.mem_id) { //已登入
            if (saveThis.title == "收藏活動") {
                saveThis.src = "./images/icon/save.png";
                saveThis.title = "取消收藏";
                let xhr1 = new XMLHttpRequest();
                xhr1.onload = function () {
                    if (xhr1.status == 200) {

                    } else {
                        alert(xhr1.status);
                    }
                }
                xhr1.open("Post", "./php/saveGroup.php", true);
                xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let data_info = groupId + `&mem_id=${member.mem_id}`;

                console.log('data_info:', data_info);
                xhr1.send(data_info);

            } else {
                saveThis.src = "./images/icon/unsave.png";
                saveThis.title = "收藏活動";
                let xhr1 = new XMLHttpRequest();
                xhr1.onload = function () {
                    if (xhr1.status == 200) {

                    } else {
                        alert(xhr1.status);
                    }
                }
                xhr1.open("Post", "./php/unSaveGroup.php", true);
                xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let data_info = groupId + `&mem_id=${member.mem_id}`;

                console.log('data_info:', data_info);
                xhr1.send(data_info);
            }
        }
    }
    xhr.open("get", "./php/getMemberInfo.php", true);
    xhr.send(null);


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

//dom產生留言
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

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//留言存進資料庫
function saveComment() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        member = JSON.parse(xhr.responseText);
        console.log(member);
        if (member.mem_id) { //已登入
            let textarea = document.getElementById('comment').value; //留言內容
            let xhr1 = new XMLHttpRequest();
            xhr1.onload = function () {
                if (xhr1.status == 200) {
                    console.log('success');
                } else {
                    alert(xhr1.status);
                    console.log(xhr1.responseText);
                }
            }

            let gro_id = location.href.split('?')[1]; // 取得gro_id

            xhr1.open("Post", "./php/gpComment.php", true);
            xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data = `${gro_id}&mem_id=${member.mem_id}&comment=${textarea}`;
            console.log('data_info:', data);
            xhr1.send(data);
            document.getElementById('comment').value = "";
        }
    }
    xhr.open("get", "./php/getMemberInfo.php", true);
    xhr.send(null);

}


function init() {

    // 收藏 相同地點
    saveActivity = document.querySelectorAll('.same-loc .card');
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

    // 收藏 相同活動
    let saveSameActivity = document.querySelectorAll('.similar .card');
    for (let i = 0; i < saveSameActivity.length; i++) {
        saveSameActivity[i].onclick = switchSaveActivity;
    }

    //收藏 info 
    saveThis = document.querySelector('.info #saveActivity');
    saveThis.onclick = switchSaveThis;



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

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //send comment
    document.getElementById('sendComment').onclick = function () {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            member = JSON.parse(xhr.responseText);
            console.log(member);
            if (member.mem_id) { //已登入
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
                let dataInfo = `mem_id=${member.mem_id}`;
                console.log('data_info:', dataInfo);
                xhr1.send(dataInfo);
            }
        }
        xhr.open("get", "./php/getMemberInfo.php", true);
        xhr.send(null);
    }


    // report lightbox
    document.getElementById('report').onclick = function () {
        document.querySelector(".reportLayer").style.display = "block";
    }

    // report cancel
    document.getElementById('rpCancel').onclick = function () {
        document.querySelector(".reportLayer").style.display = "none";
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // send report 
    document.getElementById('rpSend').onclick = function () {
        let gro_id = location.href.split('?')[1];
        let reportText = document.getElementById("reportText").value;
        if (reportText == "") {
            alert('原因不得空白');
        } else {

            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {

                } else {
                    alert(xhr.status);
                }
            }
            xhr.open("Post", "./php/sendReport.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data_info = gro_id + '&mem_id=9455001&status=1&content=' + reportText
                + "&gro_show=1";

            console.log('data_info:', data_info);
            xhr.send(data_info);
            document.querySelector(".reportLayer").style.display = "none";
            reportText = "";
        }
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // 報名活動
    let registerGp = document.querySelector('.info .sign-up button');
    registerGp.onclick = function () {

        alert('報名成功');
        let gro_id = location.href.split("?")[1];
        console.log(gro_id);
        let xhr = new XMLHttpRequest();
        xhr.open("Post", "./php/signUpGP.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        let data_info = gro_id + '&mem_id=9455001';
        console.log('data_info:', data_info);
        xhr.send(data_info);
    }
}


window.addEventListener("load", init, false);

window.onresize = () => {
    sliceTitle();
}
