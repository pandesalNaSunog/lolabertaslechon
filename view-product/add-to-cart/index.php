<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');
        $con = connect();
        session_start();
        if(isset($_POST['product_id']) && isset($_SESSION['client_user_id'])){
            $productId = $_POST['product_id'];
            $userId = $_SESSION['client_user_id'];
            $query = $con->prepare('SELECT * FROM carts WHERE product_id = ? AND user_id = ?');
            $query->bind_param('ii', $productId, $userId);
            $query->execute();
            $result = $query->get_result();
            if($data = $result->fetch_assoc()){
                echo 'exists';
            }else{
                $query = $con->prepare('INSERT INTO carts(user_id,product_id,quantity,created_at,updated_at)VALUES(?,?,?,?,?)');
                $quantity = 1;
                $query->bind_param('iiiss', $userId, $productId, $quantity, $today, $today);
                $query->execute();
                echo 'ok';
            }
        }else{
            echo 'expired';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>