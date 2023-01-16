<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        $query = "SELECT * FROM orders";
        $result = $con->query($query);
        $orders = array();
        while($data = $result->fetch_assoc()){
            $customerId = $data['user_id'];
            $query = "SELECT * FROM users WHERE id = '$customerId'";
            $userResult = $con->query($query);
            $userData = $userResult->fetch_assoc();
            $customerName = $userData['name'];
            $orders[] = array(
                'customer_name' => $customerName,
                'order_type' => $data['order_type'],
                'date' => date_format(date_create($data['date_and_time']), 'M d, Y h:i A'),
                'id' => $data['id']
            );
        }
        echo json_encode($orders);
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>