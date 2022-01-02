<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from sight";
        $sight= $pdo -> query($sql);
        $sightRow = $sight -> fetchAll(PDO::FETCH_BOTH) ;
        $sql1 = " select sig_no from sight order by sig_no desc limit 1";
        $sight1= $pdo -> query($sql1);
        $sightRow1 = $sight1 -> fetch(PDO::FETCH_BOTH) ;
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
       "title" : "景點管理"
   })
</head>
<body>
    @@include('../../layout/backstage_header.html')
<main>
    @@include('../../layout/backstage_nav.html')
    <section class="container pt-5">
        <table class="table table-bordered table-definition mb-5">
            <thead class="table-warning ">
                <tr>
                    <th>景點編號</th>
                    <th>景點名稱</th>
                    <th>景點地址</th>
                    <th>照片</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($sightRow as $key => $sight){
                ?>
                        <tr>
                            <td><?=$sight["sig_no"]?></td>
                            <td><?=$sight["sig_name"]?></td>
                            <td><?=$sight["sig_adress"]?></td>
                            <td><a href="#" data-tip="view" class="view"><i class="fa fa-search"></i></a></td>
                            <td>
                                <ul class="action-list">
                                    <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit "></i></a></li>
                                    <li><a href="#" data-tip="delete" class="delete"><i class="fa fa-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                 <tr class="sight_icon" style="display: none;">
                     <td><a href="#" data-tip="view" class="view"><i class="fa fa-search"></i></a></td>
                                     <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit "></i></a></li>
                            <li><a href="#" data-tip="delete" class="delete"><i class="fa fa-trash"></i></a></li>
                        </ul>
                                     </td>
                 </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="12">
                        <input id="new" type="button" class="btnYellow btn " value="新增景點">
                    </th>
                </tr>
            </tfoot>
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
    <div id="view" style="display: none;">
        <div id="fork">
            <i class="fas fa-times"></i>
        </div>
        <div class="card_demo" style="display: none;"><img src="#" alt=""></div>
        <div id="container-c">
        </div>
    </div>
    <div id="add" style="display: none;">
        <form class="signup sight" id="sight" action="./php/backstage_addsight.php" method="post"  enctype="multipart/form-data">
            <h2>新增景點</h2>
            <fieldset form="sight" class="section active">
                  <div class="input-block">
                    <label for="name">景點名稱</label>
                    <input id="add_name" name="name" type="text" required>
                  </div>
                  <div class="input-block">
                    <label for="address">地址</label>
                    <div class="sig_address">
                        <select name="loc" required id="loc">
                            <option value="" selected>選擇縣市</option>
                                <option value="台北市">台北市</option>
                                <option value="新北市">新北市</option>
                                <option value="桃園市">桃園市</option>
                                <option value="新竹市">新竹市</option>
                                <option value="新竹縣">新竹縣</option>
                                <option value="宜蘭縣">宜蘭縣</option>
                                <option value="基隆市">基隆市</option>
                                <option value="苗栗縣">苗栗縣</option>
                                <option value="台中市">台中市</option>
                                <option value="彰化縣">彰化縣</option>
                                <option value="南投縣">南投縣</option>
                                <option value="雲林縣">雲林縣</option>
                                <option value="嘉義縣">嘉義縣</option>
                                <option value="台南市">台南市</option>
                                <option value="高雄市">高雄市</option>
                                <option value="屏東縣">屏東縣</option>
                                <option value="花蓮縣">花蓮縣</option>
                                <option value="台東縣">台東縣</option>
                                <option value="澎湖縣">澎湖縣</option>
                                <option value="金門縣">金門縣</option>
                                <option value="馬祖縣">馬祖縣</option>
                        </select>
                        <input id="add_address" name="address" type="text" required>
                    </div>
                  </div>
                  <div class="tselect">
                      <div class="input-block">
                        <label for="type">類別</label>
                        <select name="type" required> 
                            <option value="" selected>請選擇類別</option>
                            <option value="旅行">旅行</option>
                            <option value="休閒">休閒</option>
                            <option value="購物">購物</option>
                            <option value="學習">學習</option>
                            <option value="夜市">夜市</option>
                            <option value="燒腦">燒腦</option>
                            <option value="運動">運動</option>
                            <option value="美食">美食</option>
                        </select>
                      </div>
                      <div class="input-block">
                        <label for="tel">電話</label>
                        <input name="tel" type="tel">
                      </div>
                  </div>
                  <div class="input-block">
                    <label for="web">官網</label>
                    <input name="web" type="url">
                  </div>
                  <div class="input-block">
                    <label for="time">營業時間</label>
                    <input name="time" type="text">
                  </div>
                  <div class="form_btn">
                    <button type="button" class="btnYellow btn next">下一步</button>
                    <input type="reset" class="btnWhite btn cancel1" id="cancel" value="取消">
                </div>
            </fieldset>
            <fieldset form="sight" class="section">
                  <div class="input-block">
                    <label for="intro">景點介紹</label>
                    <textarea name="intro" type="text" placeholder="限50字內" rows="3" cols="25" ></textarea>
                  </div>
                  <div class="input-block">
                    <label for="desc">景點描述</label>
                    <textarea name="desc" type="text" rows="8" cols="25" placeholder="限200字內"></textarea>
                  </div>
                  <div class="form_btn">
                    <button type="button" class="btnYellow btn next" >下一步</button>
                    <input type="reset" class="btnWhite btn cancel1" value="取消">
                </div>
            </fieldset>
            <fieldset form="sight" class="section">  
                <button id="btnAddPt"><i class="far  fa-plus-square"></i></button>
                <div class="input-block photo" style="display: none;">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile">
                        <i class="fas fa-minus-circle"></i>
                        <br>
                       <!--  <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div> -->
                    </div>
                <div class="scroll" id="sight_btn">
                    <div class="input-block photo">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile"><br>
                        <!-- <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div> -->
                    </div>
                </div>
                <input id='sig_no' type='text'value=<?=$sightRow1["sig_no"]+1?> hidden>
                <div class="form_btn">
                  <input type="submit" value="確認" class="btnYellow btn" id="submit">
                  <input type="reset" class="btnWhite btn cancel1" value="取消">
              </div>
           </fieldset>
        </form>
    </div>

    <div id="edit_form" style="display: none;">
        <form class="signup sight_edit" method="post" id="sight_edit" action="#">
            <h2>編輯景點</h2>
            <input type="text" name="sig_id" id="edit-id" hidden>
            <fieldset class="section active">
                  <div class="input-block">
                    <label for="name">景點名稱</label>
                    <input name="name" type="text" id="edit-name" required>
                  </div>
                  <div class="input-block">
                    <label for="address">地址</label>
                    <div class="sig_address">
                        <select name="loc" required id="edit-loc">
                                <option value="台北市">台北市</option>
                                <option value="新北市">新北市</option>
                                <option value="桃園市">桃園市</option>
                                <option value="新竹市">新竹市</option>
                                <option value="新竹縣">新竹縣</option>
                                <option value="宜蘭縣">宜蘭縣</option>
                                <option value="基隆市">基隆市</option>
                                <option value="苗栗縣">苗栗縣</option>
                                <option value="台中市">台中市</option>
                                <option value="彰化縣">彰化縣</option>
                                <option value="南投縣">南投縣</option>
                                <option value="雲林縣">雲林縣</option>
                                <option value="嘉義縣">嘉義縣</option>
                                <option value="台南市">台南市</option>
                                <option value="高雄市">高雄市</option>
                                <option value="屏東縣">屏東縣</option>
                                <option value="花蓮縣">花蓮縣</option>
                                <option value="台東縣">台東縣</option>
                                <option value="澎湖縣">澎湖縣</option>
                                <option value="金門縣">金門縣</option>
                                <option value="馬祖縣">馬祖縣</option>
                        </select>
                        <input id="edit-address" name="address" type="text" required>
                    </div>
                  </div>
                  <div class="tselect">
                      <div class="input-block">
                        <label for="type">類別</label>
                        <select id="edit-type" name="type">
                            <option value="旅行">旅行</option>
                            <option value="休閒">休閒</option>
                            <option value="購物">購物</option>
                            <option value="學習">學習</option>
                            <option value="夜市">夜市</option>
                            <option value="燒腦">燒腦</option>
                            <option value="運動">運動</option>
                            <option value="美食">美食</option>
                        </select>
                      </div>
                      <div class="input-block">
                        <label for="tel">電話</label>
                        <input name="tel" id="edit-tel" type="tel">
                      </div>
                  </div>
                  <div class="input-block">
                    <label for="web">官網</label>
                    <input name="web" id="edit-web" type="url">
                  </div>
                  <div class="input-block">
                    <label for="time">營業時間</label>
                    <input name="time"  id="edit-time" type="text">
                  </div>
                  <div class="form_btn">
                    <button type="button" class="btnYellow btn next">下一步</button>
                    <input type="reset" class="btnWhite btn edit_cancel" value="取消">
                </div>
            </fieldset>
            <fieldset class="section">
                  <div class="input-block">
                    <label for="intro">景點介紹</label>
                    <textarea name="intro" type="text" required  id="edit-intro" placeholder="限50字內" rows="3" cols="25" ></textarea>
                  </div>
                  <div class="input-block">
                    <label for="desc">景點描述</label>
                    <textarea id="edit-desc" name="desc" type="text" required rows="8" cols="25" placeholder="限200字內"></textarea>
                  </div>
                  <div class="form_btn">
                  <button type="button" class="btnYellow btn " id="edit_submit">確 認</button>
                  <input type="reset" class="btnWhite btn edit_cancel" value="取消" >
                </div>
            </fieldset>
          </form>
    </div>
    <script src="./js/backstage_pt.js" async></script>
    <script src="./js/backstage_form_sight.js" async></script>
</main>

</body>
</html>