<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["delete"];
        $deleteData = json_decode($json, true);

        $sql = "delete from admin where admin_id = :sp_id;";
        $delete= $pdo -> prepare($sql);
        $delete -> bindValue(":sp_id",$deleteData["sp_id"]);
        //$delete -> bindValue(":sp_id","111");
        $delete -> execute();

    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>