<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');

        include('connection.php');
        $con = connect();

        $manualDescriptionEdit = $_POST['manualDescriptionEdit'];
        $productId = $_POST['productId'];

        $query = "UPDATE products SET description='$manualDescriptionEdit',updated_at='$today' WHERE id='$productId'";
        $con->query($query) or die($con->error);
        echo 'success';
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }

?>