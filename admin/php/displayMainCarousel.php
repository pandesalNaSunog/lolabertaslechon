<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();

    $query = "SELECT * FROM `main_carousel_file`";
    $result = mysqli_query($con,$query);
    $productArray = array();
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $image = $row['main_image'];
            $date = $row['created_at'];
            $productArray[] = array(
                'id' => $id,
                'image' => $image,
                'created_at' => $date
            );
        }
        echo json_encode($productArray);
    }
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>