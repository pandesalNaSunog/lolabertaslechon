<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        function connect(){
            // return new mysqli ("localhost","u568496919_lechon","LechonPassword11","u568496919_lechon_db");
            return new mysqli ("localhost","root","","lechon-database");
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>
