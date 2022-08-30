<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');

        if(isset($_POST)){
            $orderId = $_POST['order_id'];
            $amount = $_POST['amount'];


           

            $query = "SELECT * FROM orders WHERE id = '$orderId'";
            $orderQuery = $con->query($query) or die($con->error);
            $orderRow = $orderQuery->fetch_assoc();
            $total = 0;
            $product_id_and_quantity = $orderRow['product_id_and_quantity'];


            $productsArray = explode("****", $product_id_and_quantity);
            foreach($productsArray as $product){
                if($product != ""){
                    
                    $productIdAndQuantityArray = explode("**", $product);                
                    $productId = $productIdAndQuantityArray[0];
                    $productQuantity = $productIdAndQuantityArray[1];
                    $query = "SELECT * FROM products WHERE id = '$productId'";
                    $productQuery = $con->query($query) or die($con->error);
                    $productRow = $productQuery->fetch_assoc();
                    
                    $productPrice = $productRow['price'];
                    $total += $productPrice * $productQuantity;
                }
            }

            if($amount >= $total){
                $query = "DELETE FROM orders WHERE id = '$orderId'";
                $con->query($query) or die($con->error);

                $query = "INSERT INTO sales(`order_id`,`amount`,`created_at`,`updated_at`)VALUES('$orderId','$total','$today','$today')";
                $con->query($query) or die($con->error);
                echo 'ok';
            }else{
                echo 'insufficient funds';
            }
            
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>