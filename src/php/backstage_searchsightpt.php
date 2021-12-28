<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["search"];
        $viewPhoto = json_decode($json, true);

        $sql = "select * from sight_pt where sig_no =:sp_id;";
        $search= $pdo -> prepare($sql);
        $search -> bindValue(":sp_id",$viewPhoto["sp_id"]);
        //$search -> bindValue(":sp_id","111");
        $search -> execute();
        
        $searchRow = $search ->fetchAll(PDO::FETCH_ASSOC);
        $searchpt=[];
        foreach($searchRow as $key => $searchRow){
            array_push($searchpt,$searchRow["spt_pt"]);
        }
        $result = ["sp_pt"=>$searchpt];
        echo json_encode($result);

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>