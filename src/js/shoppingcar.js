let storage = localStorage;
function doFirst(){
    // 幫每個 Add Cart 建立事件聆聽
    let list = document.querySelectorAll('.addbutton');
    for(let i = 0; i < list.length; i++){
        list[i].addEventListener('click', function(e){
            let teddyInfo = document.querySelector(`#${e.target.id} input`).value;
            addItem(e.target.id, teddyInfo);
        });
    }
}
window.addEventListener('load', doFirst);