<?php
ob_start();
session_start();
$errMsg="";
try {
	//引入連線工作的檔案
	require_once("./connectAccount.php");
	//.......確定是否上傳成功
    $sql = "INSERT INTO `post_mes`(`pmes_no`, `post_no`, `mem_id`, `pmes_time`, `pmes_context`) VALUES (null,:post_no,:mem_id,now(),:pmes_context);";

    $post_no = $_POST["pno"];
    $products = $pdo->prepare($sql);
    $products->bindValue(":post_no", $post_no);
    $products->bindValue(":mem_id", $mem_id);
    $products->bindValue(":mem_id", $_POST["memid"]);
    $products->bindValue(":pmes_context", $_POST["pmes_context"]);

    $products->execute();
    $post_no = $pdo->lastInsertId();
}  catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>

