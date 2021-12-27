<?php 
if( isset($_COOKIE["admin_name"]) == true){//已登入
    $result = ["admin_name"=>$_COOKIE["admin_name"]];
    echo json_encode($result);	
}else{ //尚未登入
	echo "{}";
}	
 ?>
