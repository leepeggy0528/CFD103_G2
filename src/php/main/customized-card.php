<?php
ob_start();
session_start();
//貼紙 
$sql_sticker="select * from stamp_style;";
$stickers = $pdo->query($sql_sticker);

//卡片
$sql_card="select * from card_style;";
$cards = $pdo->query($sql_card);	
// $cardRows = $cards->fetchAll(PDO::FETCH_ASSOC);
try{
  require_once("./php/connectAccount.php");
  if( isset($_SESSION["memMail"])){
    //取得好友
    $sqlFD = "select mem_name, mem_pt, mem_mail
    from member where mem_id in (select f.friend_id
                                from  member m JOIN friend f on m.mem_id = f.mem_id
                                where m.mem_id = :mem_id);"; 
    $friends = $pdo->prepare($sqlFD);
    $friends->bindValue(":mem_id",$_SESSION["memId"]);
    $friends->execute();

    
    }else{ //尚未登入
    	$msg= "尚未登入";
    }	

}catch(PDOException $e){
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/customized-card.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

    <script src="./js/customizedCard.js"></script>
    
    <script type="text/javascript">
        (function () {
            emailjs.init("user_IMcEsViZ8QX2YF42g5Xqu");
        })();
    </script>
    <title>客製卡片</title>
</head>

<body>
    @@include('../../layout/login.html')
    @@include('../../layout/header.html')
    <div class="container">
        <h2>客製卡片</h2>
        <section class="customized-card">
            <!-- 預覽卡片 -->
            <div class="wrap-preview">
                <div class="card-preview">
                    <div id="capture" class="pic">
                        <img id="preivewCardPattern" src="./images/card/colorful-line.jpg" alt="">
                        <div class="inputText">

                        </div>
                        <div class="stickerPos">
                            <div class="box box1"></div>
                            <div class="box box2"></div>
                            <div class="box box3"></div>
                            <div class="box box4"></div>
                            <div class="box box5"></div>
                            <div class="box box6"></div>
                            <div class="box box7"></div>
                            <div class="box box8"></div>
                            <div class="box box9"></div>
                            <div class="box box10"></div>
                            <div class="box box11"></div>
                            <div class="box box12"></div>
                        </div>
                    </div>
                    <div id="trashCan">
                        <img src="./images/icon/trash_can_close.png" alt="">
                    </div>
                </div>
                <div class="write">
                    <textarea name="" id="" placeholder="輸入卡片內容"></textarea>
                </div>
            </div>
            <!-- 樣式 -->
            <div class="wrapper">
                <!-- 標籤 -->
                <div class="tag-wrapper ">
                    <span class="tag-focus">卡片</span>
                    <span>貼紙</span>
                </div>
                <div class="wrap-pattern">
                    <div class="card-pattern">
                        <!-- <div class="pic cardFocus">
                            <img class="selectCard" src="./images/card/colorful-line.jpg" alt="">
                        </div> -->
                        <?php
                            while($cardRows = $cards->fetch(PDO::FETCH_ASSOC)){
                                if($cardRows['cstyle_status']==0){
                        ?>
                        <div class="pic">
                            <img class="selectCard" src="./images/card/<?=$cardRows['cstyle_pt']?>" alt="">
                        </div>

                        <?php
                        }
                        }
                        ?>

                    
                    </div>

               

                    <div class="sticker hidden">
                    <?php
                        while($stickerRows = $stickers->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <div class="pic">
                            <img src="./images/sticker/<?=$stickerRows['sstyle_pt']?>" alt="">
                        </div>
                    <?php
                    }
                    ?>
                    </div>

                    <!-- 按鈕 -->

                    <button id="download" class="btnYellow btn">下載卡片</button>
                    <a id="testCardLink" download="sample.png" href=""></a>
                    <button id="open" class="btnBlue btn">寄出卡片</button>
                    <!-- <input name="hidden_data" id='hidden_data' type="hidden" /> -->
                </div>
            </div>


            <!-- 寄卡片 lightbox -->
            <div class="sendCardLayer" id="sendCardLayer">
                <section id="sendCard" class="sendCard">
                    <button class="iClose" id="close">
                        <img src="./images/icon/close.png" alt="">
                    </button>
                    <div class="header">
                        <h3>以Email寄出卡片</h3>
                        <div class="pic">
                            <!-- <img src="./images/card/colorful-line.jpg"> -->
                        </div>
                    </div>

                    <input type="text" class="friend-search" placeholder="搜尋好友">
                    <ul class="friend-list">
                        <?php 
                        if($friends->rowCount()==0){
                            echo "<li>".$msg."</li>";
                        }else{
                        while($friendRows = $friends->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <li>
                            <div class="user">
                                <img class="headshot" src="./images/user/<?=$friendRows['mem_pt'];?>" alt="">
                                <span><?=$friendRows['mem_name'];?></span>
                            </div>
                            <button class="send btnYellow">寄送</button>

                        </li>
                        <?php 
                            }
                          }
                        ?>
                       

                </section>
            </div>
        </section>
    </div>
    <!-- ============canvas=========== -->
    @@include('../../layout/footer.html')
    <!-- <script src="./js/customizedCard.js"></script> -->
    <script src="./js/loginLightbox.js"></script>

</body>

</html>