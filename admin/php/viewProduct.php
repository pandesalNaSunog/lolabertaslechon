<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $productId = $_POST['product_id'];
        $query = "SELECT * FROM products WHERE id='$productId'";
        $specificProduct = $con->query($query) or die($con->error);
        $product = $specificProduct->fetch_assoc();
        echo json_encode($product);
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>