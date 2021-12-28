<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from sight";
        $sight= $pdo -> query($sql);
        $sightRow = $sight -> fetchAll(PDO::FETCH_BOTH) ;
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
        <form class="signup sight" method="post" action="#">
            <h2>新增景點</h2>
            <fieldset class="section active">
                  <div class="input-block">
                    <label for="name">景點名稱</label>
                    <input name="name" type="text" required>
                  </div>
                  <div class="input-block">
                    <label for="address">地址</label>
                    <input name="address" type="text">
                  </div>
                  <div class="tselect">
                      <div class="input-block">
                        <label for="type">類別</label>
                        <select name="type">
                            <option value="" selected>請選擇類別</option>
                            <option value="1">旅行</option>
                            <option value="2">休閒</option>
                            <option value="3">購物</option>
                            <option value="4">學習</option>
                            <option value="5">夜市</option>
                            <option value="6">燒腦</option>
                            <option value="7">運動</option>
                            <option value="8">美食</option>
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
            <fieldset class="section">
                  <div class="input-block">
                    <label for="intro">景點介紹</label>
                    <textarea name="intro" type="text" required placeholder="限50字內" rows="2" cols="25" ></textarea>
                  </div>
                  <div class="input-block">
                    <label for="desc">景點描述</label>
                    <textarea name="desc" type="text" required rows="8" cols="25" placeholder="限200字內"></textarea>
                  </div>
                  <div class="form_btn">
                    <button type="button" class="btnYellow btn next" >下一步</button>
                    <input type="reset" class="btnWhite btn cancel1" value="取消">
                </div>
            </fieldset>
            <fieldset class="section">  
                <button id="btnAddPt"><i class="far  fa-plus-square"></i></button>
                <div class="input-block photo" style="display: none;">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile">
                        <i class="fas fa-minus-circle"></i>
                        <br>
                        <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div>
                    </div>
                <div class="scroll" id="sight_btn">
                    <div class="input-block photo">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile"><br>
                        <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div>
                    </div>
                </div>
                <div class="form_btn">
                  <button type="button" class="btnYellow btn " id="submit">確 認</button>
                  <input type="reset" class="btnWhite btn cancel1" value="取消">
              </div>
          </fieldset>
          </form>
    </div>
    <div id="edit_form" style="display: none;">
        <form class="signup sight" method="post" action="#">
            <h2>新增景點</h2>
            <fieldset class="section active">
                  <div class="input-block">
                    <label for="name">景點名稱</label>
                    <input name="name" type="text" required>
                  </div>
                  <div class="input-block">
                    <label for="address">地址</label>
                    <input name="address" type="text">
                  </div>
                  <div class="tselect">
                      <div class="input-block">
                        <label for="type">類別</label>
                        <select name="type">
                            <option value="" selected>請選擇類別</option>
                            <option value="1">旅行</option>
                            <option value="2">休閒</option>
                            <option value="3">購物</option>
                            <option value="4">學習</option>
                            <option value="5">夜市</option>
                            <option value="6">燒腦</option>
                            <option value="7">運動</option>
                            <option value="8">美食</option>
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
            <fieldset class="section">
                  <div class="input-block">
                    <label for="intro">景點介紹</label>
                    <textarea name="intro" type="text" required placeholder="限50字內" rows="2" cols="25" ></textarea>
                  </div>
                  <div class="input-block">
                    <label for="desc">景點描述</label>
                    <textarea name="desc" type="text" required rows="8" cols="25" placeholder="限200字內"></textarea>
                  </div>
                  <div class="form_btn">
                    <button type="button" class="btnYellow btn next" >下一步</button>
                    <input type="reset" class="btnWhite btn cancel1" value="取消">
                </div>
            </fieldset>
            <fieldset class="section">  
                <button id="btnAddPt"><i class="far  fa-plus-square"></i></button>
                <div class="input-block photo" style="display: none;">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile">
                        <i class="fas fa-minus-circle"></i>
                        <br>
                        <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div>
                    </div>
                <div class="scroll" id="sight_btn">
                    <div class="input-block photo">
                        <label for="upfile">照片</label>
                        <input type="file" name="upFile[]" class="upFile"><br>
                        <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div>
                    </div>
                </div>
                <div class="form_btn">
                  <button type="button" class="btnYellow btn " id="submit">確 認</button>
                  <input type="reset" class="btnWhite btn cancel1" value="取消">
              </div>
          </fieldset>
          </form>
    </div>
    <script src="./js/backstage_pt.js" async></script>
    <script src="./js/backstage_form_sight.js"></script>
</main>

</body>
</html>