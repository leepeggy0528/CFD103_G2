<?php
try{
 require_once("./connectAccount.php");
 
    $groupId = $_POST['gro_id'];
    // $groupId = 9487003;
    $sql ="insert into mem_fav (mem_id,gro_id) values(9455005,$groupId);";
    $pdo->exec($sql);
}catch(PDOException $e){
    echo "error";
}
?>