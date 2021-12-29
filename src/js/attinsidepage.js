$(function () {
           
    let index_spot=[];
    if(localStorage.getItem('index_spot') != null){
            index_spot = localStorage.getItem('index_spot').split(',');
            for(let i=0;i<index_spot.length;i++){
                let img_src = localStorage.getItem(index_spot[i]);
                let cartTemp =`<div class="item"><img src="${img_src}"alt=""><p>${index_spot[i]}</p></div>`;
                console.log(cartTemp);
                $('#cart .cart-list').append(cartTemp);
            }
    }

    //新增景點
    $('.joinsite').on('click',function(){
        let img_src = $('#large').attr('src');
        let spot_name = $('h2').text();
        if(localStorage.getItem('index_spot') != null){
            index_spot = localStorage.getItem('index_spot').split(',');
        }
        if(!localStorage.getItem(spot_name)){
            localStorage.setItem(`${spot_name}`,`${img_src}`)
            let cartTemp =`<div class="item"><img src="${img_src}"alt=""><p>${spot_name}</p></div>`;
            console.log(cartTemp);
            $('#cart .cart-list').append(cartTemp);
            index_spot.push(spot_name);
            console.log(index_spot);
            localStorage.setItem('index_spot',index_spot);
            alert(`${spot_name}加入成功`);
        }else{
            alert('已加入');
        }
    });

    //單個移除
    $('body').on('click','.item',function(){
        if(confirm('確定移除?') == 1){
            $(this).remove();
            let remove_spot = $(this).find('p').text();
            localStorage.removeItem(remove_spot);
            let remove_this = index_spot.indexOf(remove_spot);
            index_spot.splice(remove_this,1);
            localStorage.setItem('index_spot',index_spot);
            if(localStorage.getItem('index_spot').length == 0){
                localStorage.clear();
            }
        }     
    });
    //清空全部
    $('.confirm-button').on('click',function(){   
        let item_length = $('.item').length;
        if(item_length == 0){
                alert('列表沒資料');
        }else{
            if(confirm('真的要清空ㄇ?') == 1){
                localStorage.clear();
                index_spot = [];
                $('#cart .cart-list .item').remove();
            }
        }
    });
});