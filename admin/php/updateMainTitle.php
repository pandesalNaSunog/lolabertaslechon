<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');
    include('connection.php');
    $con = connect();
    

        $title = $_POST['editMainTitleInput'];
        $query = "SELECT * FROM custom_slider_title";
        $main = $con->query($query) or die($con->error);
        if($mainRow = $main->fetch_assoc()){
            $query = $con->prepare("UPDATE custom_slider_title SET opening_title = ? ,updated_at= ?");
            $query->bind_param("ss", $title, $today);
            $query->execute();
        }else{
            $query = $con->prepare("INSERT INTO custom_slider_title(opening_title,created_at,updated_at) VALUES (?,?,?))";
            $query->bind_param("sss", $title, $today, $today);
            $query->execute();
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
