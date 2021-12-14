let close;
let open;
let signUp;
let showLogin; 
let showSignUp;
let returnLogin;
let Next;
let Last;
let showSignUpPage2;


function closeLogin() {
    showLogin = document.getElementById("layerForLogin");
    console.log(showLogin);
    showLogin.style.display = "none";
}

function openLogin() {
    showLogin = document.getElementById("layerForLogin");
    showLogin.style.display = "block";
    console.log(showLogin);
}
function singUpPage(){
    showSignUp=document.getElementById("layerForSignUp");
    showSignUp.style.display = "block";
    showLogin.style.display = "none";
}
function returnToLogin(){
    showLogin.style.display = "block";
    showSignUp.style.display = "none";
}
function continueToStep2(){
    Next=document.getElementById("layerForSignUpTwo"); 
    Next.style.display = "block";
    showSignUp.style.display = "none";
}
function backToStep1(){
    showSignUp.style.display = "block";
    Next.style.display = "none";
}
function init() {
    // 操作登入頁面
    close = document.getElementById("closeLogin");
    open = document.getElementById("LoginButton");
    // 操作註冊頁面
    signUp = document.getElementById("signUpNow");
    returnLogin= document.getElementById("returnLogin");
    Next= document.getElementById("nextStep");
    Last=document.getElementById("lastStep");

    close.onclick = closeLogin;
    open.onclick = openLogin;
    signUp.onclick =singUpPage;
    returnLogin.onclick =returnToLogin;
    Next.onclick=continueToStep2;
    Last.onclick=backToStep1;
}
window.addEventListener("load", init, false);