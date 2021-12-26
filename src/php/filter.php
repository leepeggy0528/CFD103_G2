<?php
try{
 require_once("./connectAccount.php");
 
    $sql ="select * from igroup where gro_type like '美食';";
    $pdo->exec($sql);

}catch(PDOException $e){
    echo "error";
}
?>