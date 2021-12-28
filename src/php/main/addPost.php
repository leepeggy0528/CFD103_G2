<?php
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	
	//執行sql指令並取得pdoStatement
	$sql = "INSERT INTO `post` (`post_no`, `mem_id`, `post_title`, `post_time`, `post_context`, `has_nos`, `post_times`, `post_like`, `post_type`, `post_show`) VALUES (null, :mem_id, :post_title, now(), :post_context, :has_nos, :post_times, :post_like, :post_type, :post_show)";
	$products = $pdo->prepare($sql); 
    $mem_id = 2; //must modefy
    $products->bindValue(":memId", $mem_id);
    $products->bindValue(":post_title", $_POST["title"]); 
    //post 前端送來的資料(輸入自己設定的class名稱)
    $products->bindValue(":post_context", $_POST["post_title"]);
    $products->bindValue(":has_nos", $_POST["post_title"]);
    $products->bindValue(":post_times", $_POST["post_title"]);
    $products->bindValue(":post_like", $_POST["post_title"]);
    $products->bindValue(":post_type", $_POST["post_title"]);
    $products->bindValue(":post_show", $_POST["post_title"]);
    //
    $products->execute();
    //return file name
    // echo $to;
} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>