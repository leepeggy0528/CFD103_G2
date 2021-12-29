function form() {
    document.getElementById('add').style.display='';
  }

  function addpt() {
    let submit_btn = $id("sight_btn");
    let photo = document.getElementsByClassName("photo")[0];
    let newpt = photo.cloneNode(true);
    newpt.style.display = "";
/*     let showpt = newpt.querySelector(".pt img")
    console.log(showpt); */
    newpt.getElementsByTagName("i")[0].onclick = removept;
    /* showpt.onchange = function(e){
      let file = e.target.files[0];
      let reader = new FileReader();
      reader.onload = function(){
          document.getElementById("preview").hidden=false;
          document.getElementById("preview").src = reader.result;
      }
      reader.readAsDataURL(file);
    } */
    submit_btn.insertBefore(newpt,null);
  }
  
  function removept(e) {
    let trash = e.target;
    $id("sight_btn").removeChild(trash.parentNode);
  }
  function edit_cancel() {
    document.getElementById('edit_form').style.display='none';
  }
  function addsight(){ 
    let tbody = document.querySelector("table tbody");
    let tr = document.createElement("tr");
    tbody.appendChild(tr);
    let td1 = document.createElement("td");
    tr.appendChild(td1);
    let textNode1 = document.createTextNode($id("sig_no").value);
    td1.appendChild(textNode1); 
    let td2 = document.createElement("td");
    tr.appendChild(td2);
    let textNode2 = document.createTextNode($id("add_name").value);
    td2.appendChild(textNode2); 
    let td3 = document.createElement("td");
    tr.appendChild(td3);
    let textNode3 = document.createTextNode($id("loc").value+$id("add_address").value);
    td3.appendChild(textNode3);

    let sight_icon = document.querySelector(".sight_icon");
    console.log(sight_icon.children[0])
    let newpt1 = sight_icon.children[0].cloneNode(true);
    let newpt2 = sight_icon.children[1].cloneNode(true);
    tr.insertBefore(newpt1,null);
    tr.insertBefore(newpt2,null);
    let xhr = new XMLHttpRequest();
    xhr.open("post", "./php/backstage_addsight.php", true);
    let myForm = new FormData($id("sight"));
    xhr.send(myForm);
    $id('add').style.display='none';
}
function searchForm(e){ 
    let edit=e.target;
    let editId=edit.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
    $id('edit_form').style.display='';
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        sight = JSON.parse(xhr.responseText);
        $id("edit-id").value = search.sp_id;
        $id("edit-name").value = search.sp_name;
        $id("edit-pswd").value = search.sp_pswd;
    }
        xhr.open("post", "./php/backstage_searchadmin.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let searchData = {};
        searchData.sp_id=editId;
       
        let data_info = `search=${JSON.stringify(searchData)}`;
        console.log(data_info);
        xhr.send(data_info);
}
function updateForm(){ 
    $id('edit_form').style.display='';
    let xhr = new XMLHttpRequest();
        xhr.open("post", "./php/backstage_updataad min.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let updateData = {};
        updateData.sp_id= $id("edit-id").value;
        updateData.sp_pswd= $id("edit-pswd").value;
        updateData.sp_name= $id("edit-name").value;

        let data_info = `update=${JSON.stringify(updateData)}`;
        console.log(data_info);
        xhr.send(data_info);
        location.href="./backstage_admin.php";
}
function deleteDate(e){ 
    let deleted=e.target;
    let deletedId=deleted.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
    console.log(deletedId);
    let xhr = new XMLHttpRequest();
        xhr.open("post", "./php/backstage_deletesight.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let deleteData = {};
        deleteData.sp_id=deletedId;
       
        let data_info = `delete=${JSON.stringify(deleteData)}`;
        console.log(data_info);
        xhr.send(data_info);
        location.href="./backstage_sight.php";
}
let sight={};
  window.addEventListener('load',function () {
    let search = document.querySelectorAll(".edit");
    for (let i = 0; i < search.length; i++) {
      search.onclick=searchForm;
      
    }
    let edit= document.querySelectorAll('.edit');
    let deleted= document.querySelectorAll('.delete');
    for (let i = 0; i < edit.length; i++) {
      edit[i].onclick = searchForm;
    }
    for (let j = 0; j < deleted.length; j++) {
      deleted[j].onclick = deleteDate;
    }
    $id("new").onclick = form;
    $id("btnAddPt").onclick = addpt;
    $id("submit").onclick = addsight;
    //$id("edit_cancel").onclick = edit_cancel;
    //$id("edit_submit").onclick = updateForm;
  },false);

  $(document).ready(function(){
    $(".signup .next").click(function(){
        var button = $(this);
        var currentSection = button.parents(".section");
        var currentSectionIndex = currentSection.index();
        currentSection.removeClass("active").next().addClass("active");

        $(".signup").submit(function(e) {
        e.preventDefault();
        }); 

        if(currentSectionIndex === 3){
        $(document).find(".signup .section").first().addClass("active");
        }
    });
    $(".cancel1").click(function() {
        var button = $(this);
        var currentSection = button.parents(".section");
        currentSection.removeClass("active");
        $(document).find(".signup .section").first().addClass("active");
        document.getElementById('add').style.display='none';
    });
    });
