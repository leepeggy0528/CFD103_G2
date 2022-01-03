<?php
try{
  require_once("./connectAccount.php");

    $postId = $_POST['pno'];
    $status = $_POST['status'];
    $content = $_POST['content'];
    $post_show= $_POST['post_show'];


    $sql="insert into post_report(post_no,preport_reason) value($postId,'$content')";
    $pdo->exec($sql);
 

    $sql_status="update post set post_show = $post_show where post_no=$postId";
    $pdo->exec($sql_status);
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

