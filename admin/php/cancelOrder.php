<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        if($con->connect_error){
            echo $con->connect_error;
        }else{
            $productId = $_POST['globalProductId'];


            $query = "SELECT * FROM orders WHERE id = '$productId'";
            $orderQuery = $con->query($query) or die($con->error);
            $orderRow = $orderQuery->fetch_assoc();

            $productIdsAndQuantities = $orderRow['product_id_and_quantity'];


            $productArray = explode("****", $productIdsAndQuantities);

            foreach($productArray as $product){
                if($product != ""){
                    $productDetails = explode("**", $product);
                    $productQuantity = $productDetails[1];
                    $productId = $productDetails[0];
                    $query = "SELECT * FROM products WHERE id = '$productId'";
                    $productQuery = $con->query($query) or die($con->error);
                    $productRow = $productQuery->fetch_assoc();
                    $currentProductQuantity = $productRow['quantity'];

                    $updatedQuantity = $currentProductQuantity + $productQuantity;
                    
                    $query = "UPDATE products SET quantity = $updatedQuantity WHERE id = '$productId'";
                    $con->query($query) or die($con->error);
                }
            }
            $query = "DELETE FROM orders WHERE id='$productId'";
            $con->query($query) or die($con->error);
            echo 'success';
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?> 