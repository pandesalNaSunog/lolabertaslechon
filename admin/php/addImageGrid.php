<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');

        $file = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg','png','jpeg');

        if(in_array($fileExtension, $allowedExtensions)){

            $filepath = "../imageGrid/".uniqid().'.'.$fileExtension;
            move_uploaded_file($tmpName, $filepath);
            $filepath = str_replace("../","",$filepath);

            $productFile = $filepath;    
            $title = htmlspecialchars($_POST['title']);
            $details = htmlspecialchars($_POST['details']);
            $query = "INSERT INTO grid_images(`image_title`,`image_file`,`image_details`,`created_at`,`updated_at`)VALUES('$title','$productFile','$details','$today','$today')";
            $con->query($query) or die($con->error);

            $query = "SELECT * FROM grid_images WHERE id=LAST_INSERT_ID()";
            $product = $con->query($query) or die($con->error);
            $row = $product->fetch_assoc();
            echo json_encode($row);

        }
}else{
        echo header('HTTP/1.1 403 Forbidden');
}
       
?>