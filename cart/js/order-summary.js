class OrderSummary{
    constructor(checkoutButton, orderSummaryTable, orderSummaryModal, grandTotal, selectDeliveryAddress, deliveryModeClass, deliveryMode){
        this.checkoutButton = checkoutButton;
        this.orderSummaryTable = orderSummaryTable;
        this.orderSummaryModal = orderSummaryModal;
        this.grandTotal = grandTotal;
        this.selectDeliveryAddress = selectDeliveryAddress
        this.deliveryMode = deliveryMode;
        this.deliveryModeClass = deliveryModeClass
        
    }

    changeDeliveryMode(){
        let thisObject = this;
        thisObject.deliveryMode.change(function(){
            if(thisObject.deliveryMode.val() == 'Pickup'){
                thisObject.deliveryModeClass.prop('disabled', true)
                thisObject.selectDeliveryAddress.val(0);
            }else{
                thisObject.deliveryModeClass.prop('disabled', false)
            }
        })
    }

    orderSummary(){
        let thisObject = this;
        let buttonState = new ButtonState();
        
        thisObject.checkoutButton.click(function(){
            buttonState.disableButton(thisObject.checkoutButton, thisObject.checkoutButton, 'Please Wait...');
            thisObject.orderSummaryTable.children().remove();
            thisObject.selectDeliveryAddress.children().remove();
            $.ajax({
                type: 'GET',
                url: 'order-summary/',
                success: function(response){
                    buttonState.enableButton(thisObject.checkoutButton, thisObject.checkoutButton, 'Checkout');

                    thisObject.orderSummaryModal.modal('show');
                    if(response != 'session expired'){
                        let data = JSON.parse(response);
                        $(data.addresses).each(function(index, value){
                            addToSelectDeliveryAddressMenu(value.id, value.address);
                        })
                        $(data.cart_item).each(function(index, value){
                            addToOrderSummaryTable(value.name, value.image, value. price, value.quantity, value.total)
                        })
                        thisObject.grandTotal.text(data.grand_total)
                    }
                    
                }
            })
        })

        function addToOrderSummaryTable(name, image, price, quantity, total){
            thisObject.orderSummaryTable.append(`<div class="card shadow mt-3">
                                                    <div class="card-body d-flex">
                                                        <img src="../admin/${image}" style="height: 100px; width: 100px; object-fit: cover" class="img-fluid">
                                                        <div class="ms-3 w-100">
                                                            <h4 class="fw-bold text-secondary">${name}</h4>
                                                            <i>Quantity: ${quantity}</i>
                                                            <div class="d-flex justify-content-between w-100">
                                                                <p class="text-danger">&#8369; ${price}</p>
                                                                <p class="text-danger">Total: &#8369; ${total}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`)
        }
        function addToSelectDeliveryAddressMenu(id, address){
            thisObject.selectDeliveryAddress.append(`<option value="${id}">
                                                        ${address}
                                                    </option>`)
        }
    }
}