let saveActivity;
let filterBtn;
let filter;

function switchFilter() {
    let filter = document.querySelector('.filter');
    console.log(filter);
    filter.classList.toggle("show-filter");

}


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
    //選取器
    filterBtn = document.querySelector('#filterIcon');
    filterBtn.onclick = switchFilter;

    //收藏
    saveActivity = document.querySelectorAll('#saveActivity');
    for (let i = 0; i < saveActivity.length; i++) {
        saveActivity[i].onclick = switchSaveActivity;
    }

}
window.addEventListener("load", init, false);