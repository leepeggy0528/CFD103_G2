<?php
try{
  require_once("./connectAccount.php");
    $mem_id = $_POST['mem_id'];
    $sql = "select mem_name,mem_pt from member where mem_id = $mem_id;"; 
    

    

    $memInfo = $pdo->query($sql);
 
    $memInfoRows = $memInfo->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($memInfoRows);

 
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

