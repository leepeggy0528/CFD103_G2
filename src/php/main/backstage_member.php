<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from member";
        $member= $pdo -> query($sql);
        $memberRow = $member -> fetchAll(PDO::FETCH_BOTH) ;
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
   @@include('../../layout/backstage_meta.html',{
       "title" : "會員管理"
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
                    <th>會員編號</th>
                    <th>會員名稱</th>
                    <th>會員帳號</th>
                    <th>是否停權</th>
                </tr>
            </thead>
            <form action="#" method="post">
                <tbody>
                    <?php
                        foreach ($memberRow as $key => $member) {
                            if ($member["mem_suspend"]==0) {
                    ?>
                            <tr>
                                <td><?=$member["mem_id"]?></td>
                                <td><?=$member["mem_name"]?></td>
                                <td><?=$member["mem_mail"]?></td>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                    <?php
                            }else{   
                    ?>
                            <tr>
                                <td><?=$member["mem_id"]?></td>
                                <td><?=$member["mem_name"]?></td>
                                <td><?=$member["mem_mail"]?></td>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" checked>
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </form>
            <tfoot>
                <tr>
                    <th colspan="12">
                        <input type="submit" class="btnYellow btn " value="確認修改">
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
    </section>
</main>
</body>
</html>