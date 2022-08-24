<?php
    include('connection.php');
    $con = connect();
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');
    $file = $_FILES['carouselFile']['name'];
        $tmpName = $_FILES['carouselFile']['tmp_name'];
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg','png','jpeg');

        if(in_array($fileExtension, $allowedExtensions)){

            $filepath = "../Carousel/".uniqid().'.'.$fileExtension;
            move_uploaded_file($tmpName, $filepath);
            $filepath = str_replace("../","",$filepath);

            $productFile = $filepath;    
            
            $query = "INSERT INTO carousel_files(`image`,`created_at`,updated_at)VALUES('$productFile','$today','$today')";
            $con->query($query) or die($con->error);

            $query = "SELECT * FROM carousel_files WHERE id=LAST_INSERT_ID()";
            $product = $con->query($query) or die($con->error);
            $row = $product->fetch_assoc();
            echo json_encode($row);

        }

       
?>