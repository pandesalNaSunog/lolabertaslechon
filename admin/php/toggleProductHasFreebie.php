<?php
    if($_SERVER['HTTP_X_REQUESTED_WITH'] && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        if(isset($_POST)){
            $productId = htmlspecialchars($_POST['product_id']);
            $hasFreebie = htmlspecialchars($_POST['has_freebie']);
            $query = $con->prepare('UPDATE products SET has_freebie = ? WHERE id = ?');
            $query->bind_param('si', $hasFreebie, $productId);
            $query->execute();
            echo 'ok';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>