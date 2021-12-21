var tabList = document.querySelectorAll(".aboutMe");
console.log(tabList.length);
var tabContent = document.querySelectorAll(".change-forms");
var blackList = document.getElementById('blackList');
var addFriend = document.getElementById('addFriend');
var FriendIcon= document.getElementsByClassName('fas fa-user-plus')[0];
var blackIcon= document.getElementsByClassName('fas fa-ban')[0];
//改變內容
function currentStatus(t) {
  t.preventDefault(), 
  console.log(t.target.className);

  for (var e = 0; e < tabList.length; e++) {
    tabList[e].className = "aboutMe", 
	tabContent[e].className = "change-forms fade";
  }

  var a = t.target.getAttribute("href"),
      a = document.querySelector(a);
    a.className = "change-forms fade open",
   t.target.className = "aboutMe active", console.log(a);
}
//加入黑名單
blackList.onclick=addToBlackList;
function addToBlackList(){
  if(blackIcon.innerText=="加黑名單"){
    blackIcon.innerText = "解除黑名單";
  }else{
    blackIcon.innerText = "加黑名單";
  };
}
//加入好友
addFriend.onclick=addToFriendList;
function addToFriendList(){
  if(FriendIcon.innerText=="加好友"){
    FriendIcon.innerText = "解除好友";
  }else{
    FriendIcon.innerText = "加好友";
  };
}

for (var i = 0; i < tabList.length; i++) {
  tabList[i].addEventListener("click", currentStatus);
}