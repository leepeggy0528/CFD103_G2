$(function () {	


    $('body').on('click','.delect_place',function(){
        $(this).parents('.place').remove()
    });
    // 案+ 出現MODEL
    $('body').on('click','.add_place',function(){
        $('.external-modal').css('display','block')
        $('.external-modal input').val('')
    });

    //按下確定新增行程
    $('body').on('click','#model-submit-btn',function(){
        let newTime = $('#model-start-time-input').val()

        let newPlace = $('#model-place-input').val()

        let tempblock = `<li class="place"><p class="input_time">${newTime}</p><h2>${newPlace}</h2><span class="delect_place">X</span></li>`

       $('.add_place').before(tempblock)

       //MODEL 消失
       $('.external-modal').css('display','none')
    });
    
    //按下取消【不】新增行程
    $('body').on('click','#model-cancel-btn',function(){
       //MODEL 消失
       $('.external-modal').css('display','none')
    });

   
    $('body').on('click','.day_list',function(){
        // 初始化
        $('.day_list').removeClass('day_list_active')
        $(this).addClass('day_list_active')
    });
});



// 抓child
// $(this).find('.XXX')       
//更改屬性值
//$('#testurl').attr("href",'https://www.w3school.com.cn/jquery/jquery_dom_add.asp')     


// var tempblock = '<li class="place"><p class="input_time">20:00</p><h2>你好嗎餐酒館</h2><span class="delect_place">X</span></li>'
// var time=$('#model-start-time-input').val()
//$('#add_place').before(tempblock.replace('20:00',time))