$(function () {	
    // 案+ 出現MODEL
    $('body').on('click','.add_place',function(){
        $('.modal-background').css('display','block')
        $('.external-modal input').val('')
    });

    //按下確定新增行程
    $('body').on('click','#model-submit-btn',function(){
        
        let startTime = $('#model-start-time-input').val()
        let endTime = $('#model-end-time-input').val()
        let newPlace = $('#model-place-input').val()
        let newAddress = $('#model-address-input').val()
        
        let placeTemplate = `<li class="place"><p class="input_time">${startTime}</p><span class="input_time_end" style="display:none">${endTime}</span><h2 class="place_view">${newPlace}</h2><span class="place_address" style="display:none">${newAddress}</span><span class="delect_place">X</span></li>`
       $('.place_group_show .add_place').before(placeTemplate)
       //MODEL 消失
       $('.modal-background').css('display','none')
    });

    //按下取消【不】新增行程
    $('body').on('click','#model-cancel-btn',function(){
        //MODEL 消失
        $('.modal-background').css('display','none')
     });

    //刪除單一行程
    $('body').on('click','.delect_place',function(){
        $(this).parents('.place').remove()
    });

    //day_list 點案切換頁籤 DAY1,DAY2...
    $('body').on('click','.day_list',function(){
        // 初始化
        $('.day_list').removeClass('day_list_active')
        $(this).addClass('day_list_active')
        $('.place_group').removeClass('place_group_show')
        let dayIndex = $("#day_lists .day_list").index(this)
        $(`.place_group:nth-of-type(${dayIndex+1})`).addClass('place_group_show')
        //更換顯示DAY
        $('#change_day').html(dayIndex+1)
    });

    //依照輸入天數新增daylist
    $('.party_totalday').on('change',function(){
            let partyTotalDay = $('.party_totalday').val()
            if( parseInt(partyTotalDay) <= 0 || parseInt(partyTotalDay) >5 ){
                $('.party_totalday').val(1)
                partyTotalDay='1'
                alert('天數請選五天以內')
            }
            //init
            let initDayLists = '<ul class="day_lists" id="day_lists"><li class="day_list day_list_active"><p>Day1</p></li></ul>'
            let partyDay = '<p class="party_day">DAY<span id="change_day">1</span></p>'
            let initPlaceGroup ='<ul class="place_group place_group_show"><li class="add_place"><p>+</p></li></ul>'
            $('.detail').html(partyDay+initPlaceGroup+initDayLists)
            for(let i=2; i<=partyTotalDay ;i++){
                let addNewDay = `<li class="day_list"><p>Day${i}</p></li>`
                $('#day_lists').append(addNewDay)
                let placeAllTemplate = `<ul class="place_group"><li class="add_place"><p>+</p></li></ul>`
                $('#day_lists').before(placeAllTemplate)
            }
    });
    //party_discribe 剩餘可輸入數字字數
    let textMax = 200;		
    $('#limit_words_count').html(textMax);
    $('#party_explan').keyup(function(){
        let textLength = $(this).val().length;
        $('#limit_words_count').html(`${textMax-textLength}`);
    }); 


    $('#gro_paytype').on('change',function(){
        let payType = $('#gro_paytype').val()
        switch (payType){
            case '0':
                $('#pay_show').css('display','none')
                $('#gro_pay').val('0')
            break;
            case '1':
                $('#pay_show').css('display','block')
            break;
            case '2':
                $('#pay_show').css('display','block')
            break;
        }
    });
     
    //上傳圖片
    let save_path = "images/group/";
    $('#upload_img').on("change",function(){
        let file_data = $(this)[0].files[0],
            form_data = new FormData();
            form_data.append("file",file_data);
            form_data.append("save_path",save_path);

            $.ajax({
                type : "POST",
                url :  "php/upload_file.php",
                data : form_data,
                cache : false, //不用暫存
                processData : false,
                contentType : false,
                dataType: 'html' ,
                success:function(data){
                    if(data =='yes'){
                        $(".show_image").html("<img src='./" + save_path + file_data['name'] +"'>")

                        //把相對路徑放到input裡面，之後送出表單，才可以抓的到
                        $(".image_path").val(file_data['name']);
                    } 
                },           
            })
    });
    //刪除圖片
    $(".delete_image").on("click",function(){
        if($('.image_path').val()!="")
        {
            let delect_alert = confirm("確定要刪除?");
            if(delect_alert){
                $.ajax({
                    type : "POST",
                    url :  "php/delete_file.php",
                    data : {
                        'file' : save_path + $(".image_path").val()
                    },
                    dataType: 'html' ,
                    success:function(res){
                        if(res =='yes'){
                            //清除圖片
                            $(".show_image").html("");
                            //路徑是相對於html 相對路徑清除
                            $(".image_path").val("");
                            $('#upload_img').val("");           
                        } 
                    },
                    error : function(err){
                        console.log(err)
                    }          
                })
            }
        }
        else
        {
            alert("尚未上傳檔案無法刪除");
        }
    });



});


