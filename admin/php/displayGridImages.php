<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();

    $query = "SELECT * FROM `grid_images`";
    $result = mysqli_query($con,$query);
    $productArray = array();
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $title = $row['image_title'];
            $file = $row['image_file'];
            $details = $row['image_details'];
            $updated_at = $row['updated_at'];
            $created_at = $row['created_at'];
            $productArray[] = array(
                'id' => $id,
                'image_title' => $title,
                'image_file' => $file,
                'image_details' => $details,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            );
        }
        echo json_encode($productArray);
    }
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>