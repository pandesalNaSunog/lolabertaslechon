<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $query = "SELECT * FROM `orders`";
        $result = mysqli_query($con,$query);
        $ordersArray = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $customer_name = $row['customer_name'];
                $customer_address = $row['customer_address'];
                $contact_number = $row['contact_number'];
                $product_id_and_quantity = $row['product_id_and_quantity'];
                $created_at = $row['created_at'];
                $ordersArray[] = array(
                    'id' => $id,
                    'name' => $customer_name,
                    'address' => $customer_address,
                    'contact_number' => $contact_number,
                    'quantity' => $product_id_and_quantity,
                    'createdAt' => $created_at,
                );
            }
            echo json_encode($ordersArray);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>