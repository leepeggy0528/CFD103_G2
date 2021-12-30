<?php
try{
  require_once("./connectAccount.php");

    $groupId = $_POST['gro_id'];
    $status = $_POST['status'];
    $content = $_POST['content'];
    $gro_show = $_POST['gro_show'];


    $sql="insert into gro_report(gro_id,greport_reason) value($groupId,$content)";
    $pdo->exec($sql);
 

    $sql_status="update igroup set gro_show = $gro_show where gro_id=$groupId";
    $pdo->exec($sql_status);
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

