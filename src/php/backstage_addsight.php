<?php 
    require_once('./connectAccount.php');
    $sql = "INSERT INTO `sight` VALUES (Null, :sig_name, :sig_describe,:sig_intro, :sig_phone, :sig_adress, :sig_time, :sig_web, :sig_type, :sig_loc)";
                $products = $pdo->prepare( $sql );
                $products -> bindValue(":sig_name", $_POST["name"]);
                $products -> bindValue(":sig_describe", $_POST["desc"]);
                $products -> bindValue(":sig_intro", $_POST["intro"]);
                $products -> bindValue(":sig_phone", $_POST["tel"]);
                $products -> bindValue(":sig_adress",$_POST["loc"].$_POST["address"]);
                $products -> bindValue(":sig_time", $_POST["time"]);
                $products -> bindValue(":sig_web", $_POST["web"]);
                $products -> bindValue(":sig_type", $_POST["type"]);
                $products -> bindValue(":sig_loc", $_POST["loc"]);
                $products -> execute();		
    $sig_no = $pdo->lastInsertId();	
    foreach($_FILES["upFile"]["error"] as $i => $data)
    {
        if( $data == UPLOAD_ERR_OK){
            //決定檔案名稱
            $fileInfoArr = pathinfo($_FILES["upFile"]["name"][$i]);
            $imageNo = uniqid();
            $fileName = "{$imageNo}.{$fileInfoArr["extension"]}";  //312543544.gif
            //先檢查images資料夾存不存在
            if( file_exists("../images/sight") === false){
                mkdir("../images/sight");
            }
            //將檔案copy到要放的路徑
            $from = $_FILES["upFile"]["tmp_name"][$i];
            $to = "../images/sight/$fileName";
            if(copy( $from, $to)===true){
                $sql = "INSERT INTO `sight_pt` VALUES (null, :sig_no, :spt_pt)";
                $products = $pdo->prepare( $sql );
                $products -> bindValue(":sig_no",$sig_no);
                $products -> bindValue(":spt_pt", $fileName);
                $products -> execute();		
                echo "新增成功~";
            }else{
                echo "失敗~";
            }

        }else{
            echo "錯誤代碼 : {$data} <br>";
            echo "新增失敗<br>";
        }
    }
?>
