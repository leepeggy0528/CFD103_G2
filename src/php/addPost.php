<?php
	//引入連線工作的檔案
	require_once("./connectAccount.php");
	//.......確定是否上傳成功
    echo  $_POST["post_title"];
    echo  $_POST["post_context"];
    echo  $_POST["post_type"];
    
    $sql = "INSERT INTO `post` VALUES (null,:mem_id,:post_title, now(),:post_context,:has_nos,:post_times,:post_like,:post_type,:post_show);";
    
	
     //must modefy
    $post_times = 0;
    $post_like = 0;
    $post_show = 1;
    $products = $pdo->prepare($sql); 
    $products->bindValue(":mem_id", $_POST["memid"]);
    $products->bindValue(":post_title",$_POST["post_title"]); 
    //post 前端送來的資料(輸入自己設定的class名稱)
    $products->bindValue(":post_context", $_POST["post_context"]);
    $products->bindValue(":has_nos", NULL);
    $products->bindValue(":post_times", $post_times);
    $products->bindValue(":post_like", $post_like);
    $products->bindValue(":post_type", $_POST["post_type"]);
    $products->bindValue(":post_show", $post_show);
    
    $products->execute();
    $post_no = $pdo->lastInsertId();

if( $_FILES["image"]["error"] == UPLOAD_ERR_OK){

    //決定檔案名稱
	$fileInfoArr = pathinfo($_FILES["image"]["name"]);
	$imageNo = uniqid();
	$fileName = "{$imageNo}.{$fileInfoArr["extension"]}";  //312543544.gif

    //先檢查discussion資料夾存不存在
    if( file_exists("../images/discussion") === false){
        mkdir("../images/discussion");
    }
    //將檔案copy到要放的路徑
	$from = $_FILES["image"]["tmp_name"];
	$to = "../images/discussion/$fileName";
        
	//執行sql指令並取得pdoStatement
	if(copy( $from, $to)===true){
        $sql ="INSERT INTO `post_pt`(`ppt_no`,`post_no`,`ppt_pt`)VALUES(null,:post_no,:ppt_pt);";
        $products = $pdo->prepare($sql);
        
        $products->bindValue(":ppt_pt", $fileName);
        $products->bindValue(":post_no", $post_no);
        //
        $products->execute();
        //return file name
        // echo $to;
    }else{
        echo "失敗~";
    }
}else{
    echo "錯誤代碼 : {$_FILES["image"]["error"]} <br>";
    echo "新增失敗<br>";
}
?>