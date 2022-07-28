<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');
        include('connection.php');
        $con = connect();

        $customerName = $_POST['customerName'];
        $customerAddress = $_POST['customerAddress'];
        $orderQuantity = $_POST['orderQuantity'];

        $query = "INSERT INTO `orders`(`customer_name`, `customer_address`, `product_id_and_quantity`, `created_at`) VALUES ('$customerName','$customerAddress','productId ($orderQuantity pcs)','$today')";
        $con->query($query) or die($con->error);
            echo 'success';
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>