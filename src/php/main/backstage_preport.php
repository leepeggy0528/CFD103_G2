<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from post_report pr join post p on pr.post_no = p.post_no";
        $preport= $pdo -> query($sql);
        $preportRow = $preport -> fetchAll(PDO::FETCH_BOTH) ;
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }
?>
<!DOCTYPE html>
<html lang="zh-hant-tw">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <meta name="description" content="">

   <link rel="icon" href="">
   <script src="./js/jquery-3.6.0.min.js"></script>
   @@include('../../layout/backstage_meta.html',{
       "title" : "貼文檢舉管理"
   }) 
</head>
<body>
    @@include('../../layout/backstage_header.html')
<main>
    @@include('../../layout/backstage_nav.html')
    <section class="container pt-5">
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn  btn-warning btn-filter" data-target="no_cope_with">未處理</button>
                <button type="button" class="btn btn-success btn-filter" data-target="success">通過</button>
                <button type="button" class="btn btn-danger btn-filter" data-target="unsuccess">未通過
                </button>
                <button type="button" class="btn btn-default btn-filter" data-target="all">全部</button>
            </div>
        </div>
        <table class="table table-choose table-bordered table-definition mb-5">
            <thead class="table-warning ">
                <tr>
                    <th>檢舉編號</th>
                    <th>貼文標題</th>
                    <th>檢舉理由</th>
                    <th>檢舉時間</th>
                    <th>處理狀態</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($preportRow as $key => $prdatas){
                        if ($prdatas["preport_status"]==0) {
                ?>
                    <tr data-status="no_cope_with">
                        <td><?=$prdatas["preport_no"]?></td>
                        <td><?=$prdatas["post_title"]?></td>
                        <td class="reason"><?=$prdatas["preport_reason"]?></td>
                        <td><?=$prdatas["preport_time"]?></td>
                        <td>未處理</td>
                        <td>
                            <ul class="action-list">
                                <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                <?php
                        }
                        if ($prdatas["preport_status"]==1) {
                ?>
                    <tr data-status="success">
                        <td><?=$prdatas["preport_no"]?></td>
                        <td><?=$prdatas["post_title"]?></td>
                        <td class="reason"><?=$prdatas["preport_reason"]?></td>
                        <td><?=$prdatas["preport_time"]?></td>
                        <td>通過</td>
                        <td>
                            <ul class="action-list">
                                <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                <?php   
                        }
                        if ($prdatas["preport_status"]==2) {
                ?>
                    <tr data-status="unsuccess">
                        <td><?=$prdatas["preport_no"]?></td>
                        <td><?=$prdatas["post_title"]?></td>
                        <td class="reason"><?=$prdatas["preport_reason"]?></td>
                        <td><?=$prdatas["preport_time"]?></td>
                        <td>不通過</td>
                        <td>
                            <ul class="action-list">
                                <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                <?php   
                        }
                    }
                ?>
        </table>
        <div class="pages">
            <nav aria-label="...">
                <ul class="pagination justify-content-end mt-3 mr-3">
                    <li>
                        <button class="pageBtn"  disabled>Previous</button>
                    </li>
                    <li>
                        <button class="noBtn">1</button>
                    </li>
                    <li>
                        <button class="noBtn">2</button>
                    </li>
                    <li>
                        <button class="noBtn">3</button>
                    </li>
                    <li>
                        <button class="pageBtn">Next</button>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <div id="edit_form" style="display: none;">
        <form class="signup report" method="post" action="#">
            <h2>審核貼文檢舉</h2>
            <fieldset class="section active">
                  <div class="input-block">
                    <label for="title">編號</label>
                    <p id="title">lalala</p>
                  </div>
                  <div class="input-block">
                    <label for="reason">檢舉原因</label>
                    <p id="reason">	我看著貼文不爽</p>
                  </div>
                  <div class="input-block">
                    <label for="context">貼文內容</label>
                    <p id="context">吃喝玩樂樣樣都有，離市區又近的國家公園。四季皆宜的踏青好去處，賞櫻花、梅花、賞楓…四季都有花朵綻放，也可看火山地質結構，草原景緻、湖泊、生態池，還是農場採海芋、繡球花，吃放山雞、野菜、地瓜湯都有。</p>
                  </div>
                  <div class="input-block">
                    <label for="ans">是否通過</label>
                    <div class="ans">
                        <input type="radio" id="yes" value="1" name="ans">
                        <label for="yes">
                            是
                        </label>
                        <input type="radio" id="no" value="2" name="ans">
                        <label for="no">
                            否
                        </label>
                    </div>
                  </div>
                <div class="form_btn">
                  <button type="button" class="btnYellow btn " id="submit">確 認</button>
                  <input type="reset" class="btnWhite btn" 
                  id="cancel" value="取消">
              </div>
          </fieldset>
          </form>
    </div>
</main>
<script src="./js/backstage.js"></script>
<script src="./js/backstage_form_preport.js"></script>
</body>
</html>