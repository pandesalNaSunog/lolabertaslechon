<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $today = today();
        $orderId = $_POST['order_id'];
        $status = htmlspecialchars($_POST['status']);

        if($status == 'Claimed'){
            $status = 'Your order has been ' . $status;
        }else{
            $status = 'Your order is currently ' . $status;
        }

        $query = $con->prepare("INSERT INTO order_statuses(order_id, `status`, created_at, updated_at)VALUES(?,?,?,?)");
        $query->bind_param('isss', $orderId, $status, $today, $today);
        $query->execute();
        echo 'ok';
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>