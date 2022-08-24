<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    include('connection.php');
    $con = connect();
    $imageId = $_POST['globalProductId'];

    $query = "DELETE FROM carousel_files WHERE id='$imageId'";
    $con->query($query) or die($con->error);
    echo 'success';
}else{
    echo header('HTTP/1.1 403 Forbidden');
}
?> 