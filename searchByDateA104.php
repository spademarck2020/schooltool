<?php

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
$search = $_GET['search'];
$sql_logs = "SELECT * FROM mqtt_data WHERE date LIKE '%$search%' ORDER BY id DESC";
$rfid = $con->query($sql_logs) or die ($con->error);
$row_logs = $rfid->fetch_assoc();


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
    </ul>
      <form class="form-inline my-2 my-lg-0" action="searchByDateA104.php" method="get"> 
        <input type="text" name="search" id="search" class="form-control mr-sm-2" placeholder="Search by date">
        <button type="submit" class="btn btn-secondary my-2 my-sm-0">Search</button>
      </form>
  </div>
</nav>

    <br/>

    <!-- <h2><?php echo $row_logs['room'];?></h2> -->
    <h2>room104</h2>


      </form>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Status</th>
      <th scope="col">Timestamp</th>
      <th scope="col">Date</th>
    </tr>
  </thead>

  <tbody>
    <?php do{ if($row_logs['room'] == "room104"){?>
    <tr class = "table-info">
        <td><?php echo $row_logs['first_name']; ?></td>
        <td><?php echo $row_logs['last_name']; ?></td>
        <td><?php echo $row_logs['status']; ?></td>
        <td><?php echo $row_logs['timestamp']; ?></td>
        <td><?php echo $row_logs['date']; ?></td>
    </tr> 
    <?php }}while($row_logs = $rfid->fetch_assoc()) ?>
    </tbody>
    </tr>
  </tbody>

</body>
</html>