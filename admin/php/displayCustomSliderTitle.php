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
            $gridTitle = $row['grid_title'];
            $openingTitle = $row['opening_title'];
            $openingSubtitle = $row['opening_subtitle'];
            $date = $row['updated_at'];
            $productArray[] = array(
                'id' => $id,
                'slider_title' => $image,
                'grid_title' => $gridTitle,
                'opening_title' => $openingTitle,
                'opening_subtitle' => $openingSubtitle,
                'updated_at' => $date
            );
        }
        echo json_encode($productArray);
    }
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>