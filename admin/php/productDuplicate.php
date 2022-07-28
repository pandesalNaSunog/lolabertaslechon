<?php 
//this php file will verify if the inserted data on New product is ALREADY EXISTING
//ProductData: ProductName ProductDescription	Available	Price
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();

        if($con->connect_error){
            echo $con->connect_error;
        }else{
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $productQuantity = $_POST['productQuantity'];
            $productPrice = $_POST['productPrice'];

            $query = "SELECT * FROM `products` WHERE name='$productName' AND quantity='$productQuantity' AND description='$productDescription' AND price='$productPrice'";
            $product = $con->query($query) or die($con->error);
            if($row = $product->fetch_assoc()){
                echo 'may kapareho';
            }else{
                echo 'clear';
            }
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }   
?>