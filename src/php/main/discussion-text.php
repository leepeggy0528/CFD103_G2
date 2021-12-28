<?php 
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	
	//執行sql指令並取得貼文資料
  $sql = "select *,count(p.post_no) as msg ,mem_name,mem_pt
  from post p  left join post_mes pm on p.post_no = pm.post_no
      join member m on pm.mem_id=m.mem_id
  group by p.post_no having p.post_no = :pno;";
	  $product = $pdo->prepare($sql);

	  $product->bindValue(":pno", $_GET["pno"]);
	  $product->execute();
    $prodRow = $product->fetch(PDO::FETCH_ASSOC);

    //取得圖片
    $sqlpt = "select ppt_pt
    from post p join post_pt pp on p.post_no = pp.post_no
    where p.post_no = ?;";
	  $products = $pdo->prepare($sqlpt);

	  $products->bindValue(1, $_GET["pno"]);
	  $products->execute();
    $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);

    //取留言
    $sqlmsg = "select pm.pmes_context, m.mem_name, pm.pmes_time,mem_pt
    from post_mes pm right join post p on p.post_no = pm.post_no
            join member m on pm.mem_id=m.mem_id
    where p.post_no = ?;";
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
    <title>Document</title>
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
    <div class="title"><h1><?=$prodRow["post_title"];?></h1></div>


    <div class="container">
      <div class="slider">
          <div class="owl-carousel owl-theme">
              <?php 
                foreach($prodRows as $i => $prodRows){
              ?>
              <div class="item">
              <img src="./images/discussion/<?=$prodRows["ppt_pt"];?>">
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
              <p><?=$prodRow["post_context"];?></p>
              </div>
  
              <div class="insta-item-tag">
                <p>#<?=$prodRow["post_type"];?></p>
              </div>
  
              <div class="comment-item">
                <i class="fas fa-comment-alt" style="color: #025A78;"></i>
                <p><?=$prodRow["msg"];?></p>
  
                <i class="fas fa-thumbs-up" style="color: #025A78;"></i>
                <p><?=$prodRow["post_like"];?></p>
  
                <i class="fas fa-fire" style="color: #025A78;"></i>
                <p><?=$prodRow["post_times"];?></p>
              </div>
                
                <div class="times">
                <p><?=$prodRow["post_time"];?></p>
                </div>
                
              <div class="warn-box">
                <input type="submit" class="warn-btn" value="檢舉"></button>
              </div>
          </div>


          <div class="section">
              <?php 
                foreach($prodRowss as $i => $prodRowss){
              ?>
                <li class="list">
                  <div class="insta-item-me">
                    <div class="pic_me">
                    <img src="./images/user/<?=$prodRowss["mem_pt"];?>">
                    </div>
                    <p class="me"><?=$prodRowss["mem_name"];?></p>
                    <p class="commend"><?=$prodRowss["pmes_context"];?></p>
                    <span class="time"><?=$prodRowss["pmes_time"];?></span>
                  </div>
                </li>
              <?php 
                }
              ?>

             
            <ul class="list-box">
            </ul>
              
          </div>


        <div class="insta-item-text">
        <textarea class="insta-item-text-i"  placeholder="在此輸入內容..." maxlength="60"></textarea>
        </div>

    
        <div class="insta-item-submit">
            <button class="btnBlue" type="submit">留言
            </button>
        </div>
  </div>

    <div class="screen">
        <div class="screen-wrapper">
          <div class="screen-form">
          <h2>檢舉</h2>
          <textarea class="group-text-i" maxlength="60" cols="40" rows="15" placeholder="請描述原因"></textarea>
          </div>

          <div class="Num">
          <span class="wordsNum">0/60</span>
          </div>

          <div class="insta-item-submit">
            <button class="btnYellow" type="submit">送出</button>
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
   
      var text = document.getElementsByClassName('insta-item-text-i').value;

        //留言功能
        //獲取元素
        var btn = document.querySelector('.insta-item-submit .btnBlue');
        var texts = document.querySelector('.insta-item-text .insta-item-text-i');
        var uls = document.querySelector('.list-box');
        //註冊時間
        btn.onclick = function(){
            if(texts.value == ''){
                alert("您沒有輸入內容。")
                return false;
            }else{
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
                img.src="./images/user/m01.jpg";
                divss.appendChild(img);
                
                var p = document.createElement('p');
                divs.appendChild(p);
                p.classList.add("me");
                p.innerText = "黃曉明";

                var ps = document.createElement('p');
                divs.appendChild(ps);
                ps.classList.add("commend");
                ps.innerText = texts.value;

                var spans = document.createElement('span');
                divs.appendChild(spans);
                spans.classList.add("time");

                let now = new Date()
                spans.innerText =(now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+ now.getMinutes()+':'+ now.getSeconds());
            }
            texts.value='';
        }
      </script>

  
    <script src="./js/loginLightbox.js"></script>
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
        var btnYellow = document.querySelector(".insta-item-submit .btnYellow");
      btnYellow.onclick = function () {
      alert("確定送出嗎?");
      location.href = "./discussion-2.html";
      };
        </script>   
@@include('../../layout/footer.html')
</body>
</html>