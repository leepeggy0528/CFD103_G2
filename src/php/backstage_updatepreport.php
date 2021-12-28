<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["update"];
        $updateData = json_decode($json, true);

        $sql = "update post_report set preport_status=:sp_pswd where preport_no = :sp_id;";
        $update= $pdo -> prepare($sql);
        $update -> bindValue(":sp_pswd",$updateData["ans"]);
        $update -> bindValue(":sp_id",$updateData["sp_id"]);
        //$update -> bindValue(":sp_id","111");
        $update -> execute();

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>