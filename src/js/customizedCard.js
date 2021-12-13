let close, open, sendCardLayer, selectCard, sendBtn;

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

//預覽卡片樣式
function previewCardPattern(e) {
    let src = e.target.src;
    document.getElementById('preivewCardPattern').src = src;//點小圖換大圖

    let cardEffect = document.getElementsByClassName('selectCard');//清除class
    for (let i = 0; i < cardEffect.length; i++) {
        console.log(i, cardEffect[i].classList.value);
        cardEffect[i].classList.remove("cardFocus");
    }

    e.target.classList.add("cardFocus");//增加卡片選取效果
}

//寄出卡片
function sendCard(e) {
    let sendCardBtn = e.target;
    console.log(sendCardBtn);
    sendCardBtn.classList.add('mailed');
    sendCardBtn.innerText = "已寄出";
    sendCardBtn.disabled = "disabled";
}



function init() {
    close = document.getElementById("close");
    open = document.getElementById("open");
    selectCard = document.querySelectorAll(".selectCard");
    sendBtn = document.querySelectorAll('.send');



    //註冊事件
    for (let i = 0; i < selectCard.length; i++) {
        selectCard[i].onclick = previewCardPattern; //選取卡片樣式
    }
    close.onclick = closeSendCard;  // 開啟寄出卡片的light box
    open.onclick = openSendCard;    // 關閉寄出卡片的light box
    for (let i = 0; i < sendBtn.length; i++) { //寄出卡片light box內的寄送按鈕
        sendBtn[i].onclick = sendCard;
    }
}
window.addEventListener("load", init, false);