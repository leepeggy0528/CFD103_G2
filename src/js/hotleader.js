$(function () {	

    setInterval(function(){
        
    },2000);

    $(window).on('load',function(){


        setInterval(function(){
            $('.top3_leader ul li:nth-of-type(1)').animate({
                top:  '-20px',
            },2000).animate({
                top:  '0px',
            },2000);
        },1000);

        setInterval(function(){
            $('.top3_leader ul li:nth-of-type(2)').animate({
                top:  '-20px',
            },2000).animate({
                top:  '0px',
            },2000);
        },2000);

        setInterval(function(){
            $('.top3_leader ul li:nth-of-type(3)').animate({
                top:  '-20px',
            },2000).animate({
                top:  '0px',
            },2000);
        },3000);
    });
   
});