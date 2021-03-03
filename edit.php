<?php

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM instructor_list WHERE uid = '$id'";
$instructors = $con->query($sql) or die ($con->error);
$row = $instructors->fetch_assoc();

if(isset($_POST['submit'])){
    
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $uid = $_POST['uid'];

    $sql = "UPDATE instructor_list SET uid = '$uid', first_name= '$fname',
    last_name = '$lname' WHERE uid = '$id'";
    $con->query($sql) or die ($con->error);

    echo header("Location: details.php?ID=".$id);

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
    <legend>Edit Instructor</legend>

    <div class="form-group">
        <label>UID</label>
        <input type="text" class="form-control" name="uid" id="uid" value ="<?php echo $row['uid'];?>">
    </div>
    <div class="form-group">
        <label>first Name</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value ="<?php echo $row['first_name'];?>">
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value ="<?php echo $row['last_name'];?>">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

  </fieldset>
</form>
</body>
</html>
