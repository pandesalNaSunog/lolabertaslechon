<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        $con = connect();
        session_start();
        $cart = array();
        if(isset($_SESSION['user_id'])){
            $userId = $_SESSION['user_id'];
            $query = $con->prepare('SELECT * FROM carts WHERE user_id = ?');
            $query->bind_param('i', $userId);
            $query->execute();
            $result = $query->get_result();
            $grandTotal = 0;
            while($data = $result->fetch_assoc()){
                $productId = $data['product_id'];
                $productquery = $con->prepare('SELECT * FROM products WHERE id = ?');
                $productquery->bind_param('i', $productId);
                $productquery->execute();
                $productresult = $productquery->get_result();
                $productData = $productresult->fetch_assoc();
                $total = $productData['price'] * $data['quantity'];
                $cart[] = array(
                    'id' => $data['id'],
                    'name' => $productData['name'],
                    'image' => $productData['image'],
                    'price' => $productData['price'],
                    'quantity' => $data['quantity'],
                    'total' => $total
                );
                $grandTotal += $total;
            }
            echo json_encode(array(
                'cart_item' => $cart,
                'grand_total' => $grandTotal
            ));
        }else{
            echo 'session expired';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>