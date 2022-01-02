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
        $id("context").innerText = report.context;
        if (report.status==1) {
          $id("yes").checked=true;
        }
        if (report.status==2) {
          $id("no").checked=true;
        }
    }
        xhr.open("post", "./php/backstage_searchpreport.php", true);
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
    let tr = document.querySelectorAll("table tbody tr");
        xhr.open("post", "./php/backstage_updatepreport.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let updateData = {};
        updateData.sp_id= $id("title").innerText;
        updateData.ans= $('input[type=radio][name=ans]:checked').val();
        updateData.context= $id("context").innerText;
        for (let i = 0; i < tr.length; i++) {
          //let data = tr[i].data-status;
          if(tr[i].children[0].innerText==updateData.sp_id){
            switch (updateData.ans) {
              case "2":
                tr[i].setAttribute('data-status', 'unsuccess');
                tr[i].children[4].innerText="不通過";
                break;
              case "1":
                tr[i].setAttribute('data-status', 'success');
                tr[i].children[4].innerText="通過";
                break;
              default:
                break;
            }
            $id('edit_form').style.display='none';
          }
          
        }
        let data_info = `update=${JSON.stringify(updateData)}`;
        xhr.send(data_info);
        location.href="./backstage_preport.php";
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