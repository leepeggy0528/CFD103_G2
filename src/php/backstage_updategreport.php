<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["update"];
        $updateData = json_decode($json, true);

        $sql = "update gro_report set greport_status=:sp_pswd where greport_no = :sp_id;";
        $update= $pdo -> prepare($sql);
        $update -> bindValue(":sp_pswd",$updateData["ans"]);
        $update -> bindValue(":sp_id",$updateData["sp_id"]);
        //$update -> bindValue(":sp_id","111");
        $update -> execute();
        /* if ($updateData["ans"]==1) {
            $sql = "DELETE FROM `gro_pt` WHERE 0 where `gro_id` = :sp_id;";
            $update= $pdo -> prepare($sql);
            $update -> bindValue(":sp_id",$updateData["sp_id"]);
            $update -> execute();
            
        } */
        if ($updateData["ans"]==1) {
            $sql1 = "update `igroup` set `gro_show`= 0 where gro_name = :sp_id;";
            $update1= $pdo -> prepare($sql1);
            $update1 -> bindValue(":sp_id",$updateData["sp_context"]);
            $update1 -> execute();
        }
        if ($updateData["ans"]==2) {
            $sql1 = "update `igroup` set `gro_show`= 1 where gro_name = :sp_id;";
            $update1= $pdo -> prepare($sql1);
            $update1 -> bindValue(":sp_id",$updateData["sp_context"]);
            $update1 -> execute();
        }
        


    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>