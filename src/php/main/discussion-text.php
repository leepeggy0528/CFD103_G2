<?php 
ob_start();
session_start();
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	
	//執行sql指令並取得貼文資料
  $sql = "select *,count(p.post_no) as msg,p.post_no ,mem_name,mem_pt
  from post p left join post_mes pm on p.post_no = pm.post_no
  join member m on p.mem_id=m.mem_id
  group by p.post_no having p.post_no = :pno
  ORDER BY pm.pmes_time DESC;";
	  $product = $pdo->prepare($sql);

	  $product->bindValue(":pno", $_GET["pno"]);
	  $product->execute();
    $prodRow = $product->fetch(PDO::FETCH_ASSOC);

    //取得圖片
    $sqlpt = "select *
    from post p join post_pt pp on p.post_no = pp.post_no
    where p.post_no = ?;";
	  $products = $pdo->prepare($sqlpt);

	  $products->bindValue(1, $_GET["pno"]);
	  $products->execute();
    $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);

    //取留言
    $sqlmsg = "select pm.pmes_context, m.mem_name, pm.pmes_time,m.mem_pt
    from post_mes pm right join post p on p.post_no = pm.post_no
            join member m on pm.mem_id=m.mem_id
    where p.post_no = ? ORDER BY pm.pmes_time DESC;";
	  $productss = $pdo->prepare($sqlmsg);

	  $productss->bindValue(1, $_GET["pno"]);
	  $productss->execute();
    $prodRowss = $productss->fetchAll(PDO::FETCH_ASSOC);
	
} catch (Exception $e) {
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
    <link rel="icon" href="instagaher.ico">
    <title>討論趣-<?=$prodRows[0]["post_title"];?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/discussion-text.css">
    <script src="https://kit.fontawesome.com/657f3993c9.js" ></script>
    <link rel="stylesheet" href="./css/owl.carousel.min.css" >
    <link rel="stylesheet" href="./css/owl.theme.default.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/657f3993c9.js" crossorigin="anonymous"></script>

</head>

<body>
@@include('../../layout/login.html')
@@include('../../layout/header.html')
    <div class="title"><h1><?=$prodRows[0]["post_title"];?></h1></div>


    <div class="container">
      <div class="slider">
          <div class="owl-carousel owl-theme">
              <?php 
                foreach($prodRows as $i => $postRow){
              ?>
              <div class="item">
              <img src="./images/discussion/<?=$postRow["ppt_pt"];?>">
              </div>
              <?php 
                }
              ?>
          </div>
      </div>
    </div>

  <div class="insta-item">
  <div class="insta-item-i">
              <div class="insta-item-me">
              <img src="./images/user/<?=$prodRow["mem_pt"];?>">
              <p class="me"><?=$prodRow["mem_name"];?></p>
              </div>
  
              <div class="insta-item-text">
              <p><?=$prodRows[0]["post_context"];?></p>
              </div>
  
              <div class="insta-item-tag">
                <p>#<?=$prodRows[0]["post_type"];?></p>
              </div>
  
              <div class="comment-item">
                <i class="fas fa-comment-alt" style="color: #025A78;"></i>
                <p><?php //echo $prodRowss[0]["msg"];?></p>
  
                <i class="fas fa-thumbs-up" style="color: #025A78;"></i>
                <p><?=$prodRows[0]["post_like"];?></p>
  
                <i class="fas fa-fire" style="color: #025A78;"></i>
                <p><?=$prodRows[0]["post_times"];?></p>
              </div>
                
                <div class="times">
                <p><?=$prodRows[0]["post_time"];?></p>
                </div>
                
              <div class="warn-box">
                <input type="button" class="warn-btn" value="檢舉"></button>
              </div>
          </div>


          <div class="section">
              <?php 
              if ($productss->rowCount()==0) {
                echo "<p>暫無留言</p>";
              }else{
                foreach($prodRowss as $i => $postMsgRow){
              ?>
              <ul class="list-box">
              </ul>
                <li class="list">
                  <div class="insta-item-me">
                    <div class="pic_me">
                    <img src="./images/user/<?=$postMsgRow["mem_pt"];?>">
                    </div>
                    <p class="me"><?=$postMsgRow["mem_name"];?></p>
                    <p class="commend"><?=$postMsgRow["pmes_context"];?></p>
                    <span class="time"><?=$postMsgRow["pmes_time"];?></span>
                  </div>
                </li>
              <?php 
                  }
                }
              ?>


          </div>


        <div class="insta-item-text">
        <textarea id="pmes_context" class="insta-item-text-i"  placeholder="在此輸入內容..." maxlength="60">
        </textarea>
        <!-- <input type="text" id="pmes_context" class="insta-item-text-i" > -->
        </div>
        <input type="text" name="memid" id="memid" hidden>

        <div class="insta-item-submit">
            <button class="btnBlue" type="button">留言
            </button>
        </div>
  </div>

    <div class="screen">
        <div class="screen-wrapper">
          <div class="screen-form">
          <h2>檢舉</h2>
          <textarea class="group-text-i" id="reportText" maxlength="60" cols="40" rows="15" placeholder="請描述原因"></textarea>
          </div>

          <div class="Num">
          <span class="wordsNum">0/60</span>
          </div>

          <div class="insta-item-submit">
            <button class="btnYellow" type="button">送出</button>
          </div>

          <div class="leave-btn">
            <button class="leave">X</button>
          </div>

        </div>
    </div>

      <script src="./js/jquery-3.6.0.min.js"></script>
      <script>
      
      $('body').on('click','.warn-btn',function(){
        $('.screen').css('display','block')
      });

      $('body').on('click','.leave',function(){
        $('.screen').css('display','none')
      });

      $('body').on('click','.btnYellow',function(){
        $('.screen').css('display','none')
      });

      let textMax = 60;	
      $('.wordsNum').html(`${textMax}/60`);
      $('.group-text-i',).keyup(function(){
        let textLength = $(this).val().length;
        $('.wordsNum').html(`${textMax-textLength}/60`);
      });  

      let textMaxs = 60;		
      $('.wordsNum').html(`${textMaxs}/60`);
      $('.insta-item-text-i',).keyup(function(){
        let textLengths = $(this).val().length;
        $('.wordsNum').html(`${textMaxs-textLengths}/60`);
      });  
   
      // var text = document.getElementsByClassName('insta-item-text-i').value;

        //留言功能
        let pno = <?php echo $_GET["pno"]?>;
        //獲取元素
        var btn = document.querySelector('.insta-item-submit .btnBlue');
        var texts = document.querySelector('.insta-item-text .insta-item-text-i');
        var uls = document.querySelector('.list-box');
        //註冊時間
        btn.onclick = function(){
          console.log(1111, texts);
            if(texts.value == ''){
                alert("您沒有輸入內容。")
                return false;
            }else{
                //if succes then append Element into html
                //--------create new post div------------
                let xhr1 = new XMLHttpRequest();
                xhr1.onload = function(){
                member = JSON.parse(xhr1.responseText);

                console.log('22222222222');
                console.log(document.getElementById("pmes_context"));             

                var list = document.createElement('li');
                uls.appendChild(list);
                uls.insertBefore(list,uls.children[0]);
                list.classList.add("list");

                var divs = document.createElement('div');
                list.appendChild(divs);
                divs.classList.add("insta-item-me");

                var divss = document.createElement('div');
                divs.appendChild(divss);
                divss.classList.add("pic_me");
    
                var img = new Image();
                img.src=`./images/user/${member.mem_pt}`;
                divss.appendChild(img);
                
                var p = document.createElement('p');
                divs.appendChild(p);
                p.classList.add("me");
                p.innerText = member.mem_name;

                var ps = document.createElement('p');
                divs.appendChild(ps);
                ps.classList.add("commend");
                ps.innerText = texts.value;
                // var pmes_context = texts.value;

                var spans = document.createElement('span');
                divs.appendChild(spans);
                spans.classList.add("time");

                let now = new Date()
                spans.innerText =(now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+ now.getMinutes()+':'+ now.getSeconds());

                
                let xhr = new XMLHttpRequest();
                xhr.open("post", "./php/addPostmember.php", true);
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
                console.log('------------');
                console.log(document.getElementById("pmes_context"));
                $id("memid").value=member.mem_id;

                let data_info = "pmes_context="+document.getElementById("pmes_context").value + "&pno="+pno+"&memid="+member.mem_id;
                console.log(data_info);
                xhr.send(data_info);
                
                texts.value='';
                } 
                xhr1.open("get", "./php/getMemberInfo.php", true);
                xhr1.send(null);
              }
        }

        //檢舉
        var btnYellow = document.querySelector(".insta-item-submit .btnYellow");
        btnYellow.onclick = function () {
          let post_id = location.href.split('?')[1];
          console.log(post_id);
          let reportText = document.getElementById("reportText").value;
          let xhr = new XMLHttpRequest();
          xhr.onload = function () {
              member = JSON.parse(xhr.responseText);
              console.log(member);
              if (member.mem_id) { //已登入
                  //取得會員名稱、頭貼
                  if (reportText == "") {
                      alert('原因不得空白');
                  } else {
                      let xhr1 = new XMLHttpRequest();

                      xhr1.open("Post", "./php/postReport.php", true);
                      xhr1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                      let data_info = post_id + `&mem_id=${member.mem_id}&status=1&content=` + reportText
                          + "&post_show=0";
                      console.log('data_info:', data_info);
                      xhr1.send(data_info);
                      document.querySelector(".screen-wrapper").style.display = "none";
                      reportText = "";
                      alert("確定送出嗎?");
                      alert("檢舉送出，審核中");
                      location.href = "./discussion-2.php";
                  }
            } else {
                alert("請先登入")
            }
          }
          xhr.open("get", "./php/getMemberInfo.php", true);
          xhr.send(null);

        }
      </script>

  
    <script src="./js/loginLightbox.js" asyn></script>
   <script src="./js/owl.carousel.min.js"></script>
   <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel();
        });
    
        var owl = $('.owl-carousel');
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
    
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1024: {
                    items: 1,
                    stagePadding: 250,
                }
            }
        });
        $('.play').on('click', function () {
            owl.trigger('play.owl.autoplay', [5000])
        });
        $('.stop').on('click', function () {
            owl.trigger('stop.owl.autoplay')
        });
        </script>   
@@include('../../layout/footer.html')
</body>
</html>