//tab name
var RatingTabList = document.querySelectorAll('.rating-tab');
console.log(tabList.length)
//tab content
var RatingTabContent = document.querySelectorAll(".change-rates");

function currentStatus(t){
	t.preventDefault();
   
    for (var e = 0; e < RatingTabList.length; e++) {
        RatingTabList[e].className = "rating-tab", 
        RatingTabContent[e].className = "change-rates";
      }
    
      var a = t.target.getAttribute("href"),
          a = document.querySelector(a);
          a.className = "change-rates open";

    let ratings= document.getElementsByClassName('Ratings');

	for(let i=0;i<ratings.length;i++){
        ratings[i].classList.remove("active");
    }
    t.target.classList.add("active");
}

for(let i=0;i<RatingTabList.length;i++){
	RatingTabList[i].addEventListener("click",currentStatus);	
}