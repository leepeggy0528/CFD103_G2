<?php 
    try {
        //引入連線工作的檔案
        require_once("./php/connectAccount.php");
        //require_once("../connectAccount.php");
        
        //執行sql指令並取得pdoStatement
        $sql = "select * from sight s join sight_pt spt on s.sig_no=spt.sig_no
        where spt.spt_pt like('%01%');";
        $products = $pdo->query($sql); 
        $r = rand(3333001,3333010);
        $sqlf = "select * from sight s join sight_pt spt on s.sig_no=spt.sig_no where s.sig_no=? and spt.spt_pt like('%01%')";
        $productsf = $pdo->prepare($sqlf);
        $productsf -> bindValue(1,$r);
        $productsf -> execute();
        $prodRowf = $productsf->fetch(PDO::FETCH_ASSOC);
        //取回所有的資料, 放在2維陣列中
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/attractions.css">
    <link rel="stylesheet" href="./js/group.js">
    <script src="./js/cart.js"></script>
    <title>旅行趣</title>
</head>
<body>
    
    @@include('../../layout/login.html')
    @@include('../../layout/header.html')

    <div class="filter-container">
        
        <div class="menu">
            <h3>主題</h3>
            <ul class="main-option">
                <li><a href="">全部</a></li>
                <li><a href="">美食</a></li>
                <li><a href="">夜市</a></li>
                <li><a href="">學習</a></li>
                <li><a href="">運動</a></li>
                <li><a href="">休閒</a></li>
                <li><a href="">燒腦</a></li>
                <li><a href="">旅行</a></li>
                <li><a href="">購物</a></li>
            </ul>
        </div>
        

        <div class="submenu">
            <h3>地區</h3>
            <ul class="sub-option">
                <li><a href="">全部</a></li>
                <li><a href="">宜蘭縣</a></li>
                <li><a href="">基隆市</a></li>
                <li><a href="">台北市</a></li>
                <li><a href="">新北市</a></li>
                <li><a href="">桃園市</a></li>
                <li><a href="">新竹市</a></li>
                <li><a href="">新竹縣</a></li>
                <li><a href="">苗栗縣</a></li><br>
                <li><a href="">台中市</a></li>
                <li><a href="">彰化縣</a></li>
                <li><a href="">南投縣</a></li>
                <li><a href="">雲林縣</a></li>
                <li><a href="">嘉義市</a></li>
                <li><a href="">嘉義縣</a></li>
                <li><a href="">台南市</a></li>
                <li><a href="">高雄市</a></li>
                <li><a href="">屏東縣</a></li>
                <li><a href="">花蓮縣</a></li>
                <li><a href="">台東縣</a></li>
                <li><a href="">澎湖縣</a></li>
                <li><a href="">金門縣</a></li>
                <li><a href="">馬祖縣</a></li>
              
            </ul>
        </div>

    </div>


    <section class="filter-select">

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
    </section>



    <h2>旅行趣</h2>

  
    <div class="first-card">
        <a class="card-click" href="./attinsidepage.php?sig_no=<?=$prodRowf['sig_no']?>">
            <div class="pic">
                <img src="./images/sight/<?=$prodRowf["spt_pt"]?>">
            </div>
            <div class="first-card-content">
                
                <h3><?=$prodRowf["sig_name"]?></h3>
                <div class="hashtag">
                    <span>#<?=$prodRowf["sig_type"]?></span>
                </div>
                <p> <?=$prodRowf["sig_intro"]?></p>
                
            </div>
        </a>
        <span id="joinsite-btn">
            <input class="addbutton" type="button" value="加入景點" onclick="">
        </span>    
    </div>

    
    <div class="card-container">
        <?php 
            
            while($prodRow = $products->fetch(PDO::FETCH_ASSOC)){
                if($prodRow["sig_no"]==$r){
                    continue;
            }else{
        ?>
            <div class="card">
                <a href="./attinsidepage.php?sig_no=<?=$prodRow['sig_no']?>">
                    <div class="pic">
                        <img src="./images/sight/<?=$prodRow["spt_pt"]?>">
                    </div>
                    <div class="content">

                        <h3><?=$prodRow["sig_name"]?></h3>
                        <div class="hashtag">
                            <span>#<?=$prodRow["sig_type"]?></span>
                        </div>
                        <p>
                        <?=$prodRow["sig_intro"]?>
                        </p>
        
                    </div>
                </a>
                <span id="joinsite-btn"><input class="addbutton" type="button" value="加入景點" onclick=""></span>
            </div>
        <?php
                }  
            }
        ?>	
    </div>

    
        <div class="cart" id="cart">
            <div class="cart-list">
                
                <!-- <div class="item">
                    <img src="./images/sight/tamsui02.jpg" alt="">
                    <p>淡水老街</p>
                </div>
                <div class="item">
                    <img src="./images/sight/houtong02.jpg" alt="">
                    <p>猴硐貓村</p>
                </div>
                <div class="item">
                    <img src="./images/sight/Neiwan01.jpg" alt="">
                    <p>內灣老街</p>
                </div>
                <div class="item">
                    <img src="./images/sight/greencorridor02.jpg" alt="">
                    <p>綠園道</p>
                </div>
                <div class="item">
                    <img src="./images/sight/YiZhong02.jpg" alt="">
                    <p>一中商圈</p>
                </div> -->
            </div>
            <div class="sure"><input class="confirm-button" type="button" value="確定" onclick=""></div>
    
            <input type="button" value=" < " class="move-out-button" id="moveOutButton">
    
        </div>

        
        <section class="page">
            <button class="prev">上一頁</button>
            <button class="pageNo">1</button>
            <button class="pageNo">2</button>
            <button class="pageNo">3</button>
            <span>...</span>
            <button class="pageNo">10</button>
            <button class="next">下一頁</button>
        </section>

        <script src="./js/loginLightbox.js"></script>
        @@include('../../layout/footer.html')


</body>
</html>