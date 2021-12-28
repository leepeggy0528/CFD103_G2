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

    //upload sticker preview
    document.getElementById("upSticker").onchange = function (e) {
        let file = e.target.files[0];
        // file info
        console.log(file);
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById("preview1").hidden = false;
            document.getElementById("preview1").src = reader.result;
        }
        reader.readAsDataURL(file);
    }
    // remove sticker
    let cardRows = document.querySelectorAll('.cardRow');
    for (let i = 0; i < cardRows.length; i++) {
        cardRows[i].onclick = function (e) {
            if (e.target.classList.value.indexOf('trash') != -1) {
                //卡片號碼
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

    // add sticker

    document.getElementById('addStickerBtn').onclick = function () {
        // let stickerName = document.getElementById('stickerName').value;
        // let file_info = document.getElementById("upSticker").files[0];//檔案資訊
        let stickerForm = document.getElementById('stickerForm');//form表單
        let form_data = new FormData(stickerForm);
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {

                console.log("成功:", xhr.responseText);
            } else {
                alert(xhr.status);
                console.log("失敗:", xhr.responseText);
            }
        }
        xhr.open("Post", "./php/backstage_addSticker.php", true);
        // xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhr.send(form_data);

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