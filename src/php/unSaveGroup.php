<?php
try{
 require_once("./connectAccount.php");
 
 $groupId = $_POST['gro_id'];
 $mem_id = $_POST['mem_id'];

    $sql ="delete from mem_fav  where mem_id = $mem_id and gro_id = $groupId;";
    $pdo->exec($sql);
}catch(PDOException $e){
    echo "error";
}
?>