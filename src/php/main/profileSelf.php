<?php 
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	// require_once("../connectAccount.php");

	//取回會員的資料
	$sql_member = "select *from igroup i join  member m on m.mem_id=i.mem_id
    join  gro_pt p on i.gro_id=p.gro_id group by m.mem_id having m.mem_id=:mem_id;";
    $memInfo = $pdo->prepare($sql_member);
    $memInfo->bindValue(":mem_id", $_GET["mem_id"]);
    $memInfo->execute();
	$memInfoRows = $memInfo->fetchAll(PDO::FETCH_ASSOC);

    //參團資料
    $sql_Join ="select i.gro_id,i.gro_name, i.gro_startd,i.gro_loc,i.gro_status, gpt_pt, p.partic_id from igroup i join partic p on i.gro_id= p.gro_id join gro_pt g on i.gro_id=g.gro_id where partic_id=:mem_id  group by gro_id order by gro_startd asc;";
    $joinInfo = $pdo->prepare($sql_Join);
    $joinInfo->bindValue(":mem_id", $_GET["mem_id"]);
    $joinInfo->execute();
    $joinInfoRows = $joinInfo->fetchAll(PDO::FETCH_ASSOC); 

    //我的收藏
    $sql_fav ="select i.gro_id,i.gro_name, i.gro_startd,i.gro_loc,i.gro_status, m.mem_id,g.gpt_pt from igroup i join mem_fav m on i.gro_id=m.gro_id join gro_pt  g on i.gro_id=g.gro_id where m.mem_id=:mem_id group by gro_id order by gro_startd asc;";
    $favInfo = $pdo->prepare($sql_fav);
    $favInfo->bindValue(":mem_id", $_GET["mem_id"]);
    $favInfo->execute();
 

    //我的發文
    $sql_post="select * , count(po.pmes_context) count from post p join member m on p.mem_id=m.mem_id 
    join hashtag h on p.has_nos=h.has_no join post_pt t on p.post_no=t.post_no join post_mes po on po.post_no=p.post_no where p.mem_id=:mem_id;";
    $myPost = $pdo->prepare($sql_post);
    $myPost->bindValue(":mem_id", $_GET["mem_id"]);
    $myPost->execute();
    $myPostRows = $myPost->fetchAll(PDO::FETCH_ASSOC);

    //好友列表
    $sql_frd="select * from friend f join member m on m.mem_id=f.mem_id where friend_id=:mem_id;";
    $myfrd = $pdo->prepare($sql_frd);
    $myfrd->bindValue(":mem_id", $_GET["mem_id"]);
    $myfrd->execute();
    $myfrdRows = $myfrd->fetchAll(PDO::FETCH_ASSOC);

    //開團評價團員
    $sql_ratePart="select mem_name from partic p join igroup i on  p.gro_id=i.gro_id join member m on  partic_id=m.mem_id where i.mem_id=:mem_id;";
    $rateJoin = $pdo->prepare($sql_ratePart);
    $rateJoin->bindValue(":mem_id", $_GET["mem_id"]);
    $rateJoin->execute();
    $rateJoinRows = $rateJoin->fetchAll(PDO::FETCH_ASSOC);

    //黑名單
    $sql_block="select mem_name from block b join member m on b.block_id=m.mem_id where b.mem_id=:mem_id;";
    $blockList = $pdo->prepare($sql_block);
    $blockList->bindValue(":mem_id", $_GET["mem_id"]);
    $blockList->execute();
    $blockListRows = $blockList->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/profile-self.css">
    <link rel="stylesheet" href="./css/discussion.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    @@include('../../layout/login.html')
    @@include('../../layout/header.html')
    <div class="self-wrapper">
        <div class="check-info">
            <div class="profile-card">
                <div class="edit-wrapper">
                    <button class="edit">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
                <div class="self-pic">
                    <img src="./images/user/<?=$memInfoRows[0]["mem_pt"]?>" alt="">
                </div>
                <p class="name"><?=$memInfoRows[0]["mem_name"]?></p>
                <div class="purse">
                   <div class="diamond">
                       <img src="./images/icon/diamond1.png" alt="">
                       <span><?=$memInfoRows[0]["mem_dom"]?></span>
                    </div>
                    <div class="coin">
                        <img src="./images/icon/coin1.png" alt="">
                        <span><?=$memInfoRows[0]["mem_money"]?></span>
                   </div>
                </div>
                <div class="check-self"><a class="btnWhite" href="profileOut.php?mem_id=<?=$memInfoRows[0]["mem_id"]?>">查看個人頁面</a></div>
            </div>
           <ul class="main-tabs">
               <li class="tabs"><a class="tabs-for-a active" href="#self-infoone">發起的揪團</a></li>
               <li class="tabs"><a class="tabs-for-a" href="#self-infotwo">參加的活動</a></li>
               <li class="tabs"><a class="tabs-for-a" href="#self-infothree">收藏活動</a></li>
               <li class="tabs"><a class="tabs-for-a" href="#self-infofour">我的發文</a></li>
               <li class="tabs"><a class="tabs-for-a" href="#self-infofive">好友列表</a></li>
            </ul>
            <select id="myselection" class="selectMenuForCell">
                <option selected="selected" value="one"><a class="tabs-for-a active" >發起的揪團</a></option>
                <option value="two"><a class="tabs-for-a">參加的活動</a></option>
                <option value="three"><a class="tabs-for-a" >收藏活動</a></option>
                <option value="four"><a class="tabs-for-a" >我的發文</a></option>
                <option value="five"><a class="tabs-for-a" >好友列表</a></option> 
            </select>
        </div>
        <div class="Info-wrapper">
            <!-- 發起的揪團 -->
            <div id="self-infoone" class="self-info fade open">
                <div class="section-title">
                    <h2><span>發</span>起的揪團</h2>
                    <ul class="second-tabs">
                        <li class="all"><button class="showButton">全部</button></li>
                            <li class="inviting"><button class="showButton">揪團中</button></li>
                            <li class="ended"><button class="showButton">已結束</button></li>
                        </ul>
                    </div>
                    <p>揪團中</p>
                    <?php 
                        $ongoing=$memInfoRows[0]['gro_status'];
                        foreach($memInfoRows as $i =>$memInfoRow ){
                          if($ongoing == 2){
                    ?>
                    <div class="activity">
                        <div class="activity-part-one">
                            <div class="activity-pic"><img src="./images/group/<?=$memInfoRow["gpt_pt"]?>" alt=""></div>
                            <div class="activity-info">
                                <h4><?=$memInfoRow["gro_name"]?></h4>
                                <p><?=$memInfoRow["gro_startd"]?></p>
                                <p><?=$memInfoRow["gro_loc"]?>市</p>
                            </div>
                        </div>
                        <div class="activity-btn activity-like">
                            <button class="btnYellow">報名列表</button>
                            <a href="groupDetail.php?gro_id=<?=$memInfoRow['gro_id']?>"
                             class="activity-page">活動頁面</a>
                        </div>
                    </div>
                    <?php
                         };
                        };
                    ?>
                    <p>已結束</p>
                    <?php
                            foreach($memInfoRows as $i =>$memInfoRow ){
                                if($ongoing == 0 ||$ongoing == 1){
                    ?>
                        <div class="activity">
                            <div class="activity-part-one">
                                <div class="activity-pic"><img src="./images/group/<?=$memInfoRow["gpt_pt"]?>" alt=""></div>
                                <div class="activity-info">
                                    <h4><?=$memInfoRow["gro_name"]?></h4>
                                    <p><?=$memInfoRow["gro_startd"]?></p>
                                    <p><?=$memInfoRow["gro_loc"]?>市</p>
                                </div>
                            </div>
                            <div class="activity-btn activity-like">
                                <button class="btnYellow"id="ratingParts">評價團員</button>
                                <a href="groupDetail.php?gro_id=<?=$memInfoRow['gro_id']?>"
                             class="activity-page">活動頁面</a>
                            </div>
                        </div>
                    <?php
                        };
                     };
                    ?>    
                    <div id="layerRatingContainer">
                        <div class="ratingContainer">
                            <p class="activityName">報名列表 - 傍晚走走散步去</p>
                            <div class="wrapperForClose">
                                <button class="close-btn" id="closeRating">X</button>
                            </div>
                            <p class="ratingHost">評價團員</p>
                            
                            <table>
                                <thead class="titleBackground">
                                    <tr>
                                        <th>編號</th>
                                        <th>團員</th>
                                        <th>評分</th>
                                        <th>評論</th>
                                    </tr>
                                </thead>
                                <?php
                                    foreach($rateJoinRows as $i =>$rateJoinRow ){    
                                ?>
                                <tr class="ratingMemRow">
                                    <td><?=$i+1?></td>
                                    <td class="rater"><?=$rateJoinRow["mem_name"]?></td>
                                    <td class="star-widget-wrapper">
                                        <div class="star-widget">
                                            <input type="radio" name="rate-<?=$i?>" id="rate-5-<?=$i?>" value=5>
                                            <label for="rate-5-<?=$i?>" class="fas fa-star"></label>
                                            <input type="radio" name="rate-<?=$i?>" id="rate-4-<?=$i?>" value=4>
                                            <label for="rate-4-<?=$i?>" class="fas fa-star"></label>
                                            <input type="radio" name="rate-<?=$i?>" id="rate-3-<?=$i?>" value=3>
                                            <label for="rate-3-<?=$i?>" class="fas fa-star"></label>
                                            <input type="radio" name="rate-<?=$i?>" id="rate-2-<?=$i?>" value=2>
                                            <label for="rate-2-<?=$i?>" class="fas fa-star"></label>
                                            <input type="radio" name="rate-<?=$i?>" id="rate-1-<?=$i?>" value=1>
                                            <label for="rate-1-<?=$i?>" class="fas fa-star"></label>
                                        </div>
                                    </td>
                                    <td class="RatingMemTd">
                                        <form action="#" class="rating-form">
                                            <div class="rating-textarea">
                                                <textarea cols="30" rows="10" placeholder="評價此團員"></textarea>
                                            </div>
                                            <p class="countWords"><span id="count">0</span>/40</p>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                };
                                ?>
                            </table>
                            <div class="rating-btn">
                                <button type="submit">送出</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- 參加的揪團 -->
            <div id="self-infotwo" class="self-info fade">
                <div class="section-title">
                    <h2><span>參</span>加的活動</h2>
                    <ul class="second-tabs">
                        <li class="all"><button>全部</button></li>
                        <li class="inviting"><button>揪團中</button></li>
                        <li class="ended"><button>已結束</button></li>
                    </ul>
                </div>    
                    <p>揪團中</p>
                    <?php
                        foreach($joinInfoRows as $i =>$joinInfoRow){
                          if($joinInfoRow['gro_status'] == 2){
                    ?>
                    <div class="activity">
                        <div class="activity-part-one">
                            <div class="activity-pic"><img src="./images/group/<?=$joinInfoRow["gpt_pt"]?>" alt=""></div>
                            <div class="activity-info">
                                <h4><?=$joinInfoRow["gro_name"]?></h4>
                                <p><?=$joinInfoRow["gro_startd"]?></p>
                                <p><?=$joinInfoRow["gro_loc"]?>市</p>
                            </div>
                        </div>
                        <div class="activity-btn activity-like">
                            <button class="btnYellow">取消報名</button>
                            <a href="groupDetail.php?gro_id=<?=$joinInfoRow['gro_id']?>" class="activity-page">活動頁面</a>
                        </div>
                    </div>
                    <?php
                         };
                        };
                    ?>
                    <p>已結束</p>
                    <?php 
                            foreach($joinInfoRows as $i =>$joinInfoRow){
                                if($joinInfoRow['gro_status']  == 1 ||$joinInfoRow['gro_status']  == 0){
                    ?>
                        <div class="activity">
                            <div class="activity-part-one">
                                <div class="activity-pic"><img src="./images/group/<?=$joinInfoRow["gpt_pt"]?>" alt=""></div>
                                <div class="activity-info">
                                    <h4><?=$joinInfoRow["gro_name"]?></h4>
                                    <p><?=$joinInfoRow["gro_startd"]?></p>
                                    <p><?=$joinInfoRow["gro_loc"]?>市</p>
                                </div>
                            </div>
                            <div class="activity-btn activity-like">
                                <button class="btnYellow" id="rateHost">評價活動</button>
                                <a href="groupDetail.php?gro_id=<?=$joinInfoRow['gro_id']?>" class="activity-page">活動頁面</a>
                            </div>
                            <div id="layerRatingHost">
                                <div class="ratingContainerHost">
                                    <p class="activityName">報名列表 - 傍晚走走散步去</p>
                                    <div class="wrapperForClose">
                                        <button class="close-btn" id="close-host">X</button>
                                    </div>
                                    <p class="ratingHost">評價團主</p>
                                    <div class="star-widget-host">
                                        <input type="radio" name="rate" id="rate-2-5-<?=$i?>" value=5>
                                        <label for="rate-2-5-<?=$i?>" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-2-4-<?=$i?>" value=4>
                                        <label for="rate-2-4-<?=$i?>" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-2-3-<?=$i?>" value=3>
                                        <label for="rate-2-3-<?=$i?>" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-2-2-<?=$i?>" value=2>
                                        <label for="rate-2-2-<?=$i?>" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-2-1-<?=$i?>" value=1>
                                        <label for="rate-2-1-<?=$i?>" class="fas fa-star"></label>
                                    </div>
                                        <form action="#" class="rating-form">
                                            <div class="rating-textarea rating-textarea-host">
                                                <textarea name="" id="<?php $i?>" cols="30" rows="10" placeholder="評價此團主"></textarea>
                                            </div>
                                            <p class="countWords">0/40</p>
                                        </form>
                                        <div class="rating-btn">
                                            <button type="submit">送出</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <?php
                          };
                        };
                    ?>
            </div>
            <!-- 收藏活動 -->
            <div id="self-infothree"class="self-info fade">
                <div class="section-title">
                    <h2><span>收</span>藏活動</h2>
                    <ul class="second-tabs">
                        <li class="all"><button class="showButton">全部</button></li>
                        <li class="inviting"><button class="showButton">揪團中</button></li>
                        <li class="ended"><button class="showButton">已結束</button></li>
                    </ul>
                </div>
                <p>揪團中</p>
                <?php
                   if($favInfo->rowCount() == 0){ //查無此書籍資料
                    echo "目前還沒加入任何活動喔!";
                   }else{ //若有滿足篩選條件的資料
                       $favInfoRows = $favInfo->fetchAll(PDO::FETCH_ASSOC);
                       $addfav=$favInfoRows[0]['gro_status'];
                        foreach($favInfoRows as $i =>$favInfoRow){
                          if($addfav == 2){
                        
                ?>
                    <div class="activity">
                        <div class="activity-part-one">
                            <div class="activity-pic"><img src="./images/group/<?=$favInfoRow["gpt_pt"]?>" alt=""></div>
                            <div class="activity-info">
                                <h4><?=$favInfoRow["gro_name"]?></h4>
                                <p><?=$favInfoRow["gro_startd"]?></p>
                                <p><?=$favInfoRow["gro_loc"]?>市</p>
                            </div>
                        </div>
                        <div class="activity-btn activity-like">
                            <button href="#" class="btnYellow">立即報名</button>
                            <a href="groupDetail.php?gro_id=<?=$favInfoRow['gro_id']?>" class="activity-page">活動頁面</a>
                        </div>
                    </div>
                <?php
                          };
                     };
                    };
                ?>
                <p>已結束</p> 
                <?php
                    if($favInfo->rowCount() == 0){
                        echo "目前還沒加入任何活動喔!";
                    }else{ //若有滿足篩選條件的資料
                        foreach($favInfoRows as $i =>$favInfoRow){
                            if($addfav == 1 ||$addfav == 0){
                ?>
                  <div class="activity">
                      <div class="activity-part-one">
                          <div class="activity-pic"><img src="./images/group/<?=$favInfoRow["gpt_pt"]?>" alt=""></div>
                          <div class="activity-info">
                              <h4><?=$favInfoRow["gro_name"]?></h4>
                              <p><?=$favInfoRow["gro_startd"]?></p>
                              <p><?=$favInfoRow["gro_loc"]?>市</p>
                            </div>
                        </div>
                        <div class="activity-btn activity-like">
                            <a href="groupDetail.php?gro_id=<?=$favInfoRow['gro_id']?>" class="activity-page">活動頁面</a>
                        </div>
                    </div>
                <?php
                      };
                     };
                    };
                ?>
            </div> 
             <!-- 我的發文 -->
            <div id="self-infofour" class="self-info fade">
                <h2><span>我</span>的發文</h2>
                <p class="article-time">2021年12月</p>
                <?php
                    foreach($myPostRows as $i =>$myPostRow){
                ?>
                <div class="insta-item-main-i">

                    <div class="box-i">
                        <div class="left-i">
    
                            <div class="pic">
                            <img src="./images/discussion/<?=$myPostRow["ppt_pt"]?>"
                            alt="">
                            </div>
    
                            <div class="me">
                            <img src="./images/user/<?=$myPostRow["mem_pt"]?>" alt="">
                            <p><?=$myPostRow["mem_name"]?></p>
                            </div>
                        </div>
    
                        <div class="center-i">
                            <span class="title"><h2><?=$myPostRow["post_title"]?></h2></span>
    
                            <p><?=$myPostRow["post_context"]?></p>
    
                            <div class="seemore">
                                <a href="discussion-text.php?pno=<?=$myPostRow["post_no"]?>">看更多</a>
                            </div>
    
                            <div class="tag">
                            <p>#<?=$myPostRow["has_name"]?></p>
                            </div>
                        </div>
                    </div>
                        <div class="box-i-2">
                            <ul class="right-i">
                                <li class="comment-item">
                                    <i class="fas fa-comment-alt" style="color: #025A78;"></i>
                                    <p><?=$myPostRow["count"]?></p>
                                </li>
                                <li class="comment-item">
                                    <i class="fas fa-thumbs-up" style="color: #025A78;"></i>
                                    <p><?=$myPostRow["post_like"]?></p>
                                </li>
    
                                <li class="comment-item">
                                    <i class="fas fa-fire" style="color: #025A78;"></i>
                                    <p><?=$myPostRow["post_times"]?></p>
                                </li>
                            </ul>
                            
                            <div class="date-time">
                            <p><?=$myPostRow["post_time"]?></p>
                            </div>  
                        </div>      
                </div>
                <?php
                };
                ?> 
            </div>
           <!-- 好友列表 -->
           <div id="self-infofive" class="self-info fade">
               <div class="friend-bar">
                   <h2 class="friend-title"><span>好</span>友列表</h2>
                   <div class="settingForBlack">
                       <button class="setting"><i class="fas fa-cog"></i></button>
                       <div class="blackList">
                         <button id="myBlackList" class="blackMemList">
                             黑名單列表
                          </button>
                       </div>
                       <div id="layerBlackContainer">
                           <div class="blackContainer">
                                <p class="activityName">黑名單列表</p>
                                <div class="wrapperForClose">
                                    <button class="close-btn" id="closeBlack">X</button>
                                </div>
                                <table>
                                    <thead class="titleBackground">
                                        <tr>
                                            <th>編號</th>
                                            <th>姓名</th>
                                            <th>移除黑名單</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        foreach($blockListRows as $i =>$blockListRow ){    
                                    ?>
                                    <tr class="ratingMemRow">
                                        <td><?=$i+1?></td>
                                        <td class="rater"><?=$blockListRow["mem_name"]?></td>
                                        <td>
                                        <button class=" btnYellow removeBlack">移除</button>
                                        </td>
                                    </tr>
                                    <?php
                                        };  
                                    ?>
                                </table>
                           </div>
                       </div>
                   </div>
                      <div class="search-friend">
                          <input type="text">
                          <button class="search-btn showButton">
                              <i class="fas fa-search" ></i>
                            </button>
                        </div>
                    </div>
                    <div id="app" class="friend-card-list article-time">
                    <?php
                            foreach($myfrdRows as $i =>$myfrdRow){
                            if($myfrdRow['mem_sex'] == 1){
                    ?>
                        <div class="show-card girl-card">
                            <div class="edit-wrapper">
                                <button class="edit friendControl showButton">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="friend-del-black">
                                    <button class="del-friend">刪除好友</button>
                                    <button class="blackList-friend">加入黑名單</button>
                                </div>
                            </div>
                            <div class="self-pic">
                                <img src="./images/user/<?=$myfrdRow["mem_pt"]?>" alt="">
                            </div>
                            <p class="name"><?=$myfrdRow["mem_name"]?></p>
                            <div class="interact">
                                <a href="profileOut.php?mem_id=<?=$myfrdRow["mem_id"]?>" class="edit edit-friend">
                                    <i class="far fa-user-circle"></i>
                                </a>
                                <a href="#" class="edit edit-friend">
                                    <i class="far fa-comment-dots"></i>
                                </a>
                                <a href="customized-card.php" class="edit edit-friend">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    <?php
                            }else{
                    ?>
                        <div class="show-card boy-card">
                            <div class="edit-wrapper">
                                <button class="edit friendControl showButton">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="friend-del-black">
                                    <button class="del-friend">刪除好友</button>
                                    <button class="blackList-friend">加入黑名單</button>
                                </div>
                            </div>
                            <div class="self-pic">
                                <img src="./images/user/<?=$myfrdRow["mem_pt"]?>" alt="">
                            </div>
                            <p class="name"><?=$myfrdRow["mem_name"]?></p>
                            <div class="interact">
                                <a href="profileOut.php?mem_id=<?=$myfrdRow["mem_id"]?>" class="edit edit-friend">
                                    <i class="far fa-user-circle"></i>
                                </a>
                                <a href="#" class="edit edit-friend">
                                    <i class="far fa-comment-dots"></i>
                               </a>
                                <a href="customized-card.php" class="edit edit-friend">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                            };
                        };
                        ?>
                    </div>
           </div>
        </div>
    </div>
@@include('../../layout/footer.html')
<script src="js/changeTabsForSelf.js"></script>
<script src='js/loginLightbox.js'></script>
<script src="js/dropdown.js"></script>
<script src="js/friendlisttoggle.js"></script>

</body>
</html>