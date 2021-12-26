function $id(id){
  return document.getElementById(id);
} 
  
//add form
function form() {
    document.getElementById('add').style.display='';
  }
function cancelform() {
    document.getElementById('add').style.display='none';
  }

//edit form
function edit_cancel() {
  document.getElementById('edit_form').style.display='none';
}

  window.addEventListener('load',function () {
    let edit= document.querySelectorAll('.edit');
    let deleted= document.querySelectorAll('.delete');
    $id("submit").onclick = sendForm;
    $id("new").onclick = form;
    $id("cancel").onclick = cancelform;
    for (let i = 0; i < edit.length; i++) {
      edit[i].onclick = searchForm;
    }
    for (let j = 0; j < deleted.length; j++) {
      deleted[j].onclick = deleteDate;
    }
    $id("edit_cancel").onclick = edit_cancel;
    $id("edit_submit").onclick = updateForm;
  },false);