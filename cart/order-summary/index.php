<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        $con = connect();
        session_start();
        $cart = array();
        if(isset($_SESSION['client_user_id'])){
            $userId = $_SESSION['client_user_id'];
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
                    'total' => number_format($total, 2),
                );
                $grandTotal += $total;
            }
            $addresses = array();
            $addressQuery = "SELECT * FROM delivery_addresses WHERE user_id = '$userId'";
            $addressResult = $con->query($addressQuery) or die($con->error);
            while($addressRow = $addressResult->fetch_assoc()){
                $addresses[] = $addressRow;
            }
            echo json_encode(array(
                'cart_item' => $cart,
                'grand_total' => number_format($grandTotal,2),
                'addresses' => $addresses,
            ));
        }else{
            echo 'session expired';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>