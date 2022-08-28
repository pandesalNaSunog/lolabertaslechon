<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        if($con->connect_error){
            echo $con->connect_error;
        }else{
            $productId = $_POST['image_id'];
            $query = "DELETE FROM slider_a WHERE id='$productId'";
            $con->query($query) or die($con->error);
            echo 'success';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?> 