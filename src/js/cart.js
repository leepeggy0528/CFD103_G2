function showCart(){
    let cart = document.getElementById("cart");
    cart.classList.toggle("cart-open");
    console.log(cart.classList.value);
}



function init(){
    document.getElementById("moveOutButton").onclick = showCart;
}
window.addEventListener("load", init)