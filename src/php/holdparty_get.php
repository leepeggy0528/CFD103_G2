<?php 
    try {
        //引入連線工作的檔案
        require_once("../php/connectAccount.php");
        //執行sql指令並取得pdoStatement
        $sql = "SELECT `sig_name`, `sig_adress` FROM `sight`";
        $products = $pdo->prepare($sql);
        $products -> execute();
        $spotRow = $products->fetchAll(PDO::FETCH_ASSOC);

        for($i=0; $i < count($spotRow); $i++){
            if($i == count($spotRow)-1){
                echo $spotRow[$i]['sig_name'].':'.$spotRow[$i]['sig_adress'];
            }
            else{
                echo $spotRow[$i]['sig_name'].':'.$spotRow[$i]['sig_adress'].'/';
            }
        }
        //取回所有的資料, 放在2維陣列中
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }

?>