<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        $customerName = $_POST['customerName'];
        $customerAddress = $_POST['customerAddress'];

        $query = "SELECT * FROM `orders` WHERE customer_name='$customerName' AND customer_address='$customerAddress'";
        $order = $con->query($query) or die($con->error);
        if($row = $order->fetch_assoc()){
            echo 'may kapareho';
        }else{
            echo 'clear';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>