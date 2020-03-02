<?php

include_once("connections/connection.php");
$con = connection();


if(isset($_POST['delete'])){
    $id = $_POST['ID'];
    $sql = "DELETE FROM instructor_list WHERE uid = '$id'";
    $con->query($sql) or die($con->error);
    echo header("Location: home.php");
}