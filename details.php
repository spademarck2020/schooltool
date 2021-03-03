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

$id = $_GET['ID'];

$sql = "SELECT * FROM instructor_list WHERE uid = '$id'";
$instructors = $con->query($sql) or die ($con->error);
$row = $instructors->fetch_assoc();

$sql_logs = "SELECT * FROM mqtt_data ORDER BY id DESC";
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


<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
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
      <?php if($_SESSION['Access'] == "administrator"){?>
      <li class="nav-item">

        <a class="nav-link" href="edit.php?ID=<?php echo $row['uid'];?>">Edit Information</a>  

      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
      <form class="" action="delete.php" method="post"> 
        <?php if($_SESSION['Access'] == "administrator"){?>    
            <button type="submit" name="delete" class="btn btn-secondary my-2 my-sm-0">Delete</button>

        <?php } ?>
        <input type="hidden" name="ID" class="" value="<?php echo $row['uid'];?>">

<!-- 
      <form action="delete.php" method ="post">
    <a href="index.php"><-Back</a>
    <a href="edit.php?ID=<?php echo $row['uid'];?>">Edit</a> -->
  </div>
</nav>
<!-- <?php if($_SESSION['Access'] == "administrator"){?>    
        <button type="submit" name="delete">Delete</button>
<?php } ?>
        <input type="hidden" name="ID" value="<?php echo $row['uid'];?>">
    </form> -->
    <br/>

    <h2><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></h2>
    <!-- <form action="delete.php" method ="post">
      <?php if($_SESSION['Access'] == "administrator"){?>    
        <button type="submit" name="delete" action="delete.php" method="post">Delete Information</button>
        
      <?php } ?>
        <input type="hidden" name="ID" value="<?php echo $row['uid'];?>"> -->
      </form>
    <!-- </form>
    <?php if(isset($_SESSION['UserLogin'])){ ?>
        <a href="logout.php">Logout</a>
    <?php } else{ ?>
        <a href="login.php">Login</a>
    <?php } ?>
    <a href="add.php">Add New</a> -->

    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Room</th>
      <th scope="col">Building</th>
      <th scope="col">Status</th>
      <th scope="col">Timestamp</th>
      <th scope="col">Date</th>
    </tr>
  </thead>

  <tbody>
    <?php do{ if($row_logs['uid'] == $id){?>
    <tr class = "table-info">
        <td><?php echo $row_logs['room']; ?></td>
        <td><?php echo $row_logs['bldg']; ?></td>
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
