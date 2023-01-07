<?php
    function connect(){
        //return new mysqli ("localhost","janicamarcelo","Janica0917","LBLH");
        return new mysqli ("localhost","root","","lechon-database");
    }
    function today(){
        date_default_timezone_set('Asia/Manila');
        return date('Y-m-d H:i:s');
    }
?>
