<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d H:i:s');

        include('connection.php');
        $con = connect();

        if(isset($_POST)){
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $available = htmlspecialchars($_POST['available']);
            $productId = htmlspecialchars($_POST['product_id']);
            $filename = "";
            if(isset($_FILES['image'])){
                $file = $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];
                $extension = strtolower(pathinfo($file,PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg','png','jpeg'];

                if(in_array($extension, $allowedExtensions)){
                    $filename = "../images/" . uniqid() . "." . $extension;
                    move_uploaded_file($tmp,$filename);
                    $filename = str_replace("../","",$filename);
                }
                
            }

            if($filename == ""){
                $queryString = $con->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?");
                $queryString->bind_param('ssdii', $name, $description, $price, $available, $productId);

            }else{
                $queryString = $con->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, image = ? WHERE id = ?");
                $queryString->bind_param('ssdisi', $name, $description, $price, $available, $filename, $productId);
            }

            $queryString->execute();
            echo 'ok';
            
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>