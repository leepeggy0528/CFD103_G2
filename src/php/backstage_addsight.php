<?php 
    foreach($_FILES["upFile"]["error"] as $i => $data)
    {
        switch ($data) {
            case UPLOAD_ERR_OK:
                $dir = "images";
                if (file_exists("images")==false) {
                    mkdir($dir);
                }
                $from = $_FILES["upFile"]["tmp_name"][$i];
                $to = "$dir/".$_FILES["upFile"]["name"][$i];
                if (copy($from,$to)) {
                    echo "<script>alert('OK~~~');location.href='./fileUploadMany.html';</script>";
                }else{
                    echo "NG!!!<br>";
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                echo "檔案太大,不得超過".ini_get("upload_max_filesize")."<br>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "檔案太大,不得超過".$_POST['MAX_FILE_SIZE']."bytes <br>";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "檔案上傳不完整，請重新上傳<br>";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "未選取檔案~~<br>";
                break;
            default:
                # code...
                break;
        }
    }
?>
