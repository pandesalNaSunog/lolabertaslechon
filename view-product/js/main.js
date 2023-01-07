$(document).ready(function(){
    let addToCartButton = $('#add-to-cart');
    let addToCartText = $('#add-to-cart-text');
    let cart = new Cart(addToCartButton, addToCartText);
    let toast = $('#toast');
    let toastTitle = $('#toast-title');
    let toastMessage = $('#toast-message');
    cart.addToCart(toast, toastTitle, toastMessage);
});