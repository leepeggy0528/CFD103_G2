<?php
try{
  require_once("./connectAccount.php");
  $groupId = $_POST['gro_id'];

  $sql = "insert into partic  (partic_id, gro_id) values(9455001,$groupId);";
  $pdo->exec($sql);
  
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

