let close, open, sendCardLayer, selectCard, sendBtn, tagParent, pattern, sticker;


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


//選取貼紙的樣式
function addStickerBg(e) {
    e.currentTarget.classList.toggle("stickerFocus");
    let src = e.target.src;
    console.log("addSticker src:", src);
    CreatStickerNode(src);
}


//增加貼紙到預覽畫面上
function CreatStickerNode(selectStickerSrc) {
    let StickerParentNode = document.querySelector('.addStickerWrap');
    let stickerSample = document.querySelector(".sticker-item"); // 找第一個
    let allSticker = document.querySelectorAll(".sticker-item"); // 找全部

    let newSticker = stickerSample.cloneNode(true);
    console.log("allSticker.length ", allSticker.length);
    if (allSticker.length > 1) {
        console.log("selectStickerSrc:", selectStickerSrc);
        let i = 0;
        for (i = allSticker.length - 1; i >= 1; i--) {
            // i++;
            console.log("src:", allSticker[i].src);
            if (allSticker[i].src.indexOf(selectStickerSrc) != -1) {
                removeSticker(i);
                break;
            } else {

                StickerParentNode.appendChild(newSticker);
                newSticker.src = selectStickerSrc;
            }
        }  //6
    } else {
        StickerParentNode.appendChild(newSticker);
        newSticker.src = selectStickerSrc;
    }

}


// 移除已經有在畫面上的sticker
function removeSticker(i) {
    let allSticker = document.querySelectorAll(".sticker-item");
    allSticker[i].remove();
}

//先找到是否有相同src的img有的話 移除node

//寄出卡片
function sendCard(e) {
    let sendCardBtn = e.target;
    sendCardBtn.classList.add('mailed');
    sendCardBtn.innerText = "已寄出";
    sendCardBtn.disabled = "disabled";
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


    // 選取貼紙效果
    sticker = document.querySelectorAll(".sticker>.pic");
    for (let k = 0; k < sticker.length; k++) {
        sticker[k].onclick = addStickerBg;
        // sticker[k].addEventListener("click", addStickerBg, false);
    }


    // 開啟寄出卡片的light box
    close.onclick = closeSendCard;


    // 關閉寄出卡片的light box
    open.onclick = openSendCard;


    //寄出卡片light box內的寄送按鈕
    for (let i = 0; i < sendBtn.length; i++) {
        sendBtn[i].onclick = sendCard;
    }


}
window.addEventListener("load", init, false);