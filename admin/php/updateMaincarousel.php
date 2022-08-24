<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');
    include('connection.php');
    $con = connect();
    $file = $_FILES['carouselFile']['name'];
            $tmpName = $_FILES['carouselFile']['tmp_name'];
            $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            $allowedExtension = array('jpg','png','jpeg');

            if(in_array($fileExtension, $allowedExtension)){

                $filepath = '../Carousel/' . uniqid() . '.' . $fileExtension;
                move_uploaded_file($tmpName, $filepath);
                $filepath = str_replace("../","",$filepath);

                $editFile = $filepath;
                $query = "SELECT * FROM main_carousel_file";
                $main = $con->query($query) or die($con->error);
                if($mainRow = $main->fetch_assoc()){
                    $query = "UPDATE main_carousel_file SET main_image = '$editFile'";
                }else{
                    $query = "INSERT INTO main_carousel_file(`main_image`,`created_at`,`updated_at`)VALUES('$editFile','$today','$today')";
                }

                $con->query($query) or die($con->error);

                $query = "SELECT * FROM main_carousel_file";
                $main = $con->query($query) or die($con->error);
                $mainRow = $main->fetch_assoc();

                echo json_encode($mainRow);
            
            }
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?>