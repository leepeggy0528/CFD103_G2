let close, open, sendCardLayer, selectCard, sendBtn, tagParent, pattern, sticker;
let stickers, boxes;
let stickersInBox, trashCan, theBox;
//打開好友列
function openSendCard() {
    sendCardLayer = document.getElementById("sendCardLayer");
    sendCardLayer.style.display = "block";
}

//關閉好友列
function closeSendCard() {
    sendCardLayer = document.getElementById("sendCardLayer");
    sendCardLayer.style.display = "none";
}

// tag標籤focus的樣式 及 切換面板
function tagFocus(e) {
    for (let j = 0; j < tagParent.children.length; j++) {
        tagParent.children[j].classList.remove("tag-focus");
        pattern.children[j].classList.remove("hidden");
    }
    e.target.classList.add("tag-focus");

    switch (e.target.innerText) {
        case "卡片":
            document.querySelector(".sticker").classList.add("hidden");
            break;
        case "貼紙":
            document.querySelector(".card-pattern").classList.add("hidden");
            break;
    }
}


//預覽卡片樣式
function previewCardPattern(e) {
    let src = e.target.src;
    document.getElementById('preivewCardPattern').src = src;//點小圖換大圖

    let card = document.querySelectorAll('.card-pattern .pic');//清除class
    for (let i = 0; i < card.length; i++) {
        card[i].classList.remove("cardFocus");
    }

    e.target.parentNode.classList.add("cardFocus");//增加卡片選取效果
}


//寄出卡片
function sendCard(e) {
    let sendCardBtn = e.target;
    sendCardBtn.classList.add('mailed');
    sendCardBtn.innerText = "已寄出";
    sendCardBtn.disabled = "disabled";
}

//=============drag and drop================

//開始拖拉
function startDrag(e) {
    let data = `<img class="selectCard" src="
    ${e.target.src}">`
    e.dataTransfer.setData('image/png', data);

    // for (let j = 0; j < boxes.length; j++) {
    //     boxes[j].style.border = "5px dashed red";
    // }
    for (let i = 0; i < boxes.length; i++) {
        if (boxes[i].hasChildNodes() == true) {
            boxes[i].style.border = "none";
        } else {
            boxes[i].style.border = "5px dashed red";
        }

    }
}

//結束拖拉
function endDrag() {
    for (let j = 0; j < boxes.length; j++) {
        boxes[j].style.border = 'none';
    }
}

//正在拉
function dragOver(e) {
    e.preventDefault();
}

//放圖
function dropped(e) {
    e.preventDefault();
    e.target.innerHTML = e.dataTransfer.getData('image/png');
    e.dataTransfer.clearData();

    //註冊預覽畫面上貼紙的事件
    stickersInBox = document.querySelectorAll('.stickerPos .box > img');
    for (let i = 0; i < stickersInBox.length; i++) {
        stickersInBox[i].addEventListener('dragstart', trashStartDrag);
        stickersInBox[i].addEventListener('dragend', trashEndDrag);
    }
}


//拖拉預覽畫面的貼紙，丟進垃圾桶
function trashStartDrag(e) {
    theBox = e.target.parentNode.classList.value;
    console.log(e.target);
    e.target.parentNode.style.border = "5px dashed red";
    e.dataTransfer.setData('theBox/classlist', theBox);
    trashCan.children[0].src = "./images/icon/trash_can_open.png";
}


function trashDragOver(e) {
    e.preventDefault();
    trashCan.children[0].src = "./images/icon/trash_can_open.png";
}
function trashEndDrag(e) {
    e.preventDefault();
    e.target.parentNode.style.border = "none";
    trashCan.children[0].src = "./images/icon/trash_can_close.png";

}

function trashDragLeave(e) {
    trashCan.children[0].src = "./images/icon/trash_can_close.png";
}

function trashDropped(e) {
    let a = 'box ';
    let dot = '.';
    trashCan.children[0].src = "./images/icon/trash_can_close.png";
    let stickerBox = document.querySelector(e.dataTransfer.getData('theBox/classlist').replace(a, dot)); //parent
    stickerBox.style.border = "none";
    stickerBox.removeChild(stickerBox.children[0]);
}

function drawCanvas() {
    let canvas = document.getElementById('canvas');
    let ctx = canvas.getContext('2d');

    // 取得卡片長 & 寬 
    let width = document.getElementById('preivewCardPattern').width;
    let height = document.getElementById('preivewCardPattern').height;

    // 設定canvas長 & 寬
    canvas.height = height;
    canvas.width = width;
    canvas.style.border = '1px solid black';

    //放入卡片
    let cardImg = new Image();
    cardImg.src = document.getElementById('preivewCardPattern').src;
    console.log(cardImg);
    ctx.drawImage((cardImg), 0, 0, width, height);

}


function init() {
    close = document.getElementById("close");
    open = document.getElementById("open");
    selectCard = document.querySelectorAll(".selectCard");
    sendBtn = document.querySelectorAll('.send');
    tagParent = document.querySelector('.tag-wrapper');
    pattern = document.querySelector('.wrap-pattern');


    //選取pattern標籤的效果 
    for (let j = 0; j < tagParent.children.length; j++) {
        tagParent.children[j].onclick = tagFocus;
    }


    //選取卡片效果 + 卡片大圖預覽
    for (let i = 0; i < selectCard.length; i++) {
        selectCard[i].onclick = previewCardPattern;
    }

    //拖拉圖片
    stickers = document.querySelectorAll('.sticker .pic img');
    boxes = document.querySelectorAll('.box');
    for (let i = 0; i < stickers.length; i++) {
        stickers[i].addEventListener('dragstart', startDrag);
        stickers[i].addEventListener('dragend', endDrag);
    }

    for (let j = 0; j < boxes.length; j++) {
        boxes[j].addEventListener('dragover', dragOver);
        boxes[j].addEventListener('drop', dropped);
    }

    //註冊垃圾桶dropover and drop 
    trashCan = document.getElementById('trashCan');
    trashCan.addEventListener('dragover', trashDragOver);
    // trashCan.addEventListener('dragleave', trashDragLeave);
    trashCan.addEventListener('drop', trashDropped);

    // 開啟寄出卡片的light box
    close.onclick = closeSendCard;


    // 關閉寄出卡片的light box
    open.onclick = openSendCard;


    //寄出卡片light box內的寄送按鈕
    for (let i = 0; i < sendBtn.length; i++) {
        sendBtn[i].onclick = sendCard;
    }

    //canvas
    document.getElementById('download').onclick = drawCanvas;

}


window.addEventListener("load", init, false);