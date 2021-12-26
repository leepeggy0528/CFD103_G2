<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["search"];
        $searchData = json_decode($json, true);

        $sql = "select * from admin where admin_id =:sp_id;";
        $search= $pdo -> prepare($sql);
        $search -> bindValue(":sp_id",$searchData["sp_id"]);
        //$search -> bindValue(":sp_id","111");
        $search -> execute();
        
        $searchRow = $search ->fetch(PDO::FETCH_ASSOC);
        $result = ["sp_id"=>$searchRow["admin_id"],"sp_name"=>$searchRow["admin_name"],"sp_pswd"=>$searchRow["admin_pswd"]];
        echo json_encode($result);

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>