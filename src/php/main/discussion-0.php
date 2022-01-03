<?php 
try {
	//引入連線工作的檔案
	require_once("./php/connectAccount.php");
	
	//執行sql指令並取得pdoStatement
	$sql = "select *,count(post.post_no) as msg 
    from post join member on post.mem_id = member.mem_id 
                join post_pt on post.post_no = post_pt.post_no
                left join post_mes on post.post_no = post_mes.post_no
    where ppt_pt like('picture%') and post_show=1
     group by post.post_no;";
	$products = $pdo->query($sql); 

	//取回所有的資料, 放在2維陣列中
	$prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/discussion.css">
    <script src="https://kit.fontawesome.com/657f3993c9.js" ></script>
    <title>Document</title>
    
</head>

<body>

@@include('../../layout/login.html')
@@include('../../layout/header.html')
<div class="talk"><h2>討論趣</h2></div>
    <label for="search" class=""></label>
    
    
    <form action="#" class="search-item">
            <input type="text" name="search"
            placeholder="搜尋文章" class="search-article" >

            <div class="search-icon"><a href="">
                <i class="fas fa-search"></i></a>
            </div>
    </form>    
    
    <div class="insta-sm-box">

        <div class="tager-box">
            <h2>熱門標籤</h2>
                <div class="tagers">
                        <span class="i"><a href="">#美食</a></span>
                        <span class="i"><a href="">#燒腦</a></span>
                        <span class="i"><a href="">#休閒</a></span>
                        <span class="i"><a href="">#夜市</a></span>
                        <span class="i"><a href="">#購物</a></span>
                        <span class="i"><a href="">#旅行</a></span>
                        <span class="i"><a href="">#運動</a></span>
                        <span class="i"><a href="">#學習</a></span>
                </div>
        </div>


        <div class="sort-box">
            <h2>類別</h2>

            <div class="s-tag">
                <input type="radio" name="type" checked>
                <p>美食</p>

                <input type="radio" name="type" checked>
                <p>旅行</p>
           
                <input type="radio" name="type" checked>
                <p>購物</p>

                <input type="radio" name="type" checked>
                <p>運動</p>

                <input type="radio" name="type" checked>
                <p>其他</p>
            </div>
        </div>

        <div class="datetime-box">
            <h2>排列順序依照</h2>   
            <div class="datetime-tag">
                <input type="radio" name="type" checked>
                <p>上傳時間</p>

                <input type="radio" name="type" checked>
                <p>留言數</p>
         
                <input type="radio" name="type" checked>
                <p>讚數</p>

                <input type="radio" name="type" checked>
                <p>熱度</p>
            </div>
        </div>
    </div>

<div class="container-box">

    <div class="insta-item"> 

        <div class="insta-item-main">
                <?php 
                foreach($prodRows as $i => $prodRow){
                ?>
            <div class="insta-item-main-i">
                    <div class="box-i">
                        <div class="left-i">
                            <div class="pic">
                                <img src="./images/discussion/<?=$prodRow["ppt_pt"];?>">
                            </div>

                            <div class="me">
                                <div class="pic_me">
                                <img src="./images/user/<?=$prodRow["mem_pt"];?>">
                                </div>
                                <p><?=$prodRow["mem_name"];?></p>
                            </div>
                        </div>

                        <div class="center-i">
                            <span class="title"><h3><?=$prodRow["post_title"];?></h3></span>

                            <p><?=$prodRow["post_context"];?></p>

                            <div class="seemore">
                            <a href="discussion-text.php?pno=<?=$prodRow["post_no"]?>">看更多</a>
                            </div>

                            <div class="tag">
                            <p><?=$prodRow["post_type"];?></p>
                            </div>
                        </div>
                    </div>


                        <div class="box-i-2">
                            <ul class="right-i">
                                <li class="comment-item">
                                    <i class="fas fa-comment-alt" style="color: #025A78;"></i>
                                    <p><?=$prodRow["msg"];?></p>
                                </li>

                                <li class="comment-item">
                                    <i class="fas fa-thumbs-up" style="color: #025A78;"></i>
                                    <p><?=$prodRow["post_like"];?></p>
                                </li>

                                <li class="comment-item">
                                    <i class="fas fa-fire" style="color: #025A78;"></i>
                                    <p><?=$prodRow["post_times"];?></p>
                                </li>
                            </ul>
                            
                            <div class="date-time">
                            <p><?=$prodRow["post_time"];?></p>
                            </div>  
                        </div>     
            </div>

                <?php
                    }
                ?>	 
                <div class="post"></div>
        </div>

        <div class="insta-item-sub">

                <div style="text-align:center;">
                    <button class="btnBlue">發貼文</button> 
                </div>
                
                <div class="tag-box">
                    <h2>熱門標籤</h2>
                    <div class="tager">
                        <span class="i"><a href="">#美食</a></span>
                        <span class="i"><a href="">#燒腦</a></span>
                        <span class="i"><a href="">#休閒</a></span>
                        <span class="i"><a href="">#夜市</a></span>
                        <span class="i"><a href="">#購物</a></span>
                         <span class="i"><a href="">#旅行</a></span>
                        <span class="i"><a href="">#運動</a></span>
                        <span class="i"><a href="">#學習</a></span>
                    </div>
                </div>

                <div class="tag-box">
                    <h2>類別</h2>
                   
                    <div class="tag">
                        <input type="radio" id="eat"  value="eat" name="type"checked>
                        <label for="eat"></label>
                        <p>美食</p>
                    </div>

                    <div class="tag">
                        <input type="radio" id="journey"  value="journey"  name="type">
                        <label for="journey"></label>
                        <p>旅行</p>
                    </div>

                    <div class="tag">
                        <input type="radio" id="shop"  value="shop"  name="type">
                        <label for="shop"></label>
                        <p>購物</p>
                    </div>
                    
                   

                    <div class="tag">
                        <input type="radio" id="exercise"  value="exercise"  name="type">
                        <label for="exercise"></label>
                        <p>運動</p>
                    </div>

                    <div class="tag">
                        <input type="radio" id="other"  value="other"  name="type">
                        <label for="other"></label>
                        <p>其他</p>
                    </div>
                </div>
 
                <div class="tag-box">
                    <h2>排列順序依照</h2>
                    <div class="tag">
                        <input type="radio" id="lasttime"  value="lasttime" checked  name="type2">
                        <label for="lasttime"></label>
                        <p>上傳時間</p>
                    </div>


                    <div class="tag">
                        <input type="radio" id="exercise"  value="exercise"  name="type2">
                        <label for="exercise"></label>
                        <p>留言數</p>
                    </div>

                    <div class="tag">
                        <input type="radio" id="exercise"  value="exercise"  name="type2">
                        <label for="exercise"></label>
                        <p>讚數</p>
                    </div>


                    <div class="tag">
                        <input type="radio" id="exercise"  value="exercise"  name="type2">
                        <label for="exercise"></label>
                        <p>熱度</p>
                    </div>

                </div>
        </div>
    </div>
            
        <div class="fix-btn">
            <button class="btnBlue ">發貼文</button>
        </div>

    <!-- 分頁數字 -->
    <section class="page">
        <button class="prev">上一頁</button>
        <button class="pageNo">1</button>
        <button class="pageNo">2</button>
        <button class="pageNo">3</button>
        <span>...</span>
        <button class="pageNo">10</button>
        <button class="next">下一頁</button>
    </section>

        <div class="screen">
            <div class="screen-wrapper">
                <form class="screen-form" id="screen-form">
                <h1 class="join">發貼文</h1> 
                
                    <div class="section-all">
                        <div class="section">

                            <div class="group-title">
                                <span>貼文名稱:</span>
                                <input type="text" placeholder="羊羊好可愛" class="cute-text">
                            </div>

                            <div class="group-tag">
                                <span>標籤:</span>
                                <div class="tag-1">
                                <input type="radio" name="color"  value="美食">美食
                                <input type="radio" name="color" value="夜市">夜市
                                <input type="radio" name="color" value="學習">學習
                                <input type="radio" name="color"  value="運動">運動
                                </div>

                                <div class="tag-2">
                                <input type="radio" name="color"  value="休閒">休閒
                                <input type="radio" name="color"  value="購物">購物
                                <input type="radio" name="color" value="旅行">旅行
                                <input type="radio" name="color"  value="燒腦">燒腦
                                </div>
                            </div>

                        
                            <span>貼文內容:</span>
                            <div class="group-text">
                                <textarea class="group-text-i" maxlength="100" cols="10" rows="10" placeholder="請輸入內容"></textarea>

                                <div class="Num">
                                    <span class="wordsNum">0/100</span>
                                </div>
                            </div>

                        </div>

                        <div class="section">
                            <span>上傳照片:</span>
                                <div class="pic-box">
                                    <input type="file" accept="image/*" />
                                    <img id="image" src="" alt="" />
                                </div>

                                
                        </div>
                    </div>

                    <div class="btn-boxY">
                        <button class="btnYellow" type="button">送出</button>
                    </div>

                    <div class="leave-btn">
                        <button class="leave">X</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<script src="js/jquery-3.6.0.min.js"></script>
<script>
    $('body').on('click','.btnBlue',function(){

        $('.screen').css('display','block')
   
    });

    /* var btnYellow = document.querySelector(".screen-form .btn-boxY .btnYellow");
      btnYellow.onclick = function () {
      alert("確定送出嗎?");
      }; */
      
    $("input[type=file]").on("change", function () {
    function getObjectURL(file) {
    if (window.URL != undefined) {
      url = window.URL.createObjectURL(file);
      return url;
        }
    }
    var objURL = getObjectURL(this.files[0]);
    document.getElementById("image").src = objURL;
    });

     let textMax = 100;		
      $('.wordsNum').html(`${textMax}/100`);
      $('.group-text-i',).keyup(function(){
        let textLength = $(this).val().length;
        $('.wordsNum').html(`${textMax-textLength}/100`);
      });  

</script>

        <script>
        //留言功能
        //獲取元素
        //註冊時間
        var btn = document.querySelector('.btn-boxY .btnYellow');
        var titles = document.querySelector('.cute-text');
        var choicer = $("input[type=radio][name=color]:checked").val();
        console.log("===========",choicer);
        
        var contents = document.querySelector('.group-text-i');
        var post = document.querySelector('.post');
        btn.onclick = function(){
            alert("確定送出嗎?");
            var photo =  $('#image').attr('src');
            //---------------
            let colors = document.querySelectorAll("input[type=radio][name=color]:checked");
            
            //---------------

            if(titles.value == ''){
                alert("您沒有輸入貼文名稱。")
                return false;
            }
            else if(colors.length == 0){
                alert("您沒有選擇標籤。")
                return false;
            }
            else if(contents.value == ''){
                alert("您沒有輸入貼文內容。")
                return false;
            }
            else if(photo == ''){
                alert("您沒有選擇圖片。")
                return false;
            }
            else{
                var postItem = document.createElement('div');
                post.appendChild(postItem);
                postItem.classList.add("insta-item-main-i");

                var boxI = document.createElement('div');
                postItem.appendChild(boxI);
                boxI.classList.add("box-i");

                var boxII = document.createElement('div');
                postItem.appendChild(boxII);
                boxII.classList.add("box-i-2");
    
                var leftI = document.createElement('div');
                boxI.appendChild(leftI);
                leftI.classList.add("left-i");

                var centerI = document.createElement('div');
                boxI.appendChild(centerI);
                centerI.classList.add("center-i");

                var pic = document.createElement('div');
                leftI.appendChild(pic);
                pic.classList.add("pic"); 

                var imgBig = new Image();
                imgBig.src=("photo");
                pic.appendChild(imgBig);

                var me = document.createElement('div');
                leftI.appendChild(me);
                me.classList.add("me"); 

                var picMe = document.createElement('div');
                me.appendChild(picMe);
                picMe.classList.add("pic_me"); 

                var img = new Image();
                img.src="./images/user/m01.jpg";
                picMe.appendChild(img);
                
                var p = document.createElement('p');
                me.appendChild(p);
                p.innerText = "黃曉明";
                
                var instaTitle = document.createElement('h3');
                centerI.appendChild(instaTitle);
                instaTitle.innerText = titles.value;

                var pp = document.createElement('p');
                centerI.appendChild(pp);
                pp.innerText = contents.value;

                var rightI = document.createElement('ul');
                boxII.appendChild(rightI);
                rightI.classList.add("right-i");

                var commentItem = document.createElement('li');
                rightI.appendChild(commentItem);
                commentItem.classList.add("comment-item");
            
                var dateTime = document.createElement('div');
                boxII.appendChild(dateTime);
                dateTime.classList.add("date-time");

                var time = document.createElement('p');
                dateTime.appendChild(time);


                let now = new Date()
                time.innerText =(now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate()+' '+now.getHours()+':'+ now.getMinutes()+':'+ now.getSeconds());
                $('.screen').css('display','none');
            }
        }
        </script>

<script src="./js/loginLightbox.js"></script>
@@include('../../layout/footer.html')
</body>
</html>



