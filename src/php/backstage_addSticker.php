<?php
try{
  require_once("./connectAccount.php");
  print_r($_POST);
  echo '<hr>';
  echo $_POST['stickerName'];


 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

