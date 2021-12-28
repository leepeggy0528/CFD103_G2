function viewpt(e) {
  let view=e.target;
  let viewId=view.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
  console.log(viewId);
  $id('view').style.display='';
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
    sight = JSON.parse(xhr.responseText);
    if (sight.sp_pt.length==0) {
      alert("查無照片!!");
      $id('view').style.display='none';
    }else{
      let container = $id("container-c");
      for (let i = 0; i < sight.sp_pt.length; i++) {
        let card = document.getElementsByClassName("card_demo")[0];
        let newpt = card.cloneNode(true);
        newpt.style.display = "";
        let img=newpt.querySelector("img")
        img.src = `./images/sight/${sight.sp_pt[i]}`;
        console.log(img.src);
        newpt.setAttribute("class","ui-card");
        container.insertBefore(newpt,null);
      
      }  
      $('.ui-card:nth-child(2)').addClass('active');
      $('.ui-card:nth-child(2)').prev().addClass('prev');
      $('.ui-card:nth-child(2)').next().addClass('next');
  
      $('.ui-card').click(function() {
        console.log($('.active').width())
        if ($(this).hasClass('next')) {
          $('#container-c').stop(false, true).animate({left: '-=' + 720 +'px'});
        } else if ($(this).hasClass('prev')) {
          $('#container-c').stop(false, true).animate({left: '+=' + 720 +'px'});
        }

        $(this).removeClass('prev next');
        $(this).siblings().removeClass('prev active next');
        
        $(this).addClass('active');
        $(this).prev().addClass('prev');
        $(this).next().addClass('next');
      });
    }
    

/*       // Keyboard nav
      $('html body').keydown(function(e) {
      if (e.keyCode == 37) { // left
        $('.active').prev().trigger('click');
      }
      else if (e.keyCode == 39) { // right
        $('.active').next().trigger('click');
      }
      }); */
  }
      xhr.open("post", "./php/backstage_searchsightpt.php", true);
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      //將要送到後端的資料打包
      let viewPhoto = {};
      viewPhoto.sp_id=viewId;
     
      let data_info = `search=${JSON.stringify(viewPhoto)}`;
      console.log(data_info);
      xhr.send(data_info);
 
}
function cancelpt() {
  $id('view').style.display='none';
  $id("container-c").style.left=0;
  while ($id("container-c").hasChildNodes()) {  
    $id("container-c").removeChild($id("container-c").firstChild);
  }
}
let sight={};
window.addEventListener('load',function () {
  let view = document.querySelectorAll('.view');
  let cancel= document.getElementById('view');
  for (let i = 0; i < view.length; i++) {
    view[i].onclick = viewpt;
  }
  fork.onclick = cancelpt;
},false);


