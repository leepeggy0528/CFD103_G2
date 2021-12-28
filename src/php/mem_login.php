<?php
ob_start();
session_start();
try{
  require_once("./connectAccount.php");
  $sql = "select * from member where mem_mail=:memMail and mem_pswd=:memPsw"; 
  $member = $pdo->prepare($sql);
  $member->bindValue(":memMail", $_POST["mem_mail"]);
  $member->bindValue(":memPsw", $_POST["mem_pswd"]);
  $member->execute();
  if( $member->rowCount()==0){ //查無此人
	  echo "{}";

     }else{ //登入成功
    //自資料庫中取回資料
    $memRow = $member->fetch(PDO::FETCH_ASSOC);
    //寫入SESSION
    
    $_SESSION["memId"] = $memRow["mem_id"]; 
    $_SESSION["memName"] = $memRow["mem_name"]; 
    $_SESSION["memMail"] = $memRow["mem_mail"]; 
    $_SESSION["memSex"] = $memRow["mem_sex"];
    $_SESSION["memLoc"] = $memRow["mem_loc"];
    $_SESSION["memDom"] = $memRow["mem_dom"];
    $_SESSION["memMoney"] = $memRow["mem_money"];
    $_SESSION["jmemScore"] = $memRow["jmem_score"];
    $_SESSION["hmemScore"] = $memRow["hmem_score"];
    $_SESSION["hmemPeople"] = $memRow["hmem_people"];
    $_SESSION["memBirthday"] = $memRow["mem_birthday"];
    $_SESSION["memInter"] = $memRow["mem_inter"];
    $_SESSION["memDiscribe"] = $memRow["mem_discribe"];
    $_SESSION["memPt"] = $memRow["mem_pt"]; 
       
    //送出登入者的姓名資料
    // echo $memRow["memName"];
     $member = ["mem_id"=>$_SESSION["memId"], "mem_name"=>$_SESSION["memName"], "mem_mail"=>$_SESSION["memMail"], "mem_sex"=>$_SESSION["memSex"],"mem_loc"=>$_SESSION["memLoc"],"mem_dom"=>$_SESSION["memDom"],"mem_money"=>$_SESSION["memMoney"],"jmem_score"=>$_SESSION["jmemScore"],"hmem_score"=>$_SESSION["hmemScore"],"hmem_people"=>$_SESSION["hmemPeople"],"mem_birthday"=>$_SESSION["memBirthday"],"mem_inter"=>$_SESSION["memInter"],"mem_discribe"=>$_SESSION["memDiscribe"],"mem_pt"=>$_SESSION["memPt"]];
    echo json_encode($member);


  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
