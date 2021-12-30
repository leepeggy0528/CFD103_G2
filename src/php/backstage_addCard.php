<?php
try{
  require_once("./connectAccount.php");

  $cardName = $_POST['cd-name'];
  $status =$_POST['type'];


  switch($_FILES["upFile"]["error"]){
    case UPLOAD_ERR_OK : 
      //檔名
      $fileInfo = pathinfo($_FILES["upFile"]["name"]);
      $rndNo = uniqid();
      $fileName = "{$rndNo}.{$fileInfo["extension"]}";  

      //檢查資料夾是否存在
      $dir = "../images/card";
      if(file_exists($dir) == false){
        mkdir($dir); //make directory
      }
      $from = $_FILES["upFile"]["tmp_name"]; //含路徑名稱
      $to = "$dir/".$fileName;//指定路徑名稱
      if(copy($from, $to)==true){
       
       $sql = "insert into card_style values(null,'$cardName','$fileName',$status);;";
       $pdo->exec($sql);

        echo "上傳成功~";
      }else{
        echo "上傳失敗~";
      }	
      break;

    case UPLOAD_ERR_INI_SIZE :
      echo "檔案太大, 不得超過" . ini_get("upload_max_filesize") . "<br>";
      break;
    case UPLOAD_ERR_FORM_SIZE :
      echo "檔案太大, 不得超過" . $_POST["MAX_FILE_SIZE"] . "<br>";
      break;
    case UPLOAD_ERR_PARTIAL :
      echo "檔案上傳不完整,請重送檔案<br>";
      break;
    case UPLOAD_ERR_NO_FILE : 
      echo "檔案未選喔~<br>" ;  
  }
 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

