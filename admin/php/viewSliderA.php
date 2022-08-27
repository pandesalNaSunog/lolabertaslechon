<?php
    // if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        // include('connection.php');
        // $con = connect();
        $con = new mysqli ('localhost','root','','lechon-database');
        $productId = $_POST['image_id'];
        $query = "SELECT * FROM slider_a WHERE id='$productId'";
        $specificProduct = $con->query($query) or die($con->error);
        $product = $specificProduct->fetch_assoc();
        echo json_encode($product);
    // }else{
    //     echo header('HTTP/1.1 403 Forbidden');
    // }
?>