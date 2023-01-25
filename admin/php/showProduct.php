<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        if(isset($_POST)){
            $productId = htmlspecialchars($_POST['product_id']);
            $query = $con->prepare('SELECT * FROM products WHERE id = ?');
            $query->bind_param('i', $productId);
            $query->execute();

            $result = $query->get_result();
            $data = $result->fetch_assoc();
            echo json_encode($data);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>