<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('connection.php');
        $con = connect();
        $searchProductInput = $_POST['searchProductInput'];
        $query = "SELECT * FROM `products` WHERE name LIKE '%$searchProductInput%' OR description LIKE '%$searchProductInput%'";
        $result = mysqli_query($con,$query);
        $productArray = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $name = $row['name'];
                $image = $row['image'];
                $description = $row['description'];
                $available = $row['quantity'];
                $price = $row['price'];
                $productArray[] = array(
                    'id' => $id,
                    'name' => $name,
                    'image' => $image,
                    'description' => $description,
                    'available' => $available,
                    'price' => $price,
                );
            }
            echo json_encode($productArray);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>