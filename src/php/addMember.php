<?php
try{
    require_once('./connectAccount.php');
    if( $_FILES["mem_pt"]["error"]  == UPLOAD_ERR_OK){
        //決定檔案名稱
        $fileInfoArr = pathinfo($_FILES["mem_pt"]["name"]);
        $imageNo = uniqid();
        $fileName = "{$imageNo}.{$fileInfoArr["extension"]}";  //312543544.gif
        //先檢查images資料夾存不存在
        if( file_exists("../images/user") === false){
            mkdir("../images/user");
        }
        //將檔案copy到要放的路徑
        $from = $_FILES["mem_pt"]["tmp_name"];
        $to = "../images/user/$fileName";
        if(copy( $from, $to)===true){
            $sql_add_member = "insert into `member` (`mem_id`, `mem_name`, `mem_mail`, `mem_pswd`, `mem_sex`, `mem_loc`, `mem_birthday`, `mem_inter`, `mem_discribe`, `mem_pt`) values ( null, :mem_name, :mem_mail, :mem_pswd, :mem_sex, :mem_loc, :mem_birthday, :mem_inter, :mem_discribe,:mem_pt)";

            $sql_add_member_row = $pdo -> prepare($sql_add_member); 
            // $mem_id = 2; //must modefy
            $sql_add_member_row->bindValue(":mem_name", $_POST["mem_name"]); 
            
            $sql_add_member_row->bindValue(":mem_mail", $_POST["mem_mail"]);
            $sql_add_member_row->bindValue(":mem_pswd", $_POST["mem_pswd"]);
            $sql_add_member_row->bindValue(":mem_sex", $_POST["gender"]);
            $sql_add_member_row->bindValue(":mem_loc", $_POST["mem_loc"]);
            $sql_add_member_row->bindValue(":mem_birthday", $_POST["mem_birthday"]);
            $sql_add_member_row->bindValue(":mem_inter", $_POST["hobby"]);
            $sql_add_member_row->bindValue(":mem_discribe", $_POST["mem_describe"]);
            $sql_add_member_row->bindValue(":mem_pt", $fileName);
            //
            $sql_add_member_row->execute();
            echo "<script>alert('完成註冊,請登入~');history.go(-1);</script>";
        }else{
            echo "失敗~";
        }
    }else{
        echo "錯誤代碼 : ". $_FILES["mem_pt"]["error"]." <br>";
        echo "新增失敗<br>";
    }
	//執行sql指令並取得pdoStatement
	
} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>