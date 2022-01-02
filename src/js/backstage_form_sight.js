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
    let editId=edit.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
    $id('edit_form').style.display='';
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        sight = JSON.parse(xhr.responseText);
        $id("edit-id").value = sight.sig_id;
        $id("edit-name").value = sight.sig_name;
        $id("edit-loc").value = sight.sig_loc;
        $id("edit-address").value = sight.sig_address;
        $id("edit-type").value = sight.sig_type;
        if(sight.sig_tel){
          $id("edit-tel").value = sight.sig_tel;
        }else{
          $id("edit-tel").placeholder= "暫無資料";
        }
        if(sight.sig_web){
          $id("edit-web").value = sight.sig_web;
        }else{
          $id("edit-web").placeholder = "暫無資料";
          
        }
        $id("edit-time").value = sight.sig_time;
        $id("edit-intro").value = sight.sig_intro;
        $id("edit-desc").value = sight.sig_desc;
    }
        xhr.open("post", "./php/backstage_searchsight.php", true);
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        //將要送到後端的資料打包
        let searchData = {};
        searchData.sp_id=editId;
       
        let data_info = `search=${JSON.stringify(searchData)}`;
        xhr.send(data_info);
}
function updateForm(){ 
    let xhr = new XMLHttpRequest();
        xhr.open("post", "./php/backstage_updatesight.php", true);
        let myForm1 = new FormData($id("sight_edit"));
        console.log($id("sight_edit"));
        xhr.send(myForm1);
        var button1 = $(this);
        var currentSection1 = button1.parents(".section");
        currentSection1.removeClass("active");
        $(document).find(".sight_edit .section").first().addClass("active");
        $id("edit_form").style.display='none';
        history.go(0);
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
      search[i].onclick=searchForm;
      
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
    $id("edit_submit").onclick = updateForm;
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
    $(".edit_cancel").click(function() {
        var button1 = $(this);
        var currentSection1 = button1.parents(".section");
        currentSection1.removeClass("active");
        $(document).find(".sight_edit .section").first().addClass("active");
        $id("edit_form").style.display='none';
    });
    });
