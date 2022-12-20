<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();

    $query = "SELECT * FROM `custom_slider_title`";
    $result = mysqli_query($con,$query);
    $productArray = array();
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $image = $row['slider_title'];
            $date = $row['updated_at'];
            $productArray[] = array(
                'id' => $id,
                'slider_title' => strtoupper($image),
                'updated_at' => $date
            );
        }
        echo json_encode($productArray);
    }
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>