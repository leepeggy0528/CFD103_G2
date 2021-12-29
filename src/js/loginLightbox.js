// let close;
// let open;
// let signUp;
// let showLogin; 
// let showSignUp;
// let returnLogin;
// let Next;
// let Last;
// let showSignUpPage2;


// function closeLogin() {
//     showLogin = document.getElementById("layerForLogin");
//     console.log(showLogin);
//     showLogin.style.display = "none";
// }

// function openLogin() {
//     showLogin = document.getElementById("layerForLogin");
//     showLogin.style.display = "block";
//     console.log(showLogin);
// }
// function singUpPage(){
//     showSignUp=document.getElementById("layerForSignUp");
//     showSignUp.style.display = "block";
//     showLogin.style.display = "none";
// }
// function returnToLogin(){
//     showLogin.style.display = "block";
//     showSignUp.style.display = "none";
// }
// function continueToStep2(){
//     Next=document.getElementById("layerForSignUpTwo"); 
//     Next.style.display = "block";
//     showSignUp.style.display = "none";
// }
// function backToStep1(){
//     showSignUp.style.display = "block";
//     Next.style.display = "none";
// }
// function init() {
//     // 操作登入頁面
//     close = document.getElementById("closeLogin");
//     open = document.getElementById("LoginBTN");
//     // 操作註冊頁面
//     signUp = document.getElementById("signUpNow");
//     returnLogin= document.getElementById("returnLogin");
//     Next= document.getElementById("nextStep");
//     Last=document.getElementById("lastStep");

//     close.onclick = closeLogin;
//     open.onclick = openLogin;
//     signUp.onclick =singUpPage;
//     returnLogin.onclick =returnToLogin;
//     Next.onclick=continueToStep2;
//     Last.onclick=backToStep1;
// }
// window.addEventListener("load", init, false);




//連上資料庫後
function $id(id){
	return document.getElementById(id);
}		
    //登入
    function showLoginForm(){
      $id('layerForLogin').style.display = 'block';
      
    }
    //登出
    function MemLogout(){
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
          $("#LoginBTN").css("display",'inline');
          $(".afterLogin").removeClass("showMem");         
          $(".smallMemInfo").removeClass("openInfo");         
        }
        xhr.open("get", "./php/mem_logout.php", true);
        xhr.send(null);
    }

    function closeLogin() {
            $id('layerForLogin').style.display = 'none';
            $id('memId').value = '';
            $id('memPsw').value = '';
        }
    function sendForm(){
      //============使用Ajax 回server端,取回登入者姓名, 放到頁面上    
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        member = JSON.parse(xhr.responseText);
        if(member.mem_mail){
          $(document).ready(function(){
            $(".afterLogin").addClass("showMem");
          $(".usernameLogin").text(`${member.mem_name}`);
          $(".diamonds").text(`${member.mem_dom}`);
          $(".coins").text(`${member.mem_money}`);
          }); 
          $id('LoginBTN').style.display='none';
          //將登入表單上的資料清空，並隱藏起來
          $id('layerForLogin').style.display = 'none';
          $id('memMail').value = '';
          $id('memPsw').value = '';
        }else{
          alert("帳密錯誤");
        }
      }
      xhr.open("post", "./php/mem_login.php", true);
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      let loginData = {};
      loginData.memMail = $id("memMail").value;
      loginData.memPsw = $id("memPsw").value;
      let data_info = `login=${JSON.stringify(loginData)}`;
      console.log(data_info);
      xhr.send(data_info);
    }

    function getMemberInfo(){ //取回登入者資訊
      let xhr = new XMLHttpRequest();
      xhr.onload = function(){
        member = JSON.parse(xhr.responseText);
        console.log(member);
         if(member.mem_id){ //已登入
          $(".afterLogin").addClass("showMem");
          document.getElementsByClassName("usernameLogin")[0].innerText=member.mem_name;
          document.getElementsByClassName("diamonds")[0].innerText=member.mem_dom;
          document.getElementsByClassName("coins")[0].innerText=member.mem_money;
          document.querySelector(".loginmempic img").src = "./images/user/"+ member.mem_pt;
          console.log("./images/user/"+ member.mem_pt);
        }
      }
      xhr.open("get", "./php/getMemberInfo.php", true);
      xhr.send(null);
    }

    function init(){
      //----------------------------------初始網頁狀態, 變數
      getMemberInfo();

      //===設定spanLogin.onclick 事件處理程序是 showLoginForm

      $id('LoginBTN').onclick = showLoginForm;
      $id('closeLogin').onclick = closeLogin;

      //===設定btnLogin.onclick 事件處理程序是 sendForm
      $id('submitLogin').onclick = sendForm;
      $id('LogoutButton').onclick = MemLogout;
      
    }; //window.onload
    let member = {};
    window.onload=init;