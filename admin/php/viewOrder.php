<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $orderId = $_POST['order_id'];
        $query = $con->prepare('SELECT * FROM orders WHERE id = ?');
        $query->bind_param('i', $orderId);
        $query->execute();
        $result = $query->get_result();
        $grandTotal = 0;
        if($orderData = $result->fetch_assoc()){
            $productIds = explode('*', $orderData['product_ids']);
            $quantities = explode('*',$orderData['quantities']);
            $products = array();
            $items = 0;
            foreach($productIds as $key => $productId){
                $items++;
                $query = "SELECT * FROM products WHERE id = '$productId'";
                $productResult = $con->query($query);
                $productData = $productResult->fetch_assoc();
                $thisTotal = $productData['price'] * $quantities[$key];
                $products[] = array(
                    'name' => $productData['name'],
                    'image' => $productData['image'],
                    'price' => $productData['price'],
                    'quantity' => $quantities[$key],
                    'total' => number_format($thisTotal,2 )
                );
                $grandTotal += $thisTotal;
            }
            
            $orderStatusQuery = "SELECT * FROM order_statuses WHERE order_id = '$orderId'";
            $orderStatusResult = $con->query($orderStatusQuery);
            $statuses = array();
            while($orderStatusRow = $orderStatusResult->fetch_assoc()){
                $statuses[] = array(
                    'status' => str_replace('Your', 'This', $orderStatusRow['status']),
                    'date' => date_format(date_create($orderStatusRow['created_at']), 'M d, Y h:i A')
                );
            }
            $order = array(
                'id' => $orderData['id'],
                'orders' => $products,
                'grand_total' => number_format($grandTotal, 2),
                'items' => $items,
                'order_statuses' => $statuses
            );
            echo json_encode($order);
        }else{

        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>