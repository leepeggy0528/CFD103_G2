<?php
try{
  require_once("./connectAccount.php");
  $gro_id = $_POST['gro_id'];
  $mem_id = $_POST['mem_id'];
  $gmes_context = $_POST['comment'];


    $sql = "insert into gro_mes(gro_id, mem_id, gmes_context)
            values($gro_id,$mem_id,'$gmes_context');";
    
    $pdo->exec($sql);
   
 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

