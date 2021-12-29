<?php 
    try {
        //引入連線工作的檔案
        require_once("./php/connectAccount.php");
        //require_once("../connectAccount.php");

        //執行sql指令並取得pdoStatement
        $sql = "select * from sight s join sight_pt spt on s.sig_no=spt.sig_no where spt.sig_no=:sig_no and spt.spt_pt like('%02%');";
        $products = $pdo->prepare($sql);
        $products -> bindValue(":sig_no",$_GET["sig_no"]);
		$products -> execute();
		$prodRow = $products->fetch(PDO::FETCH_ASSOC);

        $sqlf = "select spt.spt_pt from sight s join sight_pt spt on s.sig_no=spt.sig_no where s.sig_no=? and spt.spt_pt not like('%02%') and spt.spt_pt not like('%01%');";
        $productsf = $pdo->prepare($sqlf);
        $productsf -> bindValue(1,$_GET["sig_no"]);
        $productsf -> execute();
        $prodRowfs = $productsf->fetchAll(PDO::FETCH_ASSOC);
        //取回所有的資料, 放在2維陣列中
    } catch (Exception $e) {
        echo "錯誤行號 : ", $e->getLine(), "<br>";
        echo "錯誤原因 : ", $e->getMessage(), "<br>";
        //echo "系統暫時不能正常運行，請稍後再試<br>";	
    }

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/attinsidepage.css">
	<link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="./js/jquery-3.6.0.min.js"></script>
	<script src="./js/cart.js"></script>
	<script src="./js/image.js" async></script>
	<title>淡水老街</title>

</head>

<body>
	
	@@include('../../layout/login.html')
	@@include('../../layout/header.html')

	<h2><?=$prodRow["sig_name"]?></h2>
	<div class="big-pic-container">
		<img id="large" src="./images/sight/<?=$prodRow["spt_pt"]?>">
	</div>
	<div class="small-pic-container">
	<?php
		foreach($prodRowfs as $key =>$prodRowf){
			
	?>
		<img src="./images/sight/<?=$prodRowf["spt_pt"]?>" />
	<?php
		}
	?>
	</div>
	
	<div class="container">
        <div class="slider">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="./images/sight/<?=$prodRow["spt_pt"]?>">
                </div>
				<?php
		foreach($prodRowfs as $key =>$prodRowf){
			
	?>
		<div class="item">
		<img src="./images/sight/<?=$prodRowf["spt_pt"]?>">
		</div>
	<?php
		}
	?>
            </div>
        </div>
    </div>
	
	<script>
		function showLarge(e) {
			let small = e.target;
			document.getElementById("large").src = small.src.replace("small-pic-container", "big-pic-container").replace("SP_", "");
		}

		function init() {
			let smalls = document.querySelectorAll(".small-pic-container img");
			for (let i = 0; i < smalls.length; i++) {
				smalls[i].onclick = showLarge;
			}
		}

		window.addEventListener("load", init, false);
	</script>


	<div class="containera">
		<div class="name">
			<h3><?=$prodRow["sig_name"]?></h3>
		</div>

		<p><?=$prodRow["sig_describe"]?></p>

		<div class="information">
			<p>電話 : <?=$prodRow["sig_phone"]?></p>
			<p>地址 : <?=$prodRow["sig_adress"]?></p>
			<p>營業時間 : <?=$prodRow["sig_time"]?></p>
			<p>官網 : <?=$prodRow["sig_web"]?></p>
		</div>

		<div class="joinsite"><input class="button" type="button" value="加入景點" onclick=""></div>
	</div>


	<div class="cart" id="cart">
		<div class="cart-list">
			<!-- <div class="item">
				<img src="./images/img/place01.jpg" alt="">
				<p>台北101</p>
			</div>
			<div class="item">
				<img src="./images/img/place02.jpg" alt="">
				<p>淡水老街</p>
			</div>
			<div class="item">
				<img src="./images/img/place03.jpg" alt="">
				<p>猴硐貓村</p>
			</div>
			<div class="item">
				<img src="./images/img/place04.jpg" alt="">
				<p>內灣老街</p>
			</div>
			<div class="item">
				<img src="./images/img/place05.jpg" alt="">
				<p>綠園道</p>
			</div>
			<div class="item">
				<img src="./images/img/place06.jpg" alt="">
				<p>一中商圈</p>
			</div> -->
		</div>
		<div class="sure"><input class="confirm-button" type="button" value="清空" onclick=""></div>

		<input type="button" value=" < " class="move-out-button" id="moveOutButton">

	</div>

	

	<script src="./js/loginLightbox.js"></script>
	@@include('../../layout/footer.html')
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
	<script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/attinsidepage.js"></script>
</body>

</html>