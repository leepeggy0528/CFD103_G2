<?php
    if(file_exists($_FILES['file']['tmp_name']))
    {
        //定義上傳資料夾
        $target_folder = $_POST['save_path'];
        //取得圖檔來源
        $file_name = $_FILES['file']['name'];

        //相徑是相對於php
        if(move_uploaded_file($_FILES['file']['tmp_name'],"../" . $target_folder . $file_name)){
            echo 'yes';
        }
        else{
            echo "檔案搬移失敗";
        }
    }
    else{
        echo "檔案上傳失敗";
    }
?>