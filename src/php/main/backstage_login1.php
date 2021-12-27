<?php
  setcookie("admin_name","");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理員登入</title>
<link rel="stylesheet" href="./css/login copy.css">
</head>

<body>
        <div class="login-form">
            <h1>管理員登入</h1>
            <form><!--  action="backstage_login.php" method="post" -->
              <div class="group">
                  <label class="shrink" for="id" >帳號</label>
                <input class="input" type="text" required="required" id="id">
              </div>
              <div class="group">
                  <label class="shrink" for="pswd">密碼</label>
                <input class="input" type="password" required="required" id="pswd">
              </div>
                <div class="btn-box">
                  <button id="back" class="btnBoredBlue cancel-btn" type="button">回上一頁</button>
                    <button class="btnYellow loggin-btn" id="submit" type="button">登入</button>
                </div>
            </form>
        </div>
<script>
    function $id(id){
        return document.getElementById(id);
    } 

    function login(){
      //============使用Ajax 回server端,取回登入者姓名, 放到頁面上    
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        admin = JSON.parse(xhr.responseText);
        if(admin.admin_id){          
          location.href="./backstage_admin.php";
        }else{
          alert("帳密錯誤");
        }
      }
      xhr.open("post", "./php/backstage_login.php", true);
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      //將要送到後端的資料打包
      let loginData = {};
      loginData.admin_id = $id("id").value;
      loginData.admin_pswd = $id("pswd").value;

      let data_info = `login=${JSON.stringify(loginData)}`;

      xhr.send(data_info);
    }

    function prepage(){
      location.href="./demo.html";
    }


    function init(){
      //getMemberInfo();

      $id('submit').onclick = login;

      $id('back').onclick = prepage;

    }; //window.onload
    window.onload=init;
</script>
</body>
</html>
