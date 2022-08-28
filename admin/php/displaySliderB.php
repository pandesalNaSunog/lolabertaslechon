<?php
    // if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        // include('connection.php');
        // $con = connect();
        $con = new mysqli ("localhost","root","","lechon-database");
        $query = "SELECT * FROM `slider_b`";
        $result = mysqli_query($con,$query);
        $productArray = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $slider_title = $row['slider_title'];
                $slider_image = $row['slider_image'];
                $slider_caption = $row['slider_caption'];
                $date_captured = $row['date_captured'];
                $created_at = $row['created_at'];
                $updated_at = $row['updated_at'];
                $productArray[] = array(
                    'id' => $id,
                    'title' => $slider_title,
                    'image' => $slider_image,
                    'caption' => $slider_caption,
                    'date_captured' => $date_captured,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                );
            }
            echo json_encode($productArray);
        }
    // }else{
    //     echo header('HTTP/1.1 403 Forbidden');
    // }
?>