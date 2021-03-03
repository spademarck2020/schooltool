<?php

    function connection(){

        $host = "localhost";
        $username = "root";
        // $username = "id12630875_root";
        $password = "mark6222";
        $database = "classroom_rfid_system";
        // $database = "id12630875_classroom_rfid_system";

        $con = new mysqli($host, $username, $password, $database);


        if($con->connect_error){
            echo $con->connect_error;
        }else{
            return $con;
        }
    }
?>