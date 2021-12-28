function cancelform() {
    $id('edit_form').style.display='none';
  }
  function searchForm(e){ 
    let edit=e.target;
    let editId=edit.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
    console.log(editId);
    $id('edit_form').style.display='';
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        report = JSON.parse(xhr.responseText);
        $id("title").innerText = report.title;
        $id("reason").innerText = report.reason;
        $id("context").innerText = report.name;
        $id("link").href=`./groupDetail.php?gro_id=${report.id}`
        if (report.status==1) {
          $id("yes").checked=true;
        }
        if (report.status==2) {
          $id("no").checked=true;
        }
    }
        xhr.open("post", "./php/backstage_searchgreport.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let searchData = {};
        searchData.sp_id=editId;
       
        let data_info = `search=${JSON.stringify(searchData)}`;
        console.log(data_info);
        xhr.send(data_info);
}
function updateForm(){ 
    let xhr = new XMLHttpRequest();
        xhr.open("post", "./php/backstage_updategreport.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let updateData = {};
        updateData.sp_id= $id("title").innerText;
        updateData.ans= $('input[type=radio][name=ans]:checked').val();
        let data_info = `update=${JSON.stringify(updateData)}`;
        xhr.send(data_info);
        location.href="./backstage_greport.php";
}
let report={};
  window.addEventListener('load',function () {
    let edit= document.querySelectorAll('.edit');
    for (let i = 0; i < edit.length; i++) {
      edit[i].onclick = searchForm;
    }
    $id("submit").onclick = updateForm;
   $id("cancel").onclick = cancelform;
  },false);