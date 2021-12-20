//tab name
var tabList = document.querySelectorAll('.tabs-for-a');
console.log(tabList.length)
//tab content
var tabContent = document.querySelectorAll(".self-info");
console.log(tabContent);
function currentStatus(e){
	e.preventDefault();
	console.log(e.target.className)
	for(var a=0;a<tabList.length;a++){		
		tabList[a].className = "tabs-for-a";
		tabContent[a].className = "self-info fade";
	}
	var tabListId = e.target.getAttribute("href");
	var tabContentStatus = document.querySelector(tabListId)
	tabContentStatus.className = "self-info fade open";	
		e.target.className = "tabs-for-a active";
}
for(var i=0;i<tabList.length;i++){
	tabList[i].addEventListener("click",currentStatus);	
}

//評價
let Off;
let HostOff;
let startRating;
let showRating;
let showHost;
let count;
let input;
let ratingHost;


function closeRating() {
    showRating = document.getElementById("layerRatingContainer");
    showRating.style.display = "none";
}
function closeHost(){
	showHost=document.getElementById("layerRatingHost");
	showHost.style.display = "none";
}
function ratingParts(){
	showRating = document.getElementById("layerRatingContainer");
	showRating.style.display = "block";
}
function rateHost(){
	showHost=document.getElementById("layerRatingHost");
	showHost.style.display = "block";
}
//計算字數
function cal_words(){
	var length = document.getElementById("giveFeedBack").value.length;
	document.getElementById("count").innerText = length;
	console.log(length);
	}
function init() {
	Off=document.getElementById("closeRating");
	HostOff=document.getElementById("close-host");
	startRating=document.getElementById("ratingParts");
	count = document.getElementById('count');
	ratingHost=document.getElementById("rateHost")
	input = document.querySelectorAll('.giveFeedBack');
	
	Off.onclick = closeRating;
    HostOff.onclick = closeHost;
    startRating.onclick = ratingParts;
	ratingHost.onclick=rateHost;
}
window.addEventListener("load", init, false);