<?php 
ob_start();
session_start();
if( isset($_SESSION["mem_mail"])){//已登入
    $member = ["mem_id"=>$_SESSION["memId"], "mem_name"=>$_SESSION["memName"], "mem_mail"=>$_SESSION["memMail"], "mem_sex"=>$_SESSION["memSex"],"mem_loc"=>$_SESSION["memLoc"],"mem_dom"=>$_SESSION["memDom"],"mem_money"=>$_SESSION["memMoney"],"jmem_score"=>$_SESSION["jmemScore"],"hmem_score"=>$_SESSION["hmemScore"],"hmem_people"=>$_SESSION["hmemPeople"],"mem_birthday"=>$_SESSION["memBirthday"],"mem_inter"=>$_SESSION["memInter"],"mem_discribe"=>$_SESSION["memDiscribe"],"mem_pt"=>$_SESSION["memPt"]];
    echo json_encode($result);	
}else{ //尚未登入
	echo "{}";
}	
 ?>