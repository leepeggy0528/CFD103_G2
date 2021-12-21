<!DOCTYPE html>
<html lang="zh-hant-tw">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <meta name="description" content="">

   <link rel="icon" href="">
   <script src="../js/jquery-3.6.0.min.js"></script>
   @@include('../layout/backstage_meta.html',{
       "title" : "管理員管理"
   }) 
</head>
<body>
    @@include('../layout/backstage_header.html')
<main>
    @@include('../layout/backstage_nav.html')
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
                <tr data-status="no_cope_with">
                    <td>9483001</td>
                    <td>八里左岸</td>
                    <td class="reason">我看著貼文不爽我看著貼文不爽我看著貼文不爽我看著貼文不爽我看著貼文不爽我看著貼文不爽我看著貼文不爽我看著貼文不爽</td>
                    <td>2021/12/5 10:00</td>
                    <td>未處理</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <tr data-status="no_cope_with">
                    <td>9483001</td>
                    <td>八里左岸</td>
                    <td class="reason">我看著貼文不爽</td>
                    <td>2021/12/5 10:00</td>
                    <td>未處理</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <tr data-status="success">
                    <td>9483002</td>
                    <td>LOVE</td>
                    <td class="reason">色情</td>
                    <td>2021/12/13 8:00</td>
                    <td>通過</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <tr data-status="no_cope_with">
                    <td>9483001</td>
                    <td>八里左岸</td>
                    <td class="reason">我看著貼文不爽</td>
                    <td>2021/12/5 10:00</td>
                    <td>未處理</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <tr data-status="unsuccess">
                    <td>9483001</td>
                    <td>八里左岸</td>
                    <td class="reason">我看著貼文不爽</td>
                    <td>2021/12/5 10:00</td>
                    <td>不通過</td>
                    <td>
                        <ul class="action-list">
                            <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                        </ul>
                    </td>
                </tr>
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
</main>
<script src="../js/backstage.js"></script>
</body>
</html>