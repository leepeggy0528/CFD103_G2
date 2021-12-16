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