//選擇所需的元件
const dropArea=document.querySelector(".drag-area");
const button=document.querySelector(".icon");
const input=document.querySelector(".profile-upload");
let file;//全域變數

button.onclick=()=>{
    input.click(); //按到button等同按到input
}

input.addEventListener("change",function(){
    file=this.files[0]
    //抓到使用者的檔案，[0]是若使用者選取大量的圖片，我們只挑第一個
    showFile();
    dropArea.classList.add("active");
});

//當檔案被移到指定區塊(dropArea)
dropArea.addEventListener("dragover",(e)=>{
    e.preventDefault();//避免預設讓圖片直接呈現完整頁面
    // console.log("File is over DragArea");
    dropArea.classList.add("active");
});

//當檔案進入後又離開指定區塊(dropArea)
dropArea.addEventListener("dragleave",()=>{
    // console.log("File is outside of DragArea");
    dropArea.classList.remove("active");
});

//當檔案被放進指定區塊(dropArea)
dropArea.addEventListener("drop",(e)=>{
    e.preventDefault(); //避免預設讓圖片直接呈現完整頁面
    // console.log("File is dropped on DragArea");
    file=e.dataTransfer.files[0];
    showFile();//呼叫函數
});
    //抓到使用者的檔案，[0]是若使用者選取大量的圖片，我們只挑第一個
    // console.log(file);
   function showFile(){
       let fileType=file.type;
       // console.log(fileType);
       //可以觀看使用者丟上來的檔案是什麼類型的檔案
       
       let validExtensions=["image/jpeg","image/jpg","image/png",]//規範使用者上傳檔案類型
       
       if(validExtensions.includes(fileType)){
           console.log("this is an image file");
           let fileReader=new FileReader();
           fileReader.onload=()=>{
               let fileURL= fileReader.result;
               console.log(fileURL);
               let imgTag=`<img src="${fileURL}" alt="">`;
               dropArea.innerHTML= imgTag;
           }
           fileReader.readAsDataURL(file);
           //可看到檔案路徑
       }else{
           alert("this is not an image file");
           //將外框線回復
           dropArea.classList.remove("active");
       }
   }