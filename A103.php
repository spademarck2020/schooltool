<?php



if(!isset($_SESSION)){
    session_start();
}

// if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator"){
//     echo "Welcome " . $_SESSION['UserLogin'];
// }else{
//     echo header("Location: index.php");
// }

include_once("connections/connection.php");
$con = connection();

// $id = $_GET['ID'];

// $sql = "SELECT * FROM instructor_list";
// $instructors = $con->query($sql) or die ($con->error);
// $row = $instructors->fetch_assoc();

$sql_logs = "SELECT * FROM mqtt_data ORDER BY id DESC";
$rfid = $con->query($sql_logs) or die ($con->error);
$row_logs = $rfid->fetch_assoc();

// $uid = array("C9 6B 6A B9","66 37 7F 25","DB 64 AC 21","2A 46 32 00",
// "5B 50 FC 27","CA DE 6A 01","7A B2 83 00","5A 7A 6B 01",
// "DA 8A 5B 01","DB D3 BB 28","1B BF C0 28","DB ED 3C 25",
// "EB F0 86 22");

// for($i = 0; $i < 13; $i += 1){
//   $uid[$i] = $row['uid'];
// }


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
    <h2>room103</h2>
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
    <?php do{ if($row_logs['room'] == "room103"){?>
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
