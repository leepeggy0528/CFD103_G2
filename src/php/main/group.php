<?php
try{
  require_once("./php/connectAccount.php");

    //所有活動
    $sql_allGroup = "select g.gro_show, g.gro_id, g.gro_name, s.sche_name, s.sche_starttime,s.sche_date, m.mem_name, mem_pt, gp.gpt_pt
    from igroup g join schedule s on g.gro_id = s.gro_id
                  join member m on g.mem_id = m.mem_id
                  join gro_pt gp on g.gro_id = gp.gro_id
                  group by g.gro_id;"; 
    $allGroup = $pdo->query($sql_allGroup);

    //取得標題、內文、開始日期、開始時間、結束、地點
  
    //蒐藏 
    
    
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
    <link rel="stylesheet" href="./css/group.css">
    <script src="./js/group.js"></script>
    <title>揪團趣</title>
</head>

<body>
    @@include('../../layout/login.html')
    @@include('../../layout/header.html')
    <div class='sort'>
        <a class="sortFocus">熱門聚會</a>
        <a>最新聚會</a>
    </div>
    <div class="container">
        <h2>所有聚會</h2>
        <div class="iFilter">
            <img id="filterIcon" src="./images/icon/filter.png" alt="">
        </div>


        <form id="checkFilter">
            <!-- 主題 -->
            <div class="themeDiv">
                <input type="checkbox" name="theme[]" value="全部" id="all" checked>
                <input type="checkbox" name="theme[]" value="美食" id="food">
                <input type="checkbox" name="theme[]" value="夜市" id="night_market">
                <input type="checkbox" name="theme[]" value="運動" id="sport">
                <input type="checkbox" name="theme[]" value="學習" id="learning">
                <input type="checkbox" name="theme[]" value="休閒" id="casual">
                <input type="checkbox" name="theme[]" value="燒腦" id="puzzle">
                <input type="checkbox" name="theme[]" value="旅行" id="trip">
                <input type="checkbox" name="theme[]" value="購物" id="shopping">
            </div>
            <!-- 地區 -->
            <div class="locDiv">
                <input type="checkbox" name="loc[]" id="allLoc" checked>
                <input type="checkbox" name="loc[]" id="YL">
                <input type="checkbox" name="loc[]" id="KL">
                <input type="checkbox" name="loc[]" id="TP">
                <input type="checkbox" name="loc[]" id="NTP">
                <input type="checkbox" name="loc[]" id="TY">
                <input type="checkbox" name="loc[]" id="HS">
                <input type="checkbox" name="loc[]" id="HSH">
                <input type="checkbox" name="loc[]" id="ML">
                <input type="checkbox" name="loc[]" id="TC">
                <input type="checkbox" name="loc[]" id="CW">
                <input type="checkbox" name="loc[]" id="NT">
                <input type="checkbox" name="loc[]" id="YLin">
                <input type="checkbox" name="loc[]" id="CY">
                <input type="checkbox" name="loc[]" id="TN">
                <input type="checkbox" name="loc[]" id="KS">
                <input type="checkbox" name="loc[]" id="PT">
                <input type="checkbox" name="loc[]" id="HL">
                <input type="checkbox" name="loc[]" id="TT">
                <input type="checkbox" name="loc[]" id="PH">
                <input type="checkbox" name="loc[]" id="KM">
                <input type="checkbox" name="loc[]" id="MZ">
            </div>
        </form>
        <!--======篩選器======-->
        <section class="filter">
            <div class="filter-wrapper">
                <div class="filter-header">
                    <div>主題</div>
                    <div>地區</div>

                </div>
                <div class="filter-main">
                    <ul class="theme">
                        <!-- <li>主題</li> -->
                        <li><label for="all" class="filterFocus">全部</label></li>
                        <li><label for="food">美食</label></li>
                        <li><label for="night_market">夜市</label></li>
                        <li><label for="sport">運動</label></li>
                        <li><label for="learning">學習</label></li>
                        <li><label for="casual">休閒</label></li>
                        <li><label for="puzzle">燒腦</label></li>
                        <li><label for="trip">旅行</label></li>
                        <li><label for="shopping">購物</label></li>
                    </ul>
                    <ul class="location">
                        <!-- <li>地區</li> -->
                        <li><label for="allLoc" class="filterFocus">全部</label></li>
                        <li><label for="YL">宜蘭縣</label></li>
                        <li><label for="KL">基隆市</label></li>
                        <li><label for="TP">台北市</label></li>
                        <li><label for="NTP">新北市</label></li>
                        <li><label for="TY">桃園市</label></li>
                        <li><label for="HS">新竹市</label></li>
                        <li><label for="HSH">新竹縣</label></li>
                        <li><label for="ML">苗栗縣</label></li>
                        <li><label for="TC">台中市</label></li>
                        <li><label for="CW">彰化縣</label></li>
                        <li><label for="NT">南投縣</label></li>
                        <li><label for="YLin">雲林縣</label></li>
                        <li><label for="CY">嘉義縣</label></li>
                        <li><label for="TN">台南市</label></li>
                        <li><label for="KS">高雄市</label></li>
                        <li><label for="PT">屏東縣</label></li>
                        <li><label for="HL">花蓮縣</label></li>
                        <li><label for="TT">台東縣</label></li>
                        <li><label for="PH">澎湖縣</label></li>
                        <li><label for="KM">金門縣</label></li>
                        <li><label for="MZ">馬祖縣</label></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- 下拉式選單 -->
        <section class="filter-select">
            <form action="" method="post">
                <div class="selectWrap">
                    <label class="labelTheme">主題
                        <select name="theme" id="selectTheme">
                            <option value="全部">全部</option>
                            <option value="美食">美食</option>
                            <option value="夜市">夜市</option>
                            <option value="運動">運動</option>
                            <option value="學習">學習</option>
                            <option value="休閒">休閒</option>
                            <option value="燒腦">燒腦</option>
                            <option value="旅行">旅行</option>
                            <option value="購物">購物</option>
                        </select>
                    </label>
                </div>

                <div class="selectWrap">
                    <label class="labelArea">地區
                        <select name="theme" id="selectArea">
                            <option value="全部">全部</option>
                            <option value="北部">北部</option>
                            <option value="中部">中部</option>
                            <option value="南部">南部</option>
                            <option value="離島">離島</option>

                        </select>


                        <label class="labelLoc">縣市
                            <select name="theme" id="selectLoc">
                                <option>選擇縣市</option>
                                <option value="台北市" class="north">台北市</option>
                                <option value="新北市" class="north">新北市</option>
                                <option value="桃園市" class="north">桃園市</option>
                                <option value="新竹市" class="north">新竹市</option>
                                <option value="新竹縣" class="north">新竹縣</option>
                                <option value="宜蘭縣" class="north">宜蘭縣</option>
                                <option value="基隆市" class="north">基隆市</option>
                                <option value="苗栗縣" class="central">苗栗縣</option>
                                <option value="台中市" class="central">台中市</option>
                                <option value="彰化縣" class="central">彰化縣</option>
                                <option value="南投縣" class="central">南投縣</option>
                                <option value="雲林縣" class="central">雲林縣</option>
                                <option value="嘉義縣" class="south">嘉義縣</option>
                                <option value="台南市" class="south">台南市</option>
                                <option value="高雄市" class="south">高雄市</option>
                                <option value="屏東縣" class="south">屏東縣</option>
                                <option value="花蓮縣" class="south">花蓮縣</option>
                                <option value="台東縣" class="south">台東縣</option>
                                <option value="澎湖縣" class="outlying">澎湖縣</option>
                                <option value="金門縣" class="outlying">金門縣</option>
                                <option value="馬祖縣" class="outlying">馬祖縣</option>
                            </select>
                        </label>
                </div>
            </form>
        </section>



        <!--======活動======-->

       
        <section class="pageGroup">
        <?php
            while($allGroupRows = $allGroup->fetch(PDO::FETCH_ASSOC)){
                if($allGroupRows['gro_show']==1){
        ?>
    
            <div id="card" class="card">
                <div class="iSave">
                    <img id="saveActivity" src="./images/icon/unsave.png" title="收藏活動" alt="">
                </div>

                <div class="pic">
                    <a href="groupDetail.php?gro_id=<?=$allGroupRows['gro_id']?>">
                        <img src="./images/group/<?=$allGroupRows['gpt_pt']?>">
                    </a>
                </div>
                <!-- 在外面多用一層 party_text 包 -->
                <div class="party_text">
                    <div class="main">
                        <h3> <a href="groupDetail.html"><?=$allGroupRows['gro_name']?></a></h3>
                        <p><?=$allGroupRows['sche_name']?></p>
                        <time><?=$allGroupRows['sche_date']?> <?=$allGroupRows['sche_starttime']?></time>
                    </div>
                    <div class="sub">
                        <div class="author">
                            <div class="pic smCircle">
                                <img class="circle" src="./images/user/<?=$allGroupRows['mem_pt']?>">
                            </div>
                            <span><?=$allGroupRows['mem_name']?></span>
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
                        <a href="groupDetail.php?gro_id=<?=$allGroupRows['gro_id']?>">
                            <button class="btnYellow">詳細資訊</button>
                        </a>
                        <button class="btnBlue signUp">立即報名</button>
                    </div>
                    <!--  -->
                </div>
            </div>

            <?php
             }
            }
             ?>

        </section>
        <!-- 分頁數字 -->
        <section class="page">
            <button class="prev">上一頁</button>
            <button class="pageNo">1</button>
            <button class="pageNo">2</button>
            <button class="pageNo">3</button>
            <span>...</span>
            <button class="pageNo">10</button>
            <button class="next">下一頁</button>
        </section>
    </div>
    @@include('../../layout/footer.html')
    <script src="./js/loginLightbox.js"></script>

</body>

</html>