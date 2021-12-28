<?php
try{
  require_once("../connectAccount.php");
  $sql = "select g.gro_name, s.sche_date, s.sche_starttime, m.mem_name, s.sche_name, g.gro_loc, g.gro_type 
  from igroup g JOIN schedule s ON g.gro_id = s.gro_id JOIN member m ON g.mem_id = m.mem_id;"; 

  if( $member->rowCount()==0){ //查無此人
	  echo "exist";
  }else{ //登入成功 
    //自資料庫中取回資料


    //送出登入者的姓名資料
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

