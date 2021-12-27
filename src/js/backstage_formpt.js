function form() {
    document.getElementById('add').style.display='';
}

function cancelform() {
    document.getElementById('add').style.display='none';
    document.getElementById("preview").hidden=true;
  }
function form1() {
    document.getElementById('sadd').style.display='';
}

function cancelform1() {
    document.getElementById('sadd').style.display='none';
    document.getElementById("preview1").hidden=true;
  }

window.addEventListener("load", function(){
    document.getElementById("upFile").onchange = function(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onload = function(){
                document.getElementById("preview").hidden=false;
                document.getElementById("preview").src = reader.result;
            }
            reader.readAsDataURL(file);
    }
    document.getElementById("upFile1").onchange = function(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onload = function(){
                document.getElementById("preview1").hidden=false;
                document.getElementById("preview1").src = reader.result;
            }
            reader.readAsDataURL(file);
    }
    let add = document.getElementById('new');
    let cancel= document.getElementById('cancel');
    let add1 = document.getElementById('new1');
    let cancel1= document.getElementById('cancel1');
    add.onclick = form;
    cancel.onclick = cancelform;
    add1.onclick = form1;
    cancel1.onclick = cancelform1;
},false);