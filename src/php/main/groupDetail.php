<?php
try{
  require_once("./php/connectAccount.php");

    //查照片

    $sqlPic = "select  gp.gpt_pt from igroup g JOIN gro_pt gp ON  g.gro_id = gp.gro_id  where g.gro_id=:gro_id;";
    
    $groupPics = $pdo->prepare($sqlPic);
    $groupPics->bindValue(":gro_id", $_GET["gro_id"]);
    $groupPics->execute();

    //取得標題、內文、開始日期、開始時間、結束、地點
    $sql_mainInfo='select  g.gro_name, g.gro_explan, g.gro_endadd, s.sche_name, s.sche_adress, s.sche_date, s.sche_starttime
    from igroup g JOIN schedule s on g.gro_id = s.gro_id
    where g.gro_id=:gro_id;';

    $mainInfo = $pdo->prepare($sql_mainInfo);
    $mainInfo->bindValue(":gro_id", $_GET["gro_id"]);
    $mainInfo->execute();
    
    $mainInfoRow = $mainInfo->fetch(PDO::FETCH_ASSOC);
    
    // 類別、縣市、費用類型、x人成團
    $sql_subInfo = 'select gro_type, gro_loc, gro_paytype, gro_infnumber from igroup where gro_id=:gro_id;';
    // $subInfo = $pdo->query($sql_subInfo);

    $subInfo = $pdo->prepare($sql_subInfo);
    $subInfo->bindValue(":gro_id", $_GET["gro_id"]);
    $subInfo->execute();

    $subInfoRow = $subInfo->fetch(PDO::FETCH_ASSOC);

    //行程資訊:行程名稱 / 開始日期/ 開始時間 / 結束時間 
    $sql_sche="select sche_name, sche_starttime, sche_endtime, sche_date
    from schedule where gro_id=:gro_id;";

    $sche = $pdo->prepare($sql_sche);
    $sche->bindValue(":gro_id", $_GET["gro_id"]);
    $sche->execute();
    // $sche = $pdo->query($sql_sche);
    
    //留言: 留言人 / 內容/ 留言時間
    $sql_msg = 'select m.mem_pt, m.mem_name, gm.gmes_context, gm.gmes_time
    from gro_mes gm  join igroup g on g.gro_id = gm.gro_id
                     join member m on gm.mem_id = m.mem_id
                     where g.gro_id=:gro_id;';
    $msg = $pdo->prepare($sql_msg);
    $msg->bindValue(":gro_id", $_GET["gro_id"]);
    $msg->execute();

    //相同地點
    $loc = $subInfoRow['gro_loc'];
    $sql_sameLoc="select g.gro_show, g.gro_id, g.gro_name, s.sche_name, s.sche_starttime,s.sche_date, m.mem_name, mem_pt, gp.gpt_pt
    from igroup g join schedule s on g.gro_id = s.gro_id
                      join member m on g.mem_id = m.mem_id
                      join gro_pt gp on g.gro_id = gp.gro_id
                      where g.gro_loc='$loc' and gro_show =1 
                      group by g.gro_id;";
    $sameLoc = $pdo->query($sql_sameLoc);
    $sameLocRows = $sameLoc->fetchAll(PDO::FETCH_ASSOC); 

    //相同類型
    $type = $subInfoRow['gro_type'];
    $sql_sameType="select g.gro_show, g.gro_id, g.gro_name, s.sche_name, s.sche_starttime,s.sche_date, m.mem_name, mem_pt, gp.gpt_pt
    from igroup g join schedule s on g.gro_id = s.gro_id
                      join member m on g.mem_id = m.mem_id
                      join gro_pt gp on g.gro_id = gp.gro_id
                      where g.gro_type='$type' and gro_show =1
                      group by g.gro_id;";
    $sameType = $pdo->query($sql_sameType);
    $sameTypeRows = $sameType->fetchAll(PDO::FETCH_ASSOC); 
                  


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
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/groupDetail.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>



    <title>印度料理&水煙</title>
</head>

<body>
    @@include('../../layout/login.html')
    @@include('../../layout/header.html')
    <div class="container">
        <div class="slider">
            <div class="owl-carousel owl-theme">
                <?php
                while($picRows = $groupPics->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <img src="./images/group/<?=$picRows['gpt_pt'];?>">
               <?php }?>
            </div>
        </div>
    </div>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/groupDetail.js"></script>
    
    <!-- content -->
    <div class="container main">
        <article>
            <div class="desc">
                <div class="title">
                    <h2><?=$mainInfoRow['gro_name'];?></h2>
                </div>
                <div class="content">
                    <p>
                        <?=nl2br($mainInfoRow['gro_explan']);?>
                    </p>
                    <p id="report"><span>檢舉</span></p>
                </div>
            </div>
            <div class="plan">
                <div class="title">
                    <h2>行程資訊</h2>
                </div>

              
                <ul class="timeline">
                    <li class="day">Day 1</li>
                <?php
                  while($scheRows = $sche->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <li class=" item">
                        <div class="node">
                            <span><?=$scheRows['sche_starttime'];?></span>
                        </div>
                        <p><?=$scheRows['sche_name'];?></p>
                    </li>
                 <?php }?>
            </div>

                </ul>
            
            <hr>
            <section class="sub-info">
                <div class="block">
                    <img src="./images/icon/loc.png" alt="">
                    <span><?=$subInfoRow['gro_loc'];?></span>
                </div>
                <div class="block">
                    <img src="./images/icon/tag.png" alt="">
                    <span><?=$subInfoRow['gro_type'];?></span>
                </div>
                <div class="block">
                    <img src="./images/icon/group.png" alt="">
                    <span><?=($subInfoRow['gro_infnumber']+1),"人成團";?></span>
                </div>
                <div class="block">
                    <img src="./images/icon/money.png" alt="">
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
                                <img class="circle" src="./images/user/<?=$msgRows['mem_pt'];?>">
                            </div>
                            <span id="userName"><?=$msgRows['mem_name'];?></span>
                        </div>
                        <p><?=$msgRows['gmes_context'];?></p>
                        <time><?=$msgRows['gmes_time'];?></time>
                    </li>
                <?php
                 }
                ?>
                </ul>

                <div class="leave-comment">
                    <form>
                        <textarea placeholder="請輸入留言" name="comment" id="comment" cols="30" rows="3"></textarea>
                        <div class="btn-pos">
                            <button type="button" id="sendComment" class="btnBlue">送出</button>
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
                        <h3><?=$mainInfoRow['gro_name'];?></h3>
                        <button id="info-toggle">
                            <img src="./images/icon/down.png" alt="收起資訊">
                        </button>
                    </div>
                    <div class="main-info">
                        <div class="info-item">
                            <div class="pic">
                                <img src="./images/icon/loc.png">
                            </div>
                            <p>
                            <?=$mainInfoRow['sche_name'];?>
                                <small><?=$mainInfoRow['sche_adress'];?></small>
                            </p>
                        </div>

                        <div class="info-item">
                            <div class="pic">
                                <img src="./images/icon/date.png">
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
                        <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                    </div>
                    <button class='btnBlue'>報名</button>
                </div>
            </div>
        </aside>
    </div>

    <!-- 類似活動 -->
    <div class="container">
        <section>
        <?php 
          if (count($sameTypeRows)>1){
        ?>
            <h2>類似活動</h2>
        <?php 
          }
        ?>    
            <div class="similar">
            <?php
          
          if (count($sameTypeRows)>4){
              for($i=0;$i<=3;+$i++){
                  if($sameTypeRows[$i]['gro_id']!=$_GET['gro_id']){
          ?>
               <div id="card" class="card">
                  <div class="iSave">
                      <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                  </div>
  
                  <div class="pic">
                      <a href="groupDetail.php?gro_id=<?=$sameTypeRows[$i]['gro_id']?>">
                          <img src="./images/group/<?=$sameTypeRows[$i]['gpt_pt']?>">
                      </a>
                  </div>
                  <!-- 在外面多用一層 party_text 包 -->
                  <div class="party_text">
                      <div class="main">
                          <h3> <a href="groupDetail.html"><?=$sameTypeRows[$i]['gro_name']?></a></h3>
                          <p><?=$sameTypeRows[$i]['sche_name']?></p>
                          <time><?=$sameTypeRows[$i]['sche_date']?> <?=$sameTypeRows[$i]['sche_starttime']?></time>
                      </div>
                      <div class="sub">
                          <div class="author">
                              <div class="pic smCircle">
                                  <img class="circle" src="./images/user/<?=$sameTypeRows[$i]['mem_pt']?>">
                              </div>
                              <span><?=$sameTypeRows[$i]['mem_name']?></span>
                          </div>
                          <div class="hot">
                              <div class="pic">
                                  <img src="./images/icon/fire.png">
                              </div>
                              <span>12345</span>
                          </div>
                      </div>
                      <!-- 新增 see_more  -->
                      <div class="see_more">
                      <a href="groupDetail.php?gro_id=<?=$sameTypeRows[$i]['gro_id']?>">
                              <button class="btnYellow">詳細資訊</button>
                          </a>
                          <button class="btnBlue">立即報名</button>
                      </div>
                      <!--  -->
                  </div>
              </div>
          </div>
  
          <?php }
              }
          }else{
              for($i=0;$i<count($sameTypeRows);+$i++){
                  if($sameTypeRows[$i]['gro_id']!=$_GET['gro_id']){ ?>
              <div id="card" class="card">
                  <div class="iSave">
                      <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                  </div>
  
                  <div class="pic">
                      <a href="groupDetail.php?gro_id=<?=$sameTypeRows[$i]['gro_id']?>">
                          <img src="./images/group/<?=$sameTypeRows[$i]['gpt_pt']?>">
                      </a>
                  </div>
                  <!-- 在外面多用一層 party_text 包 -->
                  <div class="party_text">
                      <div class="main">
                          <h3> <a href="groupDetail.html"><?=$sameTypeRows[$i]['gro_name']?></a></h3>
                          <p><?=$sameLocRows[$i]['sche_name']?></p>
                          <time><?=$sameLocRows[$i]['sche_date']?> <?=$sameLocRows[$i]['sche_starttime']?></time>
                      </div>
                      <div class="sub">
                          <div class="author">
                              <div class="pic smCircle">
                                  <img class="circle" src="./images/user/<?=$sameLocRows[$i]['mem_pt']?>">
                              </div>
                              <span><?=$sameLocRows[$i]['mem_name']?></span>
                          </div>
                          <div class="hot">
                              <div class="pic">
                                  <img src="./images/icon/fire.png">
                              </div>
                              <span>12345</span>
                          </div>
                      </div>
                      <!-- 新增 see_more  -->
                      <div class="see_more">
                      <a href="groupDetail.php?gro_id=<?=$sameLocRows[$i]['gro_id']?>">
                              <button class="btnYellow">詳細資訊</button>
                          </a>
                          <button class="btnBlue">立即報名</button>
                      </div>
                      <!--  -->
                  </div>
              </div>
  
  
          <?php
                  }
              }
          }     
         ?>
      
        </section>

        <!-- 相同地點 -->
        <section class="similar-activitis">

        <?php 
          if (count($sameLocRows)>1){
        ?>
            <h2>相同地點</h2>
            <?php 
          }
        ?>
            <div class="same-loc">
      

        <?php
        if (count($sameLocRows)>4){
            for($i=0;$i<=3;+$i++){
                if($sameLocRows[$i]['gro_id']!= $_GET['gro_id']){
        ?>
             <div id="card" class="card">
                <div class="iSave">
                    <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                </div>

                <div class="pic">
                    <a href="groupDetail.php?gro_id=<?=$sameLocRows[$i]['gro_id']?>">
                        <img src="./images/group/<?=$sameLocRows[$i]['gpt_pt']?>">
                    </a>
                </div>
                <!-- 在外面多用一層 party_text 包 -->
                <div class="party_text">
                    <div class="main">
                        <h3> <a href="groupDetail.html"><?=$sameLocRows[$i]['gro_name']?></a></h3>
                        <p><?=$sameLocRows[$i]['sche_name']?></p>
                        <time><?=$sameLocRows[$i]['sche_date']?> <?=$sameLocRows[$i]['sche_starttime']?></time>
                    </div>
                    <div class="sub">
                        <div class="author">
                            <div class="pic smCircle">
                                <img class="circle" src="./images/user/<?=$sameLocRows[$i]['mem_pt']?>">
                            </div>
                            <span><?=$sameLocRows[$i]['mem_name']?></span>
                        </div>
                        <div class="hot">
                            <div class="pic">
                                <img src="./images/icon/fire.png">
                            </div>
                            <span>12345</span>
                        </div>
                    </div>
                    <!-- 新增 see_more  -->
                    <div class="see_more">
                    <a href="groupDetail.php?gro_id=<?=$sameLocRows[$i]['gro_id']?>">
                            <button class="btnYellow">詳細資訊</button>
                        </a>
                        <button class="btnBlue">立即報名</button>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>

        <?php }
            }
        }else{
            for($i=0;$i<count($sameLocRows);+$i++){
                if( $sameLocRows[$i]['gro_id']!= $_GET['gro_id']){ ?>
            <div id="card" class="card">
                <div class="iSave">
                    <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                </div>

                <div class="pic">
                    <a href="groupDetail.php?gro_id=<?=$sameLocRows[$i]['gro_id']?>">
                        <img src="./images/group/<?=$sameLocRows[$i]['gpt_pt']?>">
                    </a>
                </div>
                <!-- 在外面多用一層 party_text 包 -->
                <div class="party_text">
                    <div class="main">
                        <h3> <a href="groupDetail.html"><?=$sameLocRows[$i]['gro_name']?></a></h3>
                        <p><?=$sameLocRows[$i]['sche_name']?></p>
                        <time><?=$sameLocRows[$i]['sche_date']?> <?=$sameLocRows[$i]['sche_starttime']?></time>
                    </div>
                    <div class="sub">
                        <div class="author">
                            <div class="pic smCircle">
                                <img class="circle" src="./images/user/<?=$sameLocRows[$i]['mem_pt']?>">
                            </div>
                            <span><?=$sameLocRows[$i]['mem_name']?></span>
                        </div>
                        <div class="hot">
                            <div class="pic">
                                <img src="./images/icon/fire.png">
                            </div>
                            <span>12345</span>
                        </div>
                    </div>
                    <!-- 新增 see_more  -->
                    <div class="see_more">
                    <a href="groupDetail.php?gro_id=<?=$sameLocRows[$i]['gro_id']?>">
                            <button class="btnYellow">詳細資訊</button>
                        </a>
                        <button class="btnBlue">立即報名</button>
                    </div>
                    <!--  -->
                </div>
            </div>


        <?php
                }
            }
        }     
       ?>
    
   

        </section>
    </div>
    <!-- report lightbox -->
    <div class="reportLayer">
        <div class="reportContent">
            <h2>檢舉活動</h2>
            <textarea placeholder="請描述原因" name="" id="reportText" cols="30" rows="10"></textarea>
            <button class="btnYellow" id="rpCancel">取消</button>
            <button class="btnYellow" id="rpSend">送出</button>
        </div>
    </div>


    @@include('../../layout/footer.html')
    <script src="./js/loginLightbox.js"></script>
 
</body>

</html>