function form() {
    document.getElementById('add').style.display='';
  }
function cancelform() {
    document.getElementById('add').style.display='none';
  }

  window.addEventListener('load',function () {
    let add = document.getElementById('new');
    let cancel= document.getElementById('cancel');
    add.onclick = form;
    cancel.onclick = cancelform;
  },false);