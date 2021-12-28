<?php
try{
  require_once("./connectAccount.php");
    $stickerNo = $_POST['stickerNo'];
    $sql = "delete  from stamp_style where sstyle_no=$stickerNo";
    $pdo->exec($sql);


 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

