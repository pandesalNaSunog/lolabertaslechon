class Cart{
    constructor(addToCartButton, addToCartText){
        this.addToCartButton = addToCartButton;
        this.addToCartText = addToCartText;
    }

    addToCart(toast, toastTitle, toastMessage){
        let thisObject = this
        let buttonState = new ButtonState()
        let toastObject = new Toast(toast, toastTitle, toastMessage);
        thisObject.addToCartButton.click(function(e){
            buttonState.disableButton(thisObject.addToCartButton, thisObject.addToCartText, 'Please Wait...');
            $.ajax({
                type: 'POST',
                url: 'add-to-cart/',
                data:{
                    product_id: thisObject.addToCartButton.val()
                },
                success: function(response){
                    
                    if(response == 'ok'){
                        buttonState.enableButton(thisObject.addToCartButton, thisObject.addToCartText, 'Add to Cart');
                        toastObject.showToast('Success', 'This product has been successfully added to your cart.');
                    }else if(response == 'exists'){
                        buttonState.enableButton(thisObject.addToCartButton, thisObject.addToCartText, 'Add to Cart');
                        toastObject.showToast('Information', 'This product already exists in your cart.');
                    }else{
                        location.replace('../login/');
                    }
                }
            })
        })
    }
}