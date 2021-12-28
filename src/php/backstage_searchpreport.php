<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["search"];
        $viewPhoto = json_decode($json, true);

        $sql = "select * from post_report pr join post p on pr.post_no = p.post_no where preport_no =:sp_id;";
        $search= $pdo -> prepare($sql);
        $search -> bindValue(":sp_id",$viewPhoto["sp_id"]);
        //$search -> bindValue(":sp_id","111");
        $search -> execute();
        
        $searchRow = $search ->fetch(PDO::FETCH_ASSOC);

        $result = ["title"=>$searchRow["preport_no"],"reason"=>$searchRow["preport_reason"],"context"=>$searchRow["post_context"],"status"=>$searchRow["preport_status"]];
        echo json_encode($result);

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>