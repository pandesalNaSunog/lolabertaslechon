$(document).ready(function(){
    let checkoutButton = $('#check-out-button');
    let orderSummaryModal = $('#order-summary-modal');
    let orderSummaryTable = $('#order-summary-table');
    let grandTotal = $('#grand-total')
    let orderSummaryObject = new OrderSummary(checkoutButton, orderSummaryTable, orderSummaryModal, grandTotal);
    orderSummaryObject.orderSummary();
})