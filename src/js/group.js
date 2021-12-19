let saveActivity;
let filterBtn;
let filter;
let themeLabel, themeCheck;

// sort-nav focus樣式
function sortFocus(e) {
    let checkStyle = document.querySelectorAll(".sort > a")
    console.log(checkStyle);
    for (let i = 0; i < checkStyle.length; i++) {
        checkStyle[i].classList.remove("sortFocus");
    }
    e.target.classList.add("sortFocus");
}


// 開關選取器
function switchFilter() {
    let filter = document.querySelector('.filter');
    filter.classList.toggle("show-filter");
}

//選擇活動focus效果
function themeFocus(e) {
    let label = e.target;
    if (label.innerText != "全部") {
        themeLabel[0].classList.remove("filterFocus");
        label.classList.add("filterFocus");
        themeCheck[0].checked = false;


    } else if (label.innerText == "全部") {
        for (let i = 0; i < themeLabel.length; i++) {
            themeLabel[i].classList.remove("filterFocus");
            themeCheck[i].checked = false;
        }
        themeLabel[0].classList.add("filterFocus");

    }

}
// 收藏活動 

function switchSaveActivity(e) {
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

function init() {
    // 選取器收合
    filterBtn = document.querySelector('#filterIcon');
    filterBtn.onclick = switchFilter;

    // 選取主題地點focus效果
    themeCheck = document.querySelectorAll("#checkTheme input");
    console.log(themeCheck);
    themeLabel = document.querySelectorAll(".filter-main .theme li label");

    for (let i = 0; i < themeLabel.length; i++) {
        themeLabel[i].onclick = themeFocus;
    }



    // 下拉式選單
    let selectArea = document.querySelector("#selectArea");
    let optionAll = document.querySelectorAll("#selectLoc>option");
    let optionNorth = document.querySelectorAll("#selectLoc .north");
    selectArea.onchange = () => {
        // alert(selectArea.value);
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
    saveActivity = document.querySelectorAll('#saveActivity');
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

    // 去除多餘字元
    sliceTitle();
}

function windowResize() {
    sliceTitle();
}

window.addEventListener("load", init, false);
window.addEventListener("resize", windowResize, false);