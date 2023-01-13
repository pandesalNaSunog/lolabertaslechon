class Item{
    constructor(card, remove, quantity, removeText, available, id){
        this.card = card;
        this.remove = remove;
        this.quantity = quantity;
        this.removeText = removeText;
        this.available = available;
        this.id = id
    }

    removeItem(){
        let thisObject = this;
        let buttonState = new ButtonState();

        
        this.remove.click(function(){
            if(confirm('Remove this product from your cart?') == true){
                buttonState.disableButton(thisObject.remove, thisObject.removeText, 'Removing...');
                $.ajax({
                    type: 'POST',
                    url: 'remove-cart/',
                    data:{
                        cart_id: thisObject.remove.val()
                    },
                    success: function(response){
                        buttonState.enableButton(thisObject.remove, thisObject.removeText, 'Remove');
                        if(response == 'ok'){
                            thisObject.card.remove();
                        }
                    }
                })
                
            }
        })
    }

    changeQuantity(){
        function updateCartQuantity(value, id){
            $.ajax({
                type: 'POST',
                url: 'update-cart-quantity/',
                data:{
                    quantity: value,
                    cart_item_id: id
                },
                success: function(response){

                }
            })
        }

        let thisObject = this;
        this.quantity.change(function(){
            if(thisObject.quantity.val() > thisObject.available){
                thisObject.quantity.val(thisObject.available);
                
            }else if(thisObject.quantity.val() < 1){
                thisObject.quantity.val(1);
                
            }
            updateCartQuantity(thisObject.quantity.val(), thisObject.id)
        })

        
    }
}