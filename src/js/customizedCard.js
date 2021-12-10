let close;
let open;
let selectFdList;

function closeFdList() {
    selectFdList = document.getElementById("selectFdList");
    console.log(selectFdList);
    selectFdList.style.display = "none";
}

function openFdList() {
    selectFdList = document.getElementById("selectFdList");
    selectFdList.style.display = "block";
    console.log(selectFdList);
}


function init() {
    close = document.getElementById("closeFdList");
    open = document.getElementById("openFdList");

    close.onclick = closeFdList;
    open.onclick = openFdList;
}
window.addEventListener("load", init, false);