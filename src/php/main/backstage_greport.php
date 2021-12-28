<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from gro_report gr join igroup ig on gr.gro_id = ig.gro_id";
        $greport= $pdo -> query($sql);
        $greportRow = $greport -> fetchAll(PDO::FETCH_BOTH) ;
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
       "title" : "活動檢舉管理"
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
                    <th>開團名稱</th>
                    <th>檢舉理由</th>
                    <th>檢舉時間</th>
                    <th>處理狀態</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($greportRow as $key => $grdatas){
                        if ($grdatas["greport_status"]==0) {
                ?>
                <tr data-status="no_cope_with">
                    <td><?=$grdatas["greport_no"]?></td>
                    <td><?=$grdatas["gro_name"]?></td>
                    <td class="reason"><?=$grdatas["greport_reason"]?></td>
                    <td><?=$grdatas["greport_time"]?></td>
                    <td>未處理</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php
                        }
                        if ($grdatas["greport_status"]==1) {
                ?>
                <tr data-status="success">
                    <td><?=$grdatas["greport_no"]?></td>
                    <td><?=$grdatas["gro_name"]?></td>
                    <td class="reason"><?=$grdatas["greport_reason"]?></td>
                    <td><?=$grdatas["greport_time"]?></td>
                    <td>通過</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php   
                        }
                        if ($grdatas["greport_status"]==2) {
                ?>
                <tr data-status="unsuccess">
                <td><?=$grdatas["greport_no"]?></td>
                    <td><?=$grdatas["gro_name"]?></td>
                    <td class="reason"><?=$grdatas["greport_reason"]?></td>
                    <td><?=$grdatas["greport_time"]?></td>
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
            </tbody>
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
                    <label for="context">活動名稱</label>
                    <div class="link">
                        <p id="context">吃喝玩樂樣樣都有，離市區又近的國家公園。四季皆宜的踏青好去處，賞櫻花、梅花、賞楓…四季都有花朵綻放，也可看火山地質結構，草原景緻、湖泊、生態池，還是農場採海芋、繡球花，吃放山雞、野菜、地瓜湯都有。</p>
                        <a href="#" id="link" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                    </div>
                  </div>
                  <div class="input-block">
                    <label for="reason">檢舉原因</label>
                    <p id="reason">	我看著貼文不爽</p>
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
<script src="./js/backstage_form_greport.js"></script>
</body>