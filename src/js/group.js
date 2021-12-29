let saveActivity;
let filterBtn;
let filter;
let themeLabel, themeCheck;
let locLabel, locCheck;

let themeArr = new Array();
let filterLoc;
let themes;
// sort-nav focus樣式
function sortFocus(e) {
    let checkStyle = document.querySelectorAll(".sort > a")
    for (let i = 0; i < checkStyle.length; i++) {
        checkStyle[i].classList.remove("sortFocus");
    }
    e.target.classList.add("sortFocus");
    document.getElementById('switchTitle').innerText = e.target.innerText;

}

// 開關選取器
function switchFilter() {
    let filter = document.querySelector('.filter');
    filter.classList.toggle("show-filter");
}

//選擇活動
function themeFocus(e) {
    let label = e.target;
    if (label.innerText != "全部") {
        label.classList.toggle("filterFocus");
        themeLabel[0].classList.remove("filterFocus");
        themeCheck[0].checked = false;


    } else if (label.innerText == "全部") {
        for (let i = 0; i < themeLabel.length; i++) {
            themeLabel[i].classList.remove("filterFocus");
            themeCheck[i].checked = false;
        }
        themeLabel[0].classList.add("filterFocus");
    }
}

// let filterLoc;
//選擇地點 單選
function locFocus(e) {
    let label = e.target;
    for (let i = 0; i < locLabel.length; i++) {
        locLabel[i].classList.remove("filterFocus");
    }
    label.classList.add("filterFocus");
    filterLoc = e.target.innerText.substring(0, 2);


    let xhr = new XMLHttpRequest;
    xhr.onload = function () {
        if (xhr.status == 200) {
            console.log("成功", xhr.responseText);

        } else {
            alert(xhr.status);
            console.log(xhr.responseText);
        }
    }
    xhr.open("Post", "./php/filterLoc.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = "gro_loc=" + filterLoc;

    console.log('data_info:', data_info);
    xhr.send(data_info);
}

// 收藏活動 
function switchSaveActivity(e) {

    e.stopPropagation();
    let groupId = e.currentTarget.children[1].children[0].href.split("?")[1];
    if (e.target.id == 'saveActivity') {
        if (e.target.title == "收藏活動") {
            e.target.src = "./images/icon/save.png";
            e.target.title = "取消收藏";
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {


                } else {
                    alert(xhr.status);
                }
            }
            xhr.open("Post", "./php/saveGroup.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data_info = groupId + '&mem_id=9455001';

            console.log('data_info:', data_info);
            xhr.send(data_info);

        } else {
            e.target.src = "./images/icon/unsave.png";
            e.target.title = "收藏活動";
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {

                } else {
                    alert(xhr.status);
                }
            }
            xhr.open("Post", "./php/unSaveGroup.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data_info = groupId + '&mem_id=9455001';

            console.log('data_info:', data_info);
            xhr.send(data_info);
        }
    }
}


// 去除多餘字元
function sliceTitle() {
    let groupTitle = document.querySelectorAll('.party_text .main h3 a');//活動名稱
    let cardTitle = document.querySelectorAll('.pageGroup .card'); //卡片title屬性值
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

// show group 
function showGroup(json) {
    let group = document.querySelector('.pageGroup');
    let card = document.querySelector('.pageGroup .card');
    let cardInfo = JSON.parse(json);
    let html = "";
    group.innerHTML = ""; //清空所有活動 
    for (let i in cardInfo) {
        if (cardInfo[i].gro_show == 1) {
            html += ` <div id="card" class="card">
            <div class="iSave">
                <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
            </div>
    
            <div class="pic">
                <a href="groupDetail.php?gro_id=${cardInfo[i].gro_id}">
                    <img src="./images/group/${cardInfo[i].gpt_pt}">
                </a>
            </div>
            <!-- 在外面多用一層 party_text 包 -->
            <div class="party_text">
                <div class="main">
                    <h3> <a href="groupDetail.html">${cardInfo[i].gro_name}</a></h3>
                    <p>${cardInfo[i].sche_name}</p>
                    <time>${cardInfo[i].sche_date} ${cardInfo[i].sche_starttime}</time>
                </div>
                <div class="sub">
                    <div class="author">
                        <div class="pic smCircle">
                            <img class="circle" src="./images/user/${cardInfo[i].mem_pt}">
                        </div>
                        <span>${cardInfo[i].mem_name}</span>
                    </div>
                    <div class="hot">
                        <div class="pic">
                            <img src="./images/icon/fire.png">
                        </div>
                        <span>12345</span>
                    </div>
                </div>
                <!-- 新增 see_more  -->
                <div class="see_more">
                    <a href="groupDetail.php?gro_id=${cardInfo[i].gro_id}">
                        <button class="btnYellow">詳細資訊</button>
                    </a>
                    <button class="btnBlue signUp">立即報名</button>
                </div>
                <!--  -->
            </div>
        </div>
            `;
        }

    }
    group.innerHTML = html;
    setTimeout(function () {
        // console.log("!!!!!!!!!!!!");
        init();
    }, 1000);
    // init();
}

function init() {
    // 選取器收合
    filterBtn = document.querySelector('#filterIcon');
    filterBtn.onclick = switchFilter;

    // 選取主題
    themeCheck = document.querySelectorAll("#checkFilter .themeDiv input");
    themeLabel = document.querySelectorAll(".filter-main .theme li label");

    for (let i = 0; i < themeLabel.length; i++) {
        themeLabel[i].onclick = themeFocus;
    }

    let theme = document.getElementsByName('theme[]');
    // let themeArr = new Array;
    for (let i = 0; i < theme.length; i++) {
        theme[i].onchange = function () {
            if (theme[i].checked == true) {
                themeArr.push("'" + theme[i].value + "'");
                if (theme[i].value == '全部') {

                    themeArr = ["'美食'", "'夜市'", "'運動'", "'學習'", "'休閒'", "'燒腦'", "'旅行'", "'購物'"];
                }
            } else {
                let index = themeArr.indexOf(`'${theme[i].value}'`);
                themeArr.splice(index, 1);
            }

            themes = themeArr.toString();
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    showGroup(xhr.responseText);//json
                } else {
                    alert(xhr.status);
                    console.log(xhr.responseText);
                }
            }
            xhr.open("Post", "./php/filter.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data = 'themes=' + themes;

            console.log('data_info:', data);
            xhr.send(data);

        }

    }

    //選取地點
    locCheck = document.querySelectorAll("#checkFilter .locDiv input");
    locLabel = document.querySelectorAll(".filter-main .location li label");
    for (let i = 0; i < locLabel.length; i++) {
        locLabel[i].onclick = locFocus;
    }





    // 下拉式選單
    let selectArea = document.querySelector("#selectArea");
    let optionAll = document.querySelectorAll("#selectLoc>option");
    let optionNorth = document.querySelectorAll("#selectLoc .north");
    selectArea.onchange = () => {
        switch (selectArea.value) {
            case "全部":
                for (let i = 0; i < optionAll.length; i++) {
                    optionAll[i].style.display = "block";
                }
                break;
            case "北部":
                for (let l = 0; l < optionAll.length; l++) {
                    if (optionAll[l].classList.value.indexOf('north') == -1) {
                        optionAll[l].style.display = "none";
                    } else {
                        optionAll[l].style.display = "block";
                        optionAll[0].style.display = 'block';
                        optionAll[0].selected = 'true';
                    }
                }

                break;
            case "中部":
                for (let l = 0; l < optionAll.length; l++) {
                    if (optionAll[l].classList.value.indexOf('central') == -1) {
                        optionAll[l].style.display = "none";
                    } else {
                        optionAll[l].style.display = "block";
                        optionAll[0].style.display = 'block';
                        optionAll[0].selected = 'true';
                    }
                }
                break;
            case "南部":
                for (let l = 0; l < optionAll.length; l++) {
                    if (optionAll[l].classList.value.indexOf('south') == -1) {
                        optionAll[l].style.display = "none";
                    } else {
                        optionAll[l].style.display = "block";
                        optionAll[0].style.display = 'block';
                        optionAll[0].selected = 'true';
                    }
                }
                break;
            case "離島":
                for (let l = 0; l < optionAll.length; l++) {
                    if (optionAll[l].classList.value.indexOf('outlying') == -1) {
                        optionAll[l].style.display = "none";
                    } else {
                        optionAll[l].style.display = "block";
                        optionAll[0].style.display = 'block';
                        optionAll[0].selected = 'true';
                    }
                }
                break;
        }
    }

    // 收藏
    saveActivity = document.querySelectorAll('.pageGroup .card');
    console.log("========");
    console.log(saveActivity);
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

    //sort-nav
    let sortNav = document.querySelector(".sort");
    sortNav.onclick = sortFocus;

    // 取得標題字
    let groupTitle = document.querySelectorAll('.party_text .main h3 a');
    let card = document.querySelectorAll('.pageGroup .card');
    for (let i = 0; i < card.length; i++) {
        card[i].title = groupTitle[i].innerText;
    }

    //參加活動 //==============================================
    let signUpBtn = document.querySelectorAll('.see_more .signUp');
    for (let i = 0; i < signUpBtn.length; i++) {
        signUpBtn[i].onclick = function () {
            let gro_id = signUpBtn[i].previousElementSibling.href.split("?")[1];
            console.log(gro_id);
            let xhr = new XMLHttpRequest();
            xhr.open("Post", "./php/signUpGP.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data_info = gro_id;

            console.log('data_info:', data_info);
            xhr.send(data_info);
        }
    }


    // 去除多餘字元
    sliceTitle();
}

function windowResize() {
    sliceTitle();
}

window.addEventListener("load", init, false);
window.addEventListener("resize", windowResize, false);