<?php
    try {
        //require_once('./php/connectAccount.php');
        require_once('./connectAccount.php');
        $json = $_POST["signup"];
        $signupData = json_decode($json, true);

        $check_sql = "select admin_id from admin where admin_id =:sp_id;";
        $check= $pdo -> prepare($check_sql);
        $check -> bindValue(":sp_id",$signupData["sp_id"]);
        $check -> execute();
        if ($check->rowCount()==0) {
            $sql = "insert into admin value(?,?,?);";
            $signup= $pdo -> prepare($sql);
            $signup -> bindValue(1,$signupData["sp_id"]);
            $signup -> bindValue(2,$signupData["sp_pswd"]);
            $signup -> bindValue(3,$signupData["sp_name"]);
            $signup->execute();
            echo "{}";
        }else{
            $checkRow = $check ->fetch(PDO::FETCH_ASSOC);
            $result =["sp_id"=>$checkRow["admin_id"]];
            echo json_encode($result);
        }
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>