document.getElementById("hold_party").onclick = function(){
    let arr=[];
    let days=[];
    let place_group = document.getElementsByClassName("place_group");

    for(let d=0; d<place_group.length; d++){ 
      let place = place_group[d].querySelectorAll(".place");

      let input_time = place_group[d].querySelectorAll(".input_time");
      let input_time_end = place_group[d].querySelectorAll(".input_time_end");				
      let place_view = place_group[d].querySelectorAll(".place_view");
      let place_address = place_group[d].querySelectorAll(".place_address");

      days[d] = [];
      for(let i=0; i<place.length; i++){
          let spot = {};
          spot.input_time = input_time[i].innerText;
          spot.input_time_end = input_time_end[i].innerText;
          spot.place_view = place_view[i].innerText;
          spot.place_address = place_address[i].innerText;

          days[d].push(spot);
        }
        arr.push(days[d]);		
    }
    
    let gro_name = document.getElementById("gro_name").value;
    let gro_startd = document.getElementById("gro_startd").value;
    let party_totalday = document.getElementById("party_totalday").value;
    // 天數運算
    let gro_endd =new Date(gro_startd);
    gro_endd = gro_endd.setDate(gro_endd.getDate()+parseInt(party_totalday-1));
    gro_endd = new Date(gro_endd).toLocaleDateString();
    // 
    
    let gro_loc = document.getElementById("gro_loc").value;
    let gro_type = document.getElementById("gro_type").value;
    let gro_paytype = document.getElementById("gro_paytype").value;
    let gro_pay = document.getElementById("gro_pay").value;
    let gro_infnumber = document.getElementById("gro_infnumber").value;
    let gro_subnumber = document.getElementById("gro_subnumber").value;
    // let schedule = document.getElementById("schedule").value;    
    let gro_endadd = document.getElementById("gro_endadd").value;
    let party_explan = document.getElementById("party_explan").value;
    
    let gpt_pt = document.querySelector(".image_path").value;
    let detail = {
        
        "GRO_NAME" : gro_name,
        "GRO_STARTD" :gro_startd,
        "GRO_ENDD" :  gro_endd,
        "GRO_LOC" : gro_loc,
        "GRO_TYPE" : gro_type,
        "GRO_PAYTYPE" : gro_paytype,
        "GRO_PAY" : gro_pay,
        "GRO_INFNUMBER" : gro_infnumber,
        "GRO_SUPNUMBER" : gro_subnumber,
        "GRO_ENDADD" : gro_endadd,
        "SCHEDULE" : arr,
        "GRO_EXPLAN" : party_explan,
        "GPT_PT" : gpt_pt,
        // "GPT_PT" : name,
    }
    

    $.ajax({
        url:"holdparty_page.php",
        method:"POST",
        data : detail, 
        success:function(res){
            if(res){
                alert('建立成功');
                $("input").val('');
                window.location.href = "http://localhost/CFD103_G2/dist/group.php";
            }
        },
        dataType : 'text'
    })
}