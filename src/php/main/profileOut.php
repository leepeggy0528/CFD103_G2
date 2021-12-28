<?php 
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	// require_once("../connectAccount.php");

	//取回會員的資料
	$sql_member = "select *from igroup i join  member m on m.mem_id=i.mem_id
    join  gro_pt p on i.gro_id=p.gro_id group by m.mem_id having m.mem_id=9455003;";
    $memInfo = $pdo->query($sql_member);
	$memInfoRows = $memInfo->fetchAll(PDO::FETCH_ASSOC); //----------

    //計算會員生日
    $sql_birthday = "select mem_id, floor(datediff(now(), mem_birthday)/365) as age
    FROM member where mem_id=9455003;";
    $memBirthday=$pdo->query($sql_birthday);
	$memBirthdayRow = $memBirthday->fetch(PDO::FETCH_ASSOC);

    //計算揪團數
    $sql_hostNum = "select count(gro_id) as 'gro_num' from igroup where mem_id=9455003;";
    $memhostNum=$pdo->query($sql_hostNum);
	$memhostNumRow = $memhostNum->fetch(PDO::FETCH_ASSOC);

    //計算參團次數
    $sql_partNum ="select count(gro_id) as 'part_num' from partic where partic_id=9455003;";
    $memPartNum=$pdo->query($sql_partNum);
	$memPartNumRow = $memPartNum->fetch(PDO::FETCH_ASSOC);

    //計算朋友數
    $sql_frd_Num ="select count(friend_id) as 'frd_num' from friend where mem_id=9455003;";
    $memFrdNum=$pdo->query($sql_frd_Num);
	$memFrdNumRow = $memFrdNum->fetch(PDO::FETCH_ASSOC);

    //參團評分
    $sql_rate_join="select COALESCE(round(jmem_score/jmem_people),0) jrate from member where mem_id=9455003;";
    $rateJoin=$pdo->query($sql_rate_join);
	$rateJoinRow= $rateJoin->fetch(PDO::FETCH_ASSOC);

    //開團評分
    $sql_rate_host="select COALESCE(round(hmem_score/hmem_people),0) hrate from member where mem_id=9455003;";
    $rateHost=$pdo->query($sql_rate_host);
	$rateHostRow= $rateHost->fetch(PDO::FETCH_ASSOC);

    //開團評論
    $sql_HComment="select TIMESTAMPDIFF(Day, hrate_time, now()) time,hrate_time,hrate_score,hrate_context,mem_name,mem_loc, floor(datediff(now(), mem_birthday)/365) as age, mem_pt from host_rate h join member m on h.mem_id=m.mem_id where host_id=9455003;";
    $HComment=$pdo->query($sql_HComment);
	$HCommentRows= $HComment->fetchAll(PDO::FETCH_ASSOC);

    //參團評論
    $sql_JComment="select TIMESTAMPDIFF(Day, jrate_time, now()) time,jrate_time,jrate_score,jrate_context,mem_name,mem_loc, floor(datediff(now(), mem_birthday)/365) as age, mem_pt from join_rate j join member m on j.host_id=m.mem_id where j.join_id=9455003;";
    $JComment=$pdo->query($sql_JComment);
	$JCommentRows= $JComment->fetchAll(PDO::FETCH_ASSOC);
    
    //星星數開團
    
        $sql_host_comment="select hrate_score,count(mem_id) count from host_rate where host_id=9455003 group by hrate_score;";
        $hostComment = $pdo->query($sql_host_comment);
        $comment = [];
        while($rateHostCommentRow= $hostComment->fetch(PDO::FETCH_ASSOC)){
            $comment[$rateHostCommentRow["hrate_score"]]=$rateHostCommentRow["count"];
        }
        ;
        
    //星星數參團
        $sql_join_comment="select jrate_score,count(host_id) count from join_rate where join_id=9455003 group by jrate_score;";
        $joinComment = $pdo->query($sql_join_comment);
        $jcomment = [];
        while($joinCommentRow= $joinComment->fetch(PDO::FETCH_ASSOC)){
            $jcomment[$joinCommentRow["jrate_score"]]=$joinCommentRow["count"];
        }
        ;
}catch (Exception $e) {
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
    <title><?=$memInfoRows[0]["mem_name"]?></title>
    <link rel="stylesheet" href="./css/profile-out.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    
</head>
<body>
    
 <!-- 登入頁面    -->
<div id="layerForLogin">
    <div class="login-wrapper">
        <form class="login-form" method="post" action="./php/mem_login.php">
          <h1><img src="./images/photo/instagather logo.png" alt=""></h1>
          <div class="group">
            <input class="input" id="memMail" name="memMail"type="text" required="required"/>
            <label class="shrink">信箱</label>
          </div>
          <div class="group">
            <input class="input" id="memPsw" name="memPsw" type="password" required="required"/>
            <label class="shrink">密碼</label>
          </div>
            <div class="btn-box">
              <button id="closeLogin" class="btnBoredBlue cancel-btn" type="button">取消</button>
                <button id="submitLogin"class="btnYellow loggin-btn" type="button">登入</button>
            </div>
            <P>還沒有帳戶嗎?
                    <button id="signUpNow">立即註冊</button>
            </P>
        </form>
    </div>
</div>
<!-- 註冊頁面一 -->
<div id="layerForSignUp">  
  <div class="login-wrapper">
    <form class="login-form" >
      <h1 class="join">
        立即加入Instagather
      </h1> 
      <span class='joinPageGroup'>
        建立帳戶
      </span> 
      <div class="group first-group">
        <input class="input" type="text" required="required"/>
        <label class="shrink">信箱</label>
      </div>
      <div class="group">
        <input class="input" type="password" required="required"/>
        <label class="shrink">密碼</label>
      </div>
      <div class="group">
        <input class="input" type="password" required="required"/>
        <label class="shrink">確認密碼</label>
      </div>
        <div class="btn-box">
          <button id="returnLogin" class="btnBoredBlue" type="button">取消</button>   
            <button id="nextStep" class="btnYellow" type="submit">下一步</button>
        </div>
    </form>
  </div>
</div>
<!-- 註冊頁面二 -->
<div id="layerForSignUpTwo">  
  <div class="login-wrapper">
    <form class="login-form">
      <h1 class="join">編輯會員資料</h1> 
      <div class="drag-area">
        <button class="icon"><i class="fas fa-cloud-upload-alt"></i></button>
        <input class="profile-upload" type="file" hidden>
      </div>

      <span class='joinPageGroup'>個人資料</span> 
      <div class="group first-group">
        <input class="input" type="text" required="required"/>
        <label class="shrink">姓名</label>
      </div>
      <div class="gender-row">
        <div class="gender-group">
            <label class="gender-label" for="gender">性別</label>
            <select name="gender" class="gender">
                <option value="volvo">男</option>
                <option value="saab">女</option>
                <option value="mercedes">其他</option>
            </select>
        </div>
        <div class="birthday-group">
            <label>生日</label>
            <input class="birthday" type="date" required="required"/>
        </div>
      </div>
      <div class="group">
          <input class="input" type="password" required="required"/>
          <label class="shrink">居住地</label>
        </div>
        <!-- 興趣 -->
        <span class='joinPageGroup'>興趣</span>
        <div class="chooseHobby">
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 美食 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 夜市 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 學習 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 運動 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 休閒 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 購物 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 旅行 </label><br>
            </label>
            <label class="checkbox path">
                <input type="checkbox" class="hobby">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label for="hobby"> 燒腦 </label><br>
            </label>
        </div>
        <!-- 自我介紹 -->
        <div class="biography">
            <textarea name="bio" id="bio" cols="32" rows="5"></textarea>
            <label class="biography-label">個人介紹</label>
        </div>
        <div class="btn-box">
          <button class="btnBoredBlue" id="lastStep" type="button">上一步</button>   
          <button id="finished" class="btnYellow " type="submit">完成註冊</button>
      </div>
    </form>
</div>

</form>
</div>
</div>

 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<script src="./js/jquery-3.6.0.min.js"></script>
<header>
  
  <div class="logo">
    <a href="index.html"><img src="./images/logo.png" alt="" width="150px" height="75px"></a>
  </div>
  

  <nav>
    <ul>
      <li><a href="group.html">揪團趣</a></li>
      <li><a href="attractions.html">旅行趣</a></li>
      <li><a href="discussion-2.html">討論趣</a></li>
      <li><a href="hotleader_page.html">最HOT團主</a></li>
      <li><a href="customized-card.html">客製卡片</a></li>
      <li class="insta-i"><a href="holdparty_page.html">立即開團</a></li>

      <li class="insta-i"><a href="#">登入</a></li>
    </ul>
    <div class="menu-bars" id="toggle">
      <input type="checkbox">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <div class="insta-buttom">
      <a href="holdparty_page.html"><button class="insta-buttom-i">立即開團</button></a>
      <button Id="LoginBTN" class="insta-buttom-i-2">登入/註冊</button>
    </div>
      <!-- 登入過後 -->
    <div class="memMenu">
      <button class="afterLogin">
        <div class="loginmempic">
          <img src="./images/user/m01.jpg" alt="">
        </div>
        <span class="usernameLogin">王曉明</span>
        <i class="fas fa-sort-down"></i>
      </button>
      <div class="smallMemInfo">
        <div class="purseForHeader">
          <div class="diamond">
            <img src="./images/icon/diamond1.png" alt="">
            <span>500</span>
          </div>
          <div class="coin">
            <img src="./images/icon/coin1.png" alt="">
            <span>1500</span>
          </div>
        </div>
          <a class="memLink memfile" href="profileSelf.html">
            <img src="./images/icon/Group 478.svg" alt="">
          <span>個人檔案</span>
          </a>
          <button class="memLink" id="LogoutButton">
            <img src="./images/icon/Group 477.svg" alt="">
            <span>登出</span>
          </button>
      </div>
    </div>
  </nav>

  <script>
    const menuToggle= document.querySelector(".menu-bars");
    const nav = document.querySelector("nav ul");


    menuToggle.addEventListener("click", () => {
    nav.classList.toggle("slide");
    });
  </script>
  <script src="./js/friendtoggle.js"></script>
</header>
    <div class="out-wrapper">
            <div class="MyInfo">
                <div class="ContentInfo">
                  <h1 class="nameAndInfo">
                    <?=$memInfoRows[0]["mem_name"]?> <br>
                    <span class="location"><?=$memInfoRows[0]["mem_loc"]?>市</span>
                    <span class="age"><?=$memBirthdayRow["age"]?></span>
                  </h1>
                   <div class="friend-control">
                  <button id="blackList" class="btnWhite contact-link" href="#">
                    <i class="fas fa-ban">加黑名單</i>
                    </button> 
                    <button id="addFriend" class="btnYellow" href="#"> 
                        <i class="fas fa-user-plus">加好友</i>
                    </button> 
                  </div>
                </div>
                <div class="placeImage">
                  <div class="image" >
                  <img src="./images/user/<?=$memInfoRows[0]["mem_pt"]?>" >
                  </div>
                </div>
              </div>
            <ul class="more-info">
                <li class="tab-for-out">
                    <a href="#About-Me" class="aboutMe active">
                        <i class="fas fa-user-circle"></i>
                        關於我
                    </a>
                </li>
                <li class="tab-for-out">
                    <a href="#Groupnow" class="aboutMe">
                        <i class="fas fa-users"></i>
                        我的揪團
                    </a>
                </li>
                <li class="tab-for-out">
                    <a href="#Ratenow" class="aboutMe">
                        <i class="fas fa-star"></i>
                        評價
                    </a>
                </li>
            </ul>
            <!-- 關於我 -->
            <div id="About-Me" class=" change-forms fade open">
                <div class="main-background">
                    <div class="activity-nums">
                        <div class="statistics">
                            <p><?=$memhostNumRow["gro_num"]?> </p>
                            <p>揪團</p>
                        </div>
                        <div class="statistics">
                            <p><?=$memPartNumRow["part_num"]?></p>
                            <p>聚會</p>
                        </div>
                        <div class="statistics">
                            <p><?=$memFrdNumRow["frd_num"]?></p>
                            <p>朋友</p>
                        </div>
                    </div>
                    <div class="hobby-tags">
                    <script>
                        let i_textArr=["美食","夜市","學習","運動","休閒","燒腦","旅行","購物"];
                        let interest="<?= $memInfoRows[0]["mem_inter"];?>";
                        interest = interest.split("");
                        console.log(interest);
                        html="";
                        for(let i=0;i<interest.length;i++){
                            if(interest[i]==1){
                                Mem_interest=html+="<p>"+ i_textArr[i]+"</p>";
                                
                            }
                        }
                        document.write(Mem_interest);

                    </script>
                    </div>
                    <div class="introduction">
                        <?=$memInfoRows[0]["mem_discribe"]?>
                    </div>
                </div>
            </div>
            <!-- 我的揪團 -->
            <div id="Groupnow" class="my-groups change-forms fade">
                
                    <p class="joining-title">揪團中</p>
                    <?php
                        $ongoing=$memInfoRows[0]['gro_status'];
                        foreach($memInfoRows as $i =>$memInfoRow ){
                          if($ongoing == 2){
                    ?>
                            <a href="#">
                                <div class="ongoing">
                                    <div class="activity-pic">
                                        <img src="./images/group/<?=$memInfoRow["gpt_pt"]?>"  alt="">
                                    </div>
                                    <div class="activity-info">
                                        <h3><?=$memInfoRow["gro_name"]?></h3>
                                        <p>
                                        <?=$memInfoRow["gro_startd"]?> 
                                        </p>
                                        <p>
                                        報名人數：<?=$memInfoRow["gro_infnumber"]?>人開團，<?=$memInfoRow["gro_supnumber"]?>人滿團
                                        </p>
                                        <p class="deadline">
                                            截止日 ：<?=$memInfoRow["gro_endd"]?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                    <?php
                         };
                        };
                    ?>
                    <p class="joining-title">已結束</p>
                     <?php
                        foreach($memInfoRows as $i =>$memInfoRow ){
                            if($ongoing == 0 ||$ongoing == 1){
                    ?>
                         <a href="#">
                            <div class="ongoing">
                                    <div class="activity-pic">
                                        <img src="./images/group/<?=$memInfoRow["gpt_pt"]?>"  alt="">
                                    </div>
                                    <div class="activity-info">
                                        <h3><?=$memInfoRow["gro_name"]?></h3>
                                        <p>
                                        <?=$memInfoRow["gro_startd"]?> 
                                        </p>
                                        <p>
                                        報名人數：<?=$memInfoRow["gro_infnumber"]?>人開團，<?=$memInfoRow["gro_supnumber"]?>人滿團
                                        </p>
                                        <p class="deadline">
                                            截止日 ：<?=$memInfoRow["gro_endd"]?>
                                        </p>
                                    </div>
                                    <div class="finished">
                                    <div class="paint-back">
                                        <img src="./images/photo/paint.png" alt="">
                                        <div class="finished-text">已結束</div>
                                    </div>
                               </div>
                            </div>  
                         </a>
                    <?php
                         };
                     };
                    ?>                
            </div>
            <!-- 評價 -->
            <div id="Ratenow" class="my-groups change-forms fade">
                <ul class="RatingSection">
                    <li class="rating-tab">
                        <a href="#Hold-Rating" class="Ratings active">
                            開團評價
                        </a>
                    </li>
                    <li class="rating-tab">
                        <a href="#Join-Rating" class="Ratings">
                            參團評價
                        </a>
                    </li>
                </ul>
                <div id="Hold-Rating" class="change-rates fade open">
                  <div class="reveal">
                     <div class="lay-frame">
                        <div class="underlay opening-rating">
                            <div class="des-numbers"><?=$rateHostRow["hrate"]?>/5</div>
                            <div class="bars">
                                <?php

                                    for ($i=5; $i >=1; $i--) { 
                             
                                ?>
                                <div class="rating-stars">
                                    <span><?=$i?></span>
                                    <span class="star-icon"><i class="fas fa-star"></i></span>
                                    <span class="second-bar"></span>
                                       <span>( <?=(isset($comment[$i])==true?$comment[$i]:0);?> )</span>
                                </div>
                                <?php
                                    };
                                ?>
                            </div>
                       </div>
                     </div>
                   </div>
                    <div class="text-frame">
                        <div>
                            <div class="border-bottom"></div>
                        </div>
                    </div>   
                    <div class="lay-frame">
                        <div class="new-ratings-title">
                            <h3 class="new-ratings">最新評論</h3><span>(<?=count($HCommentRows,0)?>)</span>
                        </div>
                    </div>
                    <div class="text-frame">
                        <?php
                            foreach($HCommentRows as $i =>$HCommentRow){
                        ?>
                        <div class="comment-background">
                            <div class="comment-pics">
                                <img src="./images/user/<?=$HCommentRow["mem_pt"]?>"  alt="">
                            </div>
                            <div class="comment-per-info">
                                <div class="comment-name">
                                <?=$HCommentRow["mem_name"]?><br>
                                <?=$HCommentRow["mem_loc"]?> · <?=$HCommentRow["age"]?>
                                </div>
                                <div class="star-rating">
                                    <?php
                                    for($i=1;$i<=$HCommentRow["hrate_score"];$i++){
                                    ?>
                                    <i class="fas fa-star"></i>
                                    <?php
                                    };
                                    ?>
                                    <span><?=$HCommentRow["time"]?>天前</span>
                                </div>
                                <div class="comment-content">
                                    <?=$HCommentRow["hrate_context"]?>
                                </div>
                            </div>
                        </div>
                        <?php
                            };
                        ?>
                    </div>
                </div>
                <div id="Join-Rating" class="change-rates fade">
                    <div class="reveal">
                        <div class="lay-frame">
                        <div class="underlay opening-rating">
                            <div class="des-numbers">
                            <?=$rateJoinRow["jrate"]?>/5
                            </div>
                            <div class="bars">
                                <?php
                                    for ($i=5; $i >=1; $i--) { 
                                ?>
                                <div class="rating-stars">
                                    <span><?=$i?></span>
                                    <span class="star-icon"><i class="fas fa-star"></i></span>
                                    <span class="second-bar"></span>
                                       <span>( <?=(isset($jcomment[$i])==true?$jcomment[$i]:0);?> )</span>
                                </div>
                                <?php
                                    };
                                ?>
                            </div>
                        </div>
                        </div>
                        <div class="lay-frame">
                            <div class="new-ratings-title">
                                <h3 class="new-ratings">最新評論</h3><span>(<?=count($JCommentRows,0)?>)</span>
                            </div>
                        </div>
                        <div class="text-frame">
                        <?php
                            foreach($JCommentRows as $i =>$JCommentRow){
                        ?>
                            <div class="comment-background">
                                <div class="comment-pics">
                                    <img src="./images/user/<?=$JCommentRow["mem_pt"]?>"  alt="">
                                </div>
                                <div class="comment-per-info">
                                <div class="comment-name">
                                <?=$JCommentRow["mem_name"]?><br>
                                <?=$JCommentRow["mem_loc"]?> · <?=$JCommentRow["age"]?>
                                </div>
                                <div class="star-rating">
                                    <?php
                                        for($i=1;$i<=$JCommentRow["jrate_score"];$i++){
                                    ?>
                                        <i class="fas fa-star"></i>
                                    <?php
                                        };
                                    ?>
                                    <span><?=$JCommentRow["time"]?>天前</span>
                                </div>
                                <div class="comment-content">
                                <?=$JCommentRow["jrate_context"]?>
                                </div>
                                </div>
                            </div>
                        <?php
                          }
                        ?>   
                       </div>
                    </div>
               </div>
           </div>          
      </div> 
    </div>         
      <footer>

    <div class="text">
        <p>
        本網站為緯育TibaMe_前端設計工程師班第71期學員專題成果作品，本平台僅供學習、展示之用。若有抵觸有關著作權，或有第三人主張侵害智慧財產權等情事，均由學員負法律上責任，緯育公司概不負責。若有侵權疑慮，您可以私訊[緯育TibaMe]，後續會由專人協助處理。
        </p>
    </div>

    <div class="slogan">
        <p>Copyright © 2021 Instagether. All rights reserved.</p>
    </div>
</footer>
        <script src="js/loginLightbox.js"></script>
        <script src="js/changeTabsForOut.js"></script>
        <script src="js/RatingTabs.js"></script>
        

</body>
</html>