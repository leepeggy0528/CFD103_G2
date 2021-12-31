$(document).ready(function(){
    
    $(window).on('load',function(){
        $('.join_us .step > h3').delay(300).animate({
            left: '32px',
            opacity: 1,
        },300);

        for(let n=1;n<=5;n++){
            $(`.join_us .step li:nth-of-type(${n})`).delay(300+300*n).animate({
                top: 0,
                opacity: 1,
            },300);
        }
        $('.sign_up p').delay(2100).animate({
            top: 0,
            opacity: 1,
        },300);

    });





    let showHeight = 580
    let showHeight_A = 880
    $(window).on('load scroll resize',function(){
        let windowsTop = $(window).scrollTop()
    
        let featureTop = $(".feature").offset().top;

        let startPartyTop = $(".start_party").offset().top;
        
        let commentTop = $(".comment_board").offset().top;

        let hotLeaderTop = $(".hot_leader").offset().top;

        if(windowsTop >= featureTop - showHeight){
            
            for(let i=1;i<=4;i++){
                $(`.feature .item li:nth-of-type(${i})`).delay(300*i).animate({
                    opacity: 1,
                    left: 0,
                },300);
            }
        }

        if(windowsTop >= startPartyTop - showHeight){
            for(let i=1;i<=6;i++){
                $(`.start_party .card_group li:nth-of-type(${i})`).delay(300*i).animate({
                    opacity: 1,
                },300);
            }
        }

        if(windowsTop >= commentTop - showHeight_A){
            for(let i=1;i<=3;i++){
                $(`.comment_board .comment_group li:nth-of-type(${i})`).delay(600*i).animate({
                    opacity: 1,
                    right: '0px',
                },300);
            }
        }

        if(windowsTop >= hotLeaderTop - showHeight){
        
            for(let i=1;i<=4;i++){
                $(`.hot_leader .top_leader li:nth-of-type(${i})`).delay(300*i).animate({
                    opacity: 1,
                    left: 0,
                    top: 0,
                },300);
            }
            for(let i=6;i<=9;i++){
                $(`.hot_leader .top_leader li:nth-of-type(${i})`).delay(300*(i-1)).animate({
                    opacity: 1,
                    left: 0,
                    top: 0,
                },300);
            }
        
        
        }
    });




    $('.saveActivity').on('click',function(){
        let iSave = $(this)
        if (iSave.attr('title') == '收藏活動') {
            iSave.attr('src','./images/icon/save.png')
            iSave.attr('title','取消收藏');
        } else{
            iSave.attr('src','./images/icon/unsave.png')
            iSave.attr('title','收藏活動');
        }
    })
});