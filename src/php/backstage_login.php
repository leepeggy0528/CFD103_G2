<?php
    $id=$_POST('id');
    $pswd=$_POST('pswd');
    if ($id=='111'&& $pswd='abc12345') {
        echo "<script>location.href='./backstage_admin.html'</script>";
    }else{
        echo "<script>alert('帳密錯誤');location.href='./demo.html'</script>";
    }
?>