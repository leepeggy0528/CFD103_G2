<?php
try{
  require_once("./connectAccount.php");
  $groupId = $_POST['gro_id'];
  $mem_id = $_POST['mem_id'];

  $sql = "insert into partic  (partic_id, gro_id) values($mem_id,$groupId);";
  $pdo->exec($sql);
  
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

