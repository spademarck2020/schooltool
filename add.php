<?php

include_once("connections/connection.php");

$con = connection();

if(isset($_POST['submit'])){
    
    $uid = $_POST['uid'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];


    $sql = "INSERT INTO `instructor_list`(`uid`,`first_name`, `last_name`) 
                                VALUES ('$uid','$fname','$lname')"; 
    $con->query($sql) or die ($con->error);

    echo header("Location: home.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
    <title>Classroom Rfid System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <!-- <a class="navbar-brand" href="img/dhvsu_cea_logo.png">RFID CLASSROOM SYSTEM</a> -->
  <img src="img/dhvsu_logo.png" alt="College of Engineering and Architecture" height ="90" width="120">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse show" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
  </div>
</nav>
<form class="" method="post">
  <fieldset>
    <legend>Add Instructor</legend>

    <div class="form-group">
        <label>UID</label>
        <input type="text" name="uid" id="uid" class="form-control">
    </div>
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" id="firstname" class="form-control">
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname" class="form-control">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

  </fieldset>
</form>

</body>
</html>
