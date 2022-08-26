<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');
        if(isset($_POST)){
            $orderId = $_POST['order_id'];
            $amount = $_POST['amount'];

            $query = "INSERT INTO sales(`order_id`,`amount_renderred`,`created_at`, `updated_at`)VALUES('$orderId','$amount', '$today','$today')";
            $con->query($query) or die($con->error);
            $query = "SELECT * FROM sales WHERE id = LAST_INSERT_ID()";
            $sale = $con->query($query) or die($con->error);

            $salesRow = $sale->fetch_assoc();

            echo 'ok';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>