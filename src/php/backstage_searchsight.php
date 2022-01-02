<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["search"];
        $viewSight = json_decode($json, true);

        $sql = "select * from sight where sig_no =:sp_id;";
        $search= $pdo -> prepare($sql);
        $search -> bindValue(":sp_id",$viewSight["sp_id"]);
        //$search -> bindValue(":sp_id","111");
        $search -> execute();
        
        $searchRows = $search ->fetch(PDO::FETCH_ASSOC);
        $sig_adress=substr($searchRows["sig_adress"],9);
        $result = ["sig_id"=>$searchRows["sig_no"],"sig_name"=>$searchRows["sig_name"],"sig_address"=>$sig_adress,"sig_desc"=>$searchRows["sig_describe"],"sig_intro"=>$searchRows["sig_intro"],"sig_tel"=>$searchRows["sig_phone"],"sig_time"=>$searchRows["sig_time"],"sig_web"=>$searchRows["sig_web"],"sig_type"=>$searchRows["sig_type"],"sig_loc"=>$searchRows["sig_loc"]];
        echo json_encode($result);

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>