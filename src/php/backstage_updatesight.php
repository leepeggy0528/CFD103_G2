<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');

        $sql = "UPDATE `sight` SET `sig_name`=:sig_name,`sig_describe`=:sig_describe,`sig_intro`=:sig_intro,`sig_phone`=:sig_phone,`sig_adress`=:sig_adress,`sig_time`=:sig_time,`sig_web`=:sig_web,`sig_type`=:sig_type,`sig_loc`=:sig_loc' where sig_no = :sig_no;";
            $update= $pdo -> prepare($sql);
            $update -> bindValue(":sig_no", $_POST["sig_id"]);
                $update -> bindValue(":sig_name", $_POST["name"]);
                $update -> bindValue(":sig_describe", $_POST["desc"]);
                $update -> bindValue(":sig_intro", $_POST["intro"]);
                $update -> bindValue(":sig_phone", $_POST["tel"]);
                $update -> bindValue(":sig_adress",$_POST["loc"].$_POST["address"]);
                $update -> bindValue(":sig_time", $_POST["time"]);
                $update -> bindValue(":sig_web", $_POST["web"]);
                $update -> bindValue(":sig_type", $_POST["type"]);
                $update -> bindValue(":sig_loc", $_POST["loc"]);
        $update -> execute();

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>