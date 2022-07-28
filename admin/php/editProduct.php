<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');

        include('connection.php');
        $con = connect();

        if($con->connect_error){
            echo $con->connect_error;
        }else{

            $file = $_FILES['editfile']['name'];
            $tmpName = $_FILES['editfile']['tmp_name'];
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            $allowedExtension = array('jpg','png','jpeg');

            if(in_array($fileExtension, $allowedExtension)){

                $filepath = '../images/' . uniqid() . '.' . $fileExtension;
                move_uploaded_file($tmpName, $filepath);
                $filepath = str_replace("../","",$filepath);

                $productId = $_POST['productId'];
                $editName = $_POST['editName'];
                $editFile = $filepath;
                $editDescription = $_POST['editDescription'];
                $editQuantity = $_POST['editQuantity'];
                $editPrice = $_POST['editPrice'];

                $query = "UPDATE products SET name='$editName',quantity='$editQuantity',image='$editFile',description='$editDescription',updated_at='$today',price='$editPrice' WHERE id='$productId'";

                $con->query($query) or die($con->error);
                echo 'success';
            }
        // editName.val() || editFile.val() || editDescription.val() || editQuantity.val() || editPrice.val()

    }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>