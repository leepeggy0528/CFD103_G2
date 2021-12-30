<?php
try {
	//執行sql指令並取得pdoStatement
	$sql_add_member = "INSERT INTO `member` (`mem_id`, `mem_name`, `mem_mail`, `mem_pswd`, `mem_sex`, `mem_loc`, `mem_birthday`, `mem_inter`, `mem_discribe`, `mem_pt`) VALUES (null, :memId, :mem_name, :mem_mail, :mem_pswd, :mem_sex, :mem_loc, :mem_birthday, :mem_inter, :mem_discribe,:mem_pt)";
	$sql_add_member_row = $pdo->prepare($sql_add_member); 
    // $mem_id = 2; //must modefy
    $sql_add_member_row->bindValue(":memId", $mem_id);
    $sql_add_member_row->bindValue(":mem_name", $_POST["mem_name"]); 
    //post 前端送來的資料(輸入自己設定的class名稱)
    
    $sql_add_member_row->bindValue(":mem_mail", $_POST["mem_mail"]);
    $sql_add_member_row->bindValue(":mem_pswd", $_POST["mem_pswd"]);
    $sql_add_member_row->bindValue(":mem_sex", $_POST["mem_sex"]);
    $sql_add_member_row->bindValue(":mem_loc", $_POST["mem_loc"]);
    $sql_add_member_row->bindValue(":mem_birthday", $_POST["mem_birthday"]);
    $sql_add_member_row->bindValue(":mem_inter", $_POST["hobby"]);
    $sql_add_member_row->bindValue(":mem_discribe", $_POST["mem_describe"]);
    $sql_add_member_row->bindValue(":mem_pt", $_POST["mem_pt"]);
    //
    $sql_add_member_row->execute();
} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>