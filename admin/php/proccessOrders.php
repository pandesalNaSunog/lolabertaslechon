<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
       include('connection.php');
       $con = connect();

        if(isset($_POST)){
            $productIds = $_POST['productIds'];
            $productQuantities = $_POST['productQuantities'];

            $products = array();
            $totalPrice = 0;
            foreach($productIds as $key => $productIdsItem){
                $query = "SELECT * FROM products WHERE id='$productIdsItem'";
                $product = $con->query($query) or die ($con->error);
                $productRow = $product->fetch_assoc();
                $totalPrice = $totalPrice + $productRow['price'];
                $products[] = array(
                    'id' => $productRow['id'],
                    'name' => $productRow['name'],
                    'quantity' => $productQuantities[$key],
                    'image' => $productRow['image'],
                    'description' => $productRow['description'],
                    'price' => $productRow['price'],
                );
            }

            $total = array(
                'total' => $totalPrice,
            );

            echo json_encode(array(
                'products' => $products,
                'total' => $total
            ));
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>