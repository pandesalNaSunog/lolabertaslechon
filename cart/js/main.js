$(document).ready(function(){
    let checkoutButton = $('#check-out-button');
    let orderSummaryModal = $('#order-summary-modal');
    let orderSummaryTable = $('#order-summary-table');
    let grandTotal = $('#grand-total');
    let selectDeliveryAddress = $('#select-delivery-address');
    let deliveryModeClass = $('.delivery-mode');
    let deliveryMode = $('#delivery-mode');
    let orderSummaryObject = new OrderSummary(checkoutButton, orderSummaryTable, orderSummaryModal, grandTotal, selectDeliveryAddress, deliveryModeClass, deliveryMode);
    orderSummaryObject.orderSummary();
    orderSummaryObject.changeDeliveryMode();
})