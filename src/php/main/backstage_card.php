<?php
try{
  require_once("./php/connectAccount.php");

    //card
    $sql_card = "select * from card_style;"; 
    $cards = $pdo->query($sql_card);
    
    //sticker
    $sql_sticker = "select * from stamp_style;"; 
    $stickers = $pdo->query($sql_sticker);
    
}catch(PDOException $e){
    echo $e->getMessage();
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
       "title" : "管理員管理"
   }) 
</head>
<body>
    @@include('../../layout/backstage_header.html')
<main>
    @@include('../../layout/backstage_nav.html')
    <section class="container pt-5" id="card">
        <h2 class="style">卡片樣式</h2>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-success btn-filter" data-target="up">上架</button>
                <button type="button" class="btn btn-danger btn-filter" data-target="down">下架
                </button>
                <button type="button" class="btn btn-default btn-filter" data-target="all">全部</button>
            </div>
        </div>
        <table class="table table-choose table-bordered table-definition mb-5">
            <thead class="table-warning ">
                <tr>
                    <th>卡片編號</th>
                    <th>卡片樣式</th>
                    <th>卡片名稱</th>
                    <th>卡片狀態</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($cardRows = $cards->fetch(PDO::FETCH_ASSOC)){
                        if($cardRows['cstyle_status']==0){        
                ?>
                <tr data-status="up">
                    <td><?=$cardRows['cstyle_no']?></td>
                    <td><div class="card"><img src="./images/card/<?=$cardRows['cstyle_pt']?>" alt="<?=$cardRows['cstyle_name']?>"></div></td>
                    <td><?=$cardRows['cstyle_name']?></td>
                    <td><label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked>
                        <span class="custom-control-indicator"></span>
                    </label></td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                            <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>

                <?php
                        }else{
                ?>
                <tr data-status="down">
                    <td><?=$cardRows['cstyle_no']?></td>
                    <td><div class="card"><img src="./images/card/<?=$cardRows['cstyle_pt']?>" alt="<?=$cardRows['cstyle_name']?>"></div></td>
                    <td><?=$cardRows['cstyle_name']?></td>
                    <td><label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label></td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                            <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>      
                <?php       
                        }
                    }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="12">
                        <input type="button" class="btnYellow btn btn-l" id="new" value="新增樣式">
                        <input type="button" class="btnYellow btn " value="確認修改">
                        <input type="reset" class="btnWhite btn" value="取消修改">
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
        <!-- add card lightnbox -->
        <div id="add" style="display: none;">
            <form class="signup scard" method="post" action="#" enctype="multipart/form-data">
                <h2>新增卡片</h2>
                <fieldset>
                  <div class="input-block">
                    <label for="cd-name">卡片名稱</label>
                    <input name="cd-name" type="text" required>
                  </div>
                  <div class="input-block">
                    <label for="type">類別</label>
                    <select name="type">
                        <option value="0">上架</option>
                        <option value="1">下架</option>
                    </select>
                  </div>
                </fieldset>
                <div class="input-block">
                    <label for="upCard">照片</label>
                    <input type="file" name="upFile" id="upCard"><br>
                    <div class="scroll">
                        <div class="pt">
                            <img src="#" id="preview" hidden>
                        </div>
                    </div>
                </div>
                <div class="form_btn">
                    <button type="button" class="btnYellow btn " id="addCardBtn">確認</button>
                    <input type="reset" class="btnWhite btn" id="cancel" value="取消">
                </div>
              </form>
        </div>
    </section>
    <section class="container pt-5" id="stick">
        <h2 class="style">貼紙樣式</h2>

        <table class="table table-bordered table-definition mb-5">
            <thead class="table-warning ">
                <tr>
                    <th>貼紙編號</th>
                    <th>貼紙樣式</th>
                    <th>貼紙名稱</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($stickerRows = $stickers->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr class="cardRow">
                    <td><?=$stickerRows['sstyle_no']?></td>
                    <td><div class="card"><img src="./images/sticker/<?=$stickerRows['sstyle_pt']?>" alt="<?=$stickerRows['sstyle_name']?>"></div></td>
                    <td><?=$stickerRows['sstyle_name']?></td>

                    <td>
                        <ul class="action-list">
                            <li><i class="fa fa-edit"></i></li>
                            <li><i class="fa fa-trash"></i></li>
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
                        <input type="button" class="btnYellow btn btn-l" id="new1" value="新增貼紙">
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
        <!-- add sticker lightbox -->
        <div id="sadd" style="display: none;">
            <form class="signup scard stick" method="post" id='stickerForm' enctype="multipart/form-data">
                <h2>新增貼紙</h2>
                <fieldset>
                  <div class="input-block">
                    <label for="stickerName">貼紙名稱</label>
                    <input name="stickerName" id="stickerName" type="text" required>
                  </div>
             
                </fieldset>
                <div class="input-block">
                    <label for="upSticker">照片</label>
                    <input type="file" name="upFile1" id="upSticker"><br>
                    <div class="pt">
                        <img src="#" id="preview1" hidden>
                    </div>
                </div>
                <div class="form_btn">
                    <button type="button" class="btnYellow btn " id="addStickerBtn">確認</button>
                    <input type="reset" class="btnWhite btn" id="cancel1" value="取消">
                </div>
              </form>
        </div>
    </section>
</main>
<script src="./js/backstage.js"></script>
<script src="./js/backstage_formpt.js">
</script>
</body>
</html>