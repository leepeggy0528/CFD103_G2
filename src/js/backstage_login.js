function $id(id){
    return document.getElementById(id);
} 
function getAdminInfo(){ //取回登入者資訊
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        admin = JSON.parse(xhr.responseText);
      if(admin.admin_name){ //已登入
        $id("user").innerText = admin.admin_name;
      }
    }
    xhr.open("get", "./php/getAdminInfo.php", true);
    xhr.send(null);
}

  function init(){
    getAdminInfo();

    $id('loginOut').onclick = function () {
        location.href="./backstage_login.html";
    };

  }; //window.onload
  let admin = {};
  window.onload=init;