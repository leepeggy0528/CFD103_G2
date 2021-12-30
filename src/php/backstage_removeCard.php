<?php
try{
  require_once("./connectAccount.php");
    $cardNo = $_POST['cardNo'];
    $sql = "delete  from card_style where cstyle_no=$cardNo";
    $pdo->exec($sql);


 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

