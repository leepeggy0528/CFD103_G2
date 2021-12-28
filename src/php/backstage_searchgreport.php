<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["search"];
        $viewPhoto = json_decode($json, true);

        $sql = "select * from gro_report gr join igroup g on gr.gro_id = g.gro_id where greport_no =:sp_id;";
        $search= $pdo -> prepare($sql);
        $search -> bindValue(":sp_id",$viewPhoto["sp_id"]);
        //$search -> bindValue(":sp_id","111");
        $search -> execute();
        
        $searchRow = $search ->fetch(PDO::FETCH_ASSOC);

        $result = ["title"=>$searchRow["greport_no"],"name"=>$searchRow["gro_name"],"id"=>$searchRow["gro_id"],"reason"=>$searchRow["greport_reason"],"status"=>$searchRow["greport_status"]];
        echo json_encode($result);

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>