function form() {
    document.getElementById('add').style.display = '';
}

function cancelform() {
    document.getElementById('add').style.display = 'none';
    document.getElementById("preview").hidden = true;
}
function form1() {
    document.getElementById('sadd').style.display = '';
}

function cancelform1() {
    document.getElementById('sadd').style.display = 'none';
    document.getElementById("preview1").hidden = true;
}

function addStickerRow() {
    let tbody = document.getElementById('stickerTbody');
    let tr = document.createElement('tr');
    let no = parseInt(tbody.lastElementChild.firstElementChild.innerText) + 1;

    let src = document.querySelector('#stickerForm .pt img').src;
    let name = document.querySelector('#stickerForm #stickerName').value;
    tr.innerHTML = `
        <td>${no}</td>
        <td><div class="card"><img src="${src}" alt=""></div></td>
        <td>${name}</td>
        <td>
            <ul class="action-list">
               <li><i style="cursor:pointer;color:blue;"class="fa fa-trash"></i></li>
            </ul>
        </td>
    `;
    tbody.appendChild(tr);
    document.getElementById("stickerForm").reset();
    document.querySelector('#stickerForm .pt img').src = "";
}

function addCardRow() {
    let status = document.getElementById("status").value;
    let tbody = document.getElementById('cardTbody');
    let tr = document.createElement('tr');
    let no = parseInt(tbody.lastElementChild.firstElementChild.innerText) + 1;
    let src = document.querySelector('#cardForm .pt img').src;
    let name = document.querySelector('#cardForm #cardName').value;

    if (status == 0) {
        tr.setAttribute("data-status", "up");
        tr.innerHTML = `
        <td>${no}</td>
        <td><div class="card"><img src="${src}"></div></td>
        <td>${name}</td>
        <td><label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" checked>
            <span class="custom-control-indicator"></span>
        </label></td>
        <td>
            <ul class="action-list">
                <li><i style="cursor:pointer;color:blue;" class="fa fa-trash"></i></li>
            </ul>
        </td>
    `;
    } else {
        tr.setAttribute("data-status", "down");
        tr.innerHTML = `
        <td>${no}</td>
        <td><div class="card"><img src="${src}"></div></td>
        <td>${name}</td>
        <td><label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
        </label></td>
        <td>
            <ul class="action-list">
                <li><i style="cursor:pointer;color:blue;" class="fa fa-trash"></i></li>
            </ul>
        </td>
    `;
    }

    tbody.appendChild(tr);
    tr.classList.add('.cardRow');
    tr.setAttribute(name, value);
    document.getElementById("cardForm").reset();
    document.querySelector('#cardForm .pt img').src = "";
}

//卡片狀態
function changeStatus() {

}

window.addEventListener("load", function () {

    //upload card preview
    document.getElementById("upCard").onchange = function (e) {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById("preview").hidden = false;
            document.getElementById("preview").src = reader.result;
        }
        reader.readAsDataURL(file);
    }

    //remove card
    let cardRows = document.querySelectorAll('.cardRow');
    for (let i = 0; i < cardRows.length; i++) {
        cardRows[i].onclick = function (e) {
            if (e.target.classList.value.indexOf('trash') != -1) {
                let removeConfirm = confirm('確定要刪除卡片？');
                if (removeConfirm) {
                    let cardNo = e.currentTarget.children[0].innerText;
                    e.currentTarget.remove();

                    let xhr = new XMLHttpRequest();
                    xhr.onload = function () {
                        if (xhr.status == 200) {

                        } else {
                            alert(xhr.status);
                        }
                    }
                    xhr.open("Post", "./php/backstage_removeCard.php", true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let data_info = 'cardNo=' + cardNo;

                    console.log('data_info:', data_info);
                    xhr.send(data_info);
                }
            }
        }
    }

    //add card
    document.getElementById('addCardBtn').onclick = function () {
        let cardForm = document.getElementById('cardForm');//form表單
        let form_data = new FormData(cardForm);
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                addCardRow()

            } else {
                alert(xhr.status);
                console.log("失敗:", xhr.responseText);
            }
        }
        xhr.open("Post", "./php/backstage_addCard.php", true);
        xhr.send(form_data);

        document.getElementById('add').style.display = "none";
    }


    //upload sticker preview
    document.getElementById("upSticker").onchange = function (e) {
        let file = e.target.files[0];
        // file info
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById("preview1").hidden = false;
            document.getElementById("preview1").src = reader.result;
        }
        reader.readAsDataURL(file);
    }
    // remove sticker
    let stickerRows = document.querySelectorAll('.stickerRow');
    for (let i = 0; i < stickerRows.length; i++) {
        stickerRows[i].onclick = function (e) {

            if (e.target.classList.value.indexOf('trash') != -1) {
                let removeConfirm = confirm('確定要刪除貼紙？');
                if (removeConfirm) {
                    let stickerNo = e.currentTarget.children[0].innerText;

                    e.currentTarget.remove();
                    let xhr = new XMLHttpRequest();
                    xhr.onload = function () {
                        if (xhr.status == 200) {

                        } else {
                            alert(xhr.status);
                        }
                    }
                    xhr.open("Post", "./php/backstage_removeSticker.php", true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let data_info = 'stickerNo=' + stickerNo;

                    console.log('data_info:', data_info);
                    xhr.send(data_info);
                }
            }
        }
    }

    // add sticker
    document.getElementById('addStickerBtn').onclick = function () {
        let stickerForm = document.getElementById('stickerForm');//form表單
        let form_data = new FormData(stickerForm);
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                addStickerRow()
                console.log("成功:", xhr.responseText);


            } else {
                alert(xhr.status);
                console.log("失敗:", xhr.responseText);
            }
        }
        xhr.open("Post", "./php/backstage_addSticker.php", true);
        xhr.send(form_data);

        document.getElementById('sadd').style.display = "none";
    }

    //status control
    let dataStatus = document.querySelectorAll('.cardRow');
    let statusControl = document.querySelectorAll('.custom-control-input');

    for (let i = 0; i < statusControl.length; i++) {

        statusControl[i].onchange = function (e) {

            changeStatus()
            console.log(e.target);
            let no = e.target.parentNode.parentNode.parentNode.firstElementChild.innerText;
            console.log(no);
            let cardStatus;
            if (e.target.checked) {
                cardStatus = 0;//上架
                dataStatus[i].setAttribute('data-status', 'up');
                alert('已上架');
            } else {
                cardStatus = 1;//下架
                dataStatus[i].setAttribute('data-status', 'down');
                alert('已下架');
            }
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {

                } else {
                    alert(xhr.status);
                }
            }
            xhr.open("Post", "./php/backstage_changeStatus.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data_info = `no=${no}&cardStatus=${cardStatus}`;

            console.log('data_info:', data_info);
            xhr.send(data_info);

        }


    }


    let add = document.getElementById('new');
    let cancel = document.getElementById('cancel');
    let add1 = document.getElementById('new1');
    let cancel1 = document.getElementById('cancel1');
    add.onclick = form;
    cancel.onclick = cancelform;
    add1.onclick = form1;
    cancel1.onclick = cancelform1;
}, false);