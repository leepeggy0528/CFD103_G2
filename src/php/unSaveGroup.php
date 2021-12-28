<?php
try{
 require_once("./connectAccount.php");
 
    $groupId = $_POST['gro_id'];
    // $groupId = 9487003;
    $sql ="insert into mem_fav (mem_id,gro_id) values(9455005,$groupId);";
    $sql ="delete from mem_fav  where mem_id = 9455005 and $groupId;";
    $pdo->exec($sql);
}catch(PDOException $e){
    echo "error";
}
?>