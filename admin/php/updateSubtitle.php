<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');
    include('connection.php');
    $con = connect();
    

        $title = $_POST['editSubtitleInput'];
        $query = "SELECT * FROM custom_slider_title";
        $main = $con->query($query) or die($con->error);
        if($mainRow = $main->fetch_assoc()){
            $query = "UPDATE custom_slider_title SET opening_subtitle = '$title',updated_at='$today'";
        }else{
            $query = "INSERT INTO `custom_slider_title`(`openng_subtitle`,`created_at`,`updated_at`) VALUES ('$title','$today','$today');";
        }

        $con->query($query) or die($con->error);

        $query = "SELECT * FROM custom_slider_title";
        $main = $con->query($query) or die($con->error);
        $mainRow = $main->fetch_assoc();

        echo json_encode($mainRow);
            
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>