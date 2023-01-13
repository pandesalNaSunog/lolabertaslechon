<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        $con = connect();
        if(isset($_POST)){
            $cartId = htmlspecialchars($_POST['cart_id']);

            $query = $con->prepare('SELECT * FROM carts WHERE id = ?');
            $query->bind_param('i', $cartId);
            $query->execute();
            $result = $query->get_result();
            if($data = $result->fetch_assoc()){
                $query = $con->prepare('DELETE FROM carts WHERE id = ?');
                $query->bind_param('i', $cartId);
                $query->execute();
                echo 'ok';
            }else{
                echo 'does not exist';
            }
        }else{
            echo 'error';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>