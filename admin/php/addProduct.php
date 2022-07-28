<?php
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
            date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');

    include('connection.php');
    $con = connect();
    if($con->connect_error){
        echo $con->connect_error;
    }else{




        $file = $_FILES['productFile']['name'];
        $tmpName = $_FILES['productFile']['tmp_name'];
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg','png','jpeg');

        if(in_array($fileExtension, $allowedExtensions)){

            $filepath = "../images/".uniqid().'.'.$fileExtension;
            move_uploaded_file($tmpName, $filepath);
            $filepath = str_replace("../","",$filepath);

            $productName = htmlspecialchars($_POST['productName']);
            $productFile = $filepath;
            $productDescription = htmlspecialchars($_POST['productDescription']);
            $productQuantity = $_POST['productQuantity'];
            $productPrice = $_POST['productPrice'];
    
            
            $query = "INSERT INTO products(`name`,`image`,`description`,`quantity`,`price`,`created_at`)VALUES('$productName','$productFile','$productDescription','$productQuantity','$productPrice','$today')";
            $con->query($query) or die($con->error);
        

            $query = "SELECT * FROM products WHERE id=LAST_INSERT_ID()";
            $product = $con->query($query) or die($con->error);
            $row = $product->fetch_assoc();
            echo json_encode($row);

        }

       
        
    }
        }else{
            echo header('HTTP/1.1 403 Forbidden');
        }
?>