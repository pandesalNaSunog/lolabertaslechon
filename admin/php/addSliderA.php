<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');

        $file = $_FILES['additionalSliderAFile']['name'];
        $tmpName = $_FILES['additionalSliderAFile']['tmp_name'];
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg','png','jpeg');

        if(in_array($fileExtension, $allowedExtensions)){

            $filepath = "../sliderA/".uniqid().'.'.$fileExtension;
            move_uploaded_file($tmpName, $filepath);
            $filepath = str_replace("../","",$filepath);

            $productFile = $filepath;    
            $sliderTitle = htmlspecialchars($_POST['additionalSliderATitle']);
            $sliderCaption = htmlspecialchars($_POST['additionalSliderACaption']);
            $sliderDateCaptured = $_POST['sliderAdateInput'];
            $query = "INSERT INTO slider_a(`slider_title`,`slider_image`,`slider_caption`,`date_captured`,`created_at`,`updated_at`)VALUES('$sliderTitle','$productFile','$sliderCaption','$sliderDateCaptured','$today','$today')";
            $con->query($query) or die($con->error);

            $query = "SELECT * FROM carousel_files WHERE id=LAST_INSERT_ID()";
            $product = $con->query($query) or die($con->error);
            $row = $product->fetch_assoc();
            echo json_encode($row);

        }
}else{
        echo header('HTTP/1.1 403 Forbidden');
}
       
?>