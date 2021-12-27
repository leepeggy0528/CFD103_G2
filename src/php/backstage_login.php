<?php
$json = $_POST["login"];
$loginData = json_decode($json, true); //associative array

try{
  require_once("./connectAccount.php");
  $sql = "select * from admin where admin_id=:admin_id and admin_pswd=:admin_pswd"; 
  $login = $pdo->prepare($sql);
  $login->bindValue(":admin_id", $loginData["admin_id"]);
  //$login->bindValue(":admin_id", "Sara");
  $login->bindValue(":admin_pswd", $loginData["admin_pswd"]);
  //$login->bindValue(":admin_pswd", "111");
  $login->execute();
  if( $login->rowCount()==0){ //查無此人
	  echo "{}";
  }else{ //登入成功
    //自資料庫中取回資料
    $loginRow = $login->fetch(PDO::FETCH_ASSOC);
    setcookie('admin_name',$loginRow["admin_name"]);

    //送出登入者的姓名資料
    // echo $loginRow["memName"];
    $result = ["admin_id"=>$loginRow["admin_id"]];
    echo json_encode($result);
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

