class Item{
    constructor(card, remove, quantity){
        this.card = card;
        this.remove = remove;
        this.quantity = quantity;
    }

    removeItem(){
        let thisObject = this;
        this.remove.click(function(){
            if(confirm('Remove this product from your cart?') == true){
                thisObject.card.remove();
            }
        })
    }
}