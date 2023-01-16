<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        $con = connect();
        session_start();
        if(isset($_POST) && isset($_SESSION['client_user_id'])){
            $userId = $_SESSION['client_user_id'];
            $quantity = $_POST['quantity'];
            $cartItemId = $_POST['cart_item_id'];
            $query = $con->prepare('UPDATE carts SET quantity = ? WHERE id = ? AND user_id = ?');
            $query->bind_param('iii', $quantity, $cartItemId, $userId);
            $query->execute();
            echo 'ok';
        }else{
            echo 'session expired';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>