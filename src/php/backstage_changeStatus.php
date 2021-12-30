<?php

try{
  require_once("./connectAccount.php");
  $no=$_POST['no'];
  $status=$_POST['cardStatus'];

  $sql = "update card_style set cstyle_status=$status where $no;"; 
  $pdo->exec($sql);

}catch(PDOException $e){
  echo $e->getMessage();
}
?>

