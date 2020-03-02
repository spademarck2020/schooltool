<?php

//<link rel="stylesheet" type="text/css" href= "bootstrap.css"/>
//<script type="text/javascript" src="bootstrap.js"></script>
if(!isset($_SESSION)){
    session_start();
}

// if(isset($_SESSION['UserLogin'])){
//     echo "Welcome " . $_SESSION['UserLogin'];
// }else{
//     echo "Welcome Guest";
// }

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM instructor_list ORDER BY uid DESC";
$instructors = $con->query($sql) or die ($con->error);
$row = $instructors->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classroom Rfid System</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <!-- <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css"> -->
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
        <a class="nav-link" href="bldg.php">BLDG(room)</a>
      </li>
      <!-- <?php if($_SESSION['Access'] == "administrator"){?>
      <li class="nav-item">
        <a class="nav-link" href="add.php">Add New Instructor</a>
      </li>
      <?php } ?> -->

      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <!-- <form class="form-inline my-2 my-lg-0" action="result.php" method="get"> 
        <input type="text" name="search" id="search" class="form-control mr-sm-2" placeholder="Search">
        <button type="submit" class="btn btn-secondary my-2 my-sm-0">Search</button>
      </form> -->
  </div>
</nav>

<h2>DHVSU VISION</h2>
<p>A lead university in producing quality individuals with competent capacities to generate knowledge and technology and enhance
professional practices for sustainable national and global competitiveness through continuous innovation.</p>
</br>
<h2>DHVSU MISSION</h2>
<p>DHVSU commits itself to provide an environment conducive to continuous creation of knowledge and technology towards
the transformation of students into globally competitive professionals through the synergy of the appropriate teaching,
research, service and productivity functions.</p>
</br>
<h2>ABOUT THE SYSTEM</h2>
<p>This system database monitors the attendance per class of instructors in DHVSU. This allows easy access to instructors'
data by additional features such as search by date, search by name and view by room. Through this, productivity rate
can be monitored.</p>


</body>