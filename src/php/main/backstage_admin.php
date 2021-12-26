<?php
     try {
         require_once('./php/connectAccount.php');
         //require_once('../connectAccount.php');
        $sql = "select * from admin";
        $admin= $pdo -> query($sql);
        $adminRow = $admin -> fetchAll(PDO::FETCH_BOTH) ;
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
       "title" : "管理員管理"
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
                    <th>管理員名稱</th>
                    <th>管理員ID</th>
                    <th>管理員密碼</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($adminRow as $key => $admin){
                ?>
                    <tr>
                        <td><?=$admin["admin_name"]?></td>
                        <td><?=$admin["admin_id"]?></td>
                        <td><?=$admin["admin_pswd"]?></td>
                        <td>
                            <ul class="action-list">
                                <li><a href="#" data-tip="edit" class="edit"><i class="fa fa-edit"></i></a></li>
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
                        <input type="button" class="btnYellow btn " id="new" value="新增管理員">
                    </th>
                </tr>
            </tfoot>
        </table>
        <div id="edit_form" style="display: none;">
                    <form class="signup">
                        <fieldset>
                            <h2>編輯管理員</h2>
                            <div class="input-block">
                                <label for="edit-id">ID</label>
                                <input id="edit-id" type="text" disabled>
                            </div>
                            <div class="input-block">
                                <label for="edit-name">Name</label>
                                <input id="edit-name" type="text" required>
                            </div>
                            <div class="input-block">
                                <label for="edit-pswd">Password</label>
                                <input id="edit-pswd" type="text" required>
                            </div>
                        </fieldset>
                        <div class="form_btn">
                            <button type="button" class="btnYellow btn " id="edit_submit">確認</button>
                            <input type="reset" class="btnWhite btn" id="edit_cancel" value="取消">
                        </div>
                    </form>
        </div>
    </section>
    <div id="add" style="display: none;">
        <form class="signup">
            <fieldset>
                <h2>新增管理員</h2>
              <div class="input-block">
                <label for="sp-name">Name</label>
                <input id="sp-name" type="text" required>
              </div>
              <div class="input-block">
                <label for="sp-id">ID</label>
                <input id="sp-id" type="text" required>
              </div>
              <div class="input-block">
                <label for="sp-pswd">Password</label>
                <input id="sp-pswd" type="password" required>
              </div>
              <div class="input-block">
                <label for="sp-pswd-cm">Confirm password</label>
                <input id="sp-pswd-cm" type="password" required>
              </div>
            </fieldset>
            <div class="form_btn">
                <button type="button" class="btnYellow btn " id="submit">確認</button>
                <input type="reset" class="btnWhite btn" id="cancel" value="取消">
            </div>
          </form>
    </div>
</main>
<script src="./js/backstage_form_admin.js" async>
</script>
<script>
    function sendForm(){ 
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            signup = JSON.parse(xhr.responseText);
            if(signup.sp_id){
                alert("已有此帳戶");
            }else{
                location.href="./backstage_admin.php";
            }
        }
        if ($id("sp-pswd").value==$id("sp-pswd-cm").value) {
            xhr.open("post", "./php/backstage_signup.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            //將要送到後端的資料打包
            let signupData = {};
            signupData.sp_id= $id("sp-id").value;
            signupData.sp_pswd= $id("sp-pswd").value;
            signupData.sp_name= $id("sp-name").value;

            let data_info = `signup=${JSON.stringify(signupData)}`;
            xhr.send(data_info);
        }else{
            alert("請重新確認密碼");
        }
  }
    function searchForm(e){ 
        let edit=e.target;
        let editId=edit.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.innerText;
        $id('edit_form').style.display='';
        let xhr = new XMLHttpRequest();
        xhr.onload = function(){
            search = JSON.parse(xhr.responseText);
            $id("edit-id").value = search.sp_id;
            $id("edit-name").value = search.sp_name;
            $id("edit-pswd").value = search.sp_pswd;
        }
            xhr.open("post", "./php/backstage_searchadmin.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            //將要送到後端的資料打包
            let searchData = {};
            searchData.sp_id=editId;
           
            let data_info = `search=${JSON.stringify(searchData)}`;
            console.log(data_info);
            xhr.send(data_info);
    }
    function updateForm(){ 
        $id('edit_form').style.display='';
        let xhr = new XMLHttpRequest();
            xhr.open("post", "./php/backstage_updataadmin.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            //將要送到後端的資料打包
            let updateData = {};
            updateData.sp_id= $id("edit-id").value;
            updateData.sp_pswd= $id("edit-pswd").value;
            updateData.sp_name= $id("edit-name").value;

            let data_info = `update=${JSON.stringify(updateData)}`;
            console.log(data_info);
            xhr.send(data_info);
            location.href="./backstage_admin.php";
    }
    function deleteDate(e){ 
        let deleted=e.target;
        let deletedId=deleted.parentNode.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.innerText;
        let xhr = new XMLHttpRequest();
            xhr.open("post", "./php/backstage_deleteadmin.php", true);
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            //將要送到後端的資料打包
            let deleteData = {};
            deleteData.sp_id=deletedId;
           
            let data_info = `delete=${JSON.stringify(deleteData)}`;
            console.log(data_info);
            xhr.send(data_info);
            location.href="./backstage_admin.php";
    }
</script>

</body>
</html>