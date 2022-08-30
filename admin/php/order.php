<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');
        include('connection.php');
        $con = connect();

        $customerName = $_POST['customerName'];
        $customerAddress = $_POST['customerAddress'];
        $contactNumber = $_POST['CustomerContactNumber'];
        $orderType = $_POST['customerOrderType'];
        $productIds = $_POST['productIds'];
        $productQuantities = $_POST['productQuantities'];

        $newline = "";
        foreach(array_combine($productIds, $productQuantities) as $f => $n) {
            $newline .= "$f**$n****";
        }

        $query = "INSERT INTO `orders`(`customer_name`, `customer_address`, `product_id_and_quantity`,`contact_number`, `created_at`,`updated_at`,`order_type`,`date_and_time`) VALUES ('$customerName','$customerAddress','$newline','$contactNumber','$today','$today','$orderType','$today')";
        $con->query($query) or die($con->error);


        $query = "SELECT * FROM orders WHERE id = LAST_INSERT_ID()";
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

                $updatedQuantity = $currentProductQuantity - $productQuantity;
                
                $query = "UPDATE products SET quantity = $updatedQuantity WHERE id = '$productId'";
                $con->query($query) or die($con->error);
            }
        }
        echo 'success';
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>