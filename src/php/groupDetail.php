<?php
try{
  require_once("./php/connectAccount.php");

    //查照片
    $sqlPic = "select  gp.gpt_pt from igroup g JOIN gro_pt gp ON  g.gro_id = gp.gro_id  where g.gro_id = 9487001;"; 
    $groupPics = $pdo->query($sqlPic);

    //取得標題、內文、開始日期、開始時間、結束、地點
    $sql_mainInfo='select  g.gro_name, g.gro_explan, g.gro_endadd, s.sche_name, s.sche_adress, s.sche_date, s.sche_starttime
    from igroup g JOIN schedule s on g.gro_id = s.gro_id
    where g.gro_id = 9487001;';
    $mainInfo = $pdo->query($sql_mainInfo);
    $mainInfoRow = $mainInfo->fetch(PDO::FETCH_ASSOC);
    
    // 類別、縣市、費用類型、x人成團
    $sql_subInfo = 'select gro_type, gro_loc, gro_paytype, gro_infnumber from igroup where gro_id = 9487001;';
    $subInfo = $pdo->query($sql_subInfo);
    $subInfoRow = $subInfo->fetch(PDO::FETCH_ASSOC);

    //行程資訊:行程名稱 / 開始日期/ 開始時間 / 結束時間 
    $sql_sche="select sche_name, sche_starttime, sche_endtime, sche_date
    from schedule where gro_id = 9487001;";
    $sche = $pdo->query($sql_sche);
    
    //留言: 留言人 / 內容/ 留言時間
    $sql_msg = 'select m.mem_pt, m.mem_name, gm.gmes_context
    from gro_mes gm  join igroup g on g.gro_id = gm.gro_id
                     join member m on gm.mem_id = m.mem_id
                     where g.gro_id = 9487006;';
    $msg = $pdo->query($sql_msg);


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
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/groupDetail.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="../js/owl.carousel.min.js" async></script>


    <title>印度料理&水煙</title>
</head>

<body>
    @@include('../layout/login.html')
    @@include('../layout/header.html')
    <div class="container">
        <div class="slider">
            <div class="owl-carousel owl-theme">
                <?php
                while($picRows = $groupPics->fetch(PDO::FETCH_ASSOC)){
                ?>
    
                
                    <img src="../images/group/<?=$picRows['gpt_pt'];?>">
               

                <?php }?>
            </div>
        </div>
    </div>
    <script src="../js/groupDetail.js" async></script>

    <!-- content -->
    <div class="container main">
        <article>
            <div class="desc">
                <div class="title">
                    <h2><?=$mainInfoRow['gro_name'];?></h2>
                </div>
                <div class="content">
                    <p>
                        <?=$mainInfoRow['gro_explan'];?>
                    </p>
                </div>
            </div>
            <div class="plan">
                <div class="title">
                    <h2>行程資訊</h2>
                </div>

                <?php
                  while($scheRows = $sche->fetch(PDO::FETCH_ASSOC)){
                ?>
                <ul class="timeline">
                    <li class="day">Day 1</li>
                    <li class=" item">
                        <div class="node">
                            <span><?=$scheRows['sche_starttime'];?></span>
                        </div>
                        <p><?=$scheRows['sche_name'];?></p>
                    </li>

                </ul>
                <?php }?>
            </div>
            <hr>
            <section class="sub-info">
                <div class="block">
                    <img src="../images/icon/loc.png" alt="">
                    <span><?=$subInfoRow['gro_loc']?></span>
                </div>
                <div class="block">
                    <img src="../images/icon/tag.png" alt="">
                    <span><?=$subInfoRow['gro_type']?></span>
                </div>
                <div class="block">
                    <img src="../images/icon/group.png" alt="">
                    <span><?=($subInfoRow['gro_infnumber']+1),"人成團"?></span>
                </div>
                <div class="block">
                    <img src="../images/icon/money.png" alt="">
                    <span>
                        <?php
                        switch($subInfoRow['gro_paytype']){
                            case 0:
                                echo "免費";
                                break;
                            case 1:
                                echo "各付各的";
                                break;
                            case 2:
                                echo "平均分攤";
                                break;
                        }
                            
                        ?>
                    </span>
                </div>
            </section>
            <hr>
            <!-- 留言區 -->
            <section class="comment">
                <h2>留言區</h2>
                <ul class="wrap">
                <?php
                  while($msgRows = $msg->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <li class="wrap-item">
                        <div class="user">
                            <div class="pic smCircle">
                                <img class="circle" src="../images/user/<?=$msgRows['mem_pt'];?>">
                            </div>
                            <span id="userName"><?=$msgRows['mem_name'];?></span>
                        </div>
                        <p><?=$msgRows['gmes_context'];?></p>
                    </li>
                <?php
                 }
                ?>
                </ul>

                <div class="leave-comment">
                    <form>
                        <textarea placeholder="請輸入留言" name="" id="" cols="30" rows="3"></textarea>
                        <div class="btn-pos">
                            <button class=" btnBlue">送出</button>
                        </div>
                    </form>
                </div>
            </section>
        </article>

        <!-- 側邊攔 -->
        <aside>
            <div class="info">
                <div class="info-wrap">
                    <div class="header">
                        <h3><?=$mainInfoRow['gro_name']?></h3>
                        <button id="info-toggle">
                            <img src="../images/icon/down.png" alt="收起資訊">
                        </button>
                    </div>
                    <div class="main-info">
                        <div class="info-item">
                            <div class="pic">
                                <img src="../images/icon/loc.png">
                            </div>
                            <p>
                            <?=$mainInfoRow['sche_name'];?>
                                <small><?=$mainInfoRow['sche_adress'];?></small>
                            </p>
                        </div>

                        <div class="info-item">
                            <div class="pic">
                                <img src="../images/icon/date.png">
                            </div>
                            <p>
                                <?=$mainInfoRow['sche_date']."&nbsp;".$mainInfoRow['sche_starttime'];?>
                                <small>(最後審核11/22 20:00 星期五)</small>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- <p class="registered">0位已報名</p> -->
                <div class='sign-up'>
                    <div class="pic">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>
                    <button class='btnBlue'>報名</button>
                </div>
            </div>
        </aside>
    </div>

    <!-- 類似活動 -->
    <div class="container">
        <section>
            <h2>類似活動</h2>
            <div class="similar">
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>

            </div>
        </section>
        <section class="similar-activitis">
            <h2>相同地點</h2>
            <div class="same-loc">
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="card">
                    <div class="iSave">
                        <img id="saveActivity" src="../images/icon/unsave.png" title="收藏活動" alt="">
                    </div>

                    <div class="pic">
                        <a href="groupDetail.html">
                            <img src="https://picsum.photos/400/300/?random=1">
                        </a>
                    </div>
                    <!-- 在外面多用一層 party_text 包 -->
                    <div class="party_text">
                        <div class="main">
                            <h3> <a href="groupDetail.html">印度料理&水菸印度料理&水印度料理&水菸印度料理&水</a></h3>
                            <p>你好嗎餐酒館</p>
                            <time>12-08(五) 19:00</time>
                        </div>
                        <div class="sub">
                            <div class="author">
                                <div class="pic smCircle">
                                    <img class="circle" src="https://picsum.photos/50/50/?random=1">
                                </div>
                                <span>林小妹</span>
                            </div>
                            <div class="hot">
                                <div class="pic">
                                    <img src="../images/icon/fire.png">
                                </div>
                                <span>12345</span>
                            </div>
                        </div>
                        <!-- 新增 see_more  -->
                        <div class="see_more">
                            <a href="groupDetail.html">
                                <button class="btnYellow">詳細資訊</button>
                            </a>
                            <button class="btnBlue">立即報名</button>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    @@include('../layout/footer.html')
    <script src="./js/loginLightbox.js"></script>
</body>

</html>