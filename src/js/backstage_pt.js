
  $('.ui-card:nth-child(2)').addClass('active');
  $('.ui-card:nth-child(1)').prev().addClass('prev');
  $('.ui-card:nth-child(3)').next().addClass('next');

$('.ui-card').click(function() {
  console.log($('.active').position().left);
  

  if ($(this).hasClass('next')) {
    $('.container-c').stop(false, true).animate({left: '-=' + $('.active').width()});
    console.log('-=' + $('.active').width())
  } else if ($(this).hasClass('prev')) {
    $('.container-c').stop(false, true).animate({left: '+=' + $('.active').width()});
  }
  
  $(this).removeClass('prev next');
  $(this).siblings().removeClass('prev active next');
  
  $(this).addClass('active');
  $(this).prev().addClass('prev');
  $(this).next().addClass('next');
});


// Keyboard nav
$('html body').keydown(function(e) {
  if (e.keyCode == 37) { // left
    $('.active').prev().trigger('click');
  }
  else if (e.keyCode == 39) { // right
    $('.active').next().trigger('click');
  }
});

function viewpt() {
  document.getElementById('view').style.display='';
}
function cancelpt() {
  document.getElementById('view').style.display='none';
}
window.addEventListener('load',function () {
  let view = document.querySelectorAll('.view');
  let cancel= document.getElementById('view');
  for (let i = 0; i < view.length; i++) {
    view[i].onclick = viewpt;
  }
  fork.onclick = cancelpt;
},false);