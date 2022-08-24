<?php

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $product_id = $_POST['productId'];
        $query = "SELECT * FROM orders WHERE id='$product_id'";
        $result = mysqli_query($con,$query);
        $productArray = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $customer_name = $row['customer_name'];
                $customer_address = $row['customer_address'];
                $product_id_and_quantity = $row['product_id_and_quantity'];
                $created_at = $row['created_at'];
                $updated_at = $row['updated_at'];
                $order_type = $row['order_type'];
                $date_and_time = $row['date_and_time'];
                $contact_number = $row['contact_number'];
                $products = array();
                $quantities = array();
                $total = 0;
                $eachProductResponse = array();
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
                        $eachProductResponse[] = array(
                            'product' => $productRow,
                            'quantity' => $productQuantity,
                        );

                    }
                }


                $productArray[] = array(
                    'id' => $id,
                    'customer_name' => $customer_name,
                    'customer_address' => $customer_address,
                    'products' => $eachProductResponse,
                    'total_price' => $total,
                    'created_at' => date_format(date_create($created_at), "M d, Y h:i A"),
                    'updated_at' => $updated_at,
                    'order_type' => $order_type,
                    'date_and_time' => $date_and_time,
                    'contact_number' => $contact_number,
                );
            }
            echo json_encode($productArray);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
    
?>