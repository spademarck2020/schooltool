<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_list WHERE username = '$username'
     AND password = '$password'";

    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total >0){
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];

        echo header("Location: home.php");
    }else{
        echo "No user found.";
        // echo header("Location: register.php");
    }
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
  <h1 style="color:#873600; font-family:verdana;">    INSTRUCTOR LOGS DHVSU</h1>
</nav>
</br>
    <form class="" method="post">
  <fieldset>
    <legend>Login Page</legend>

        <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" id="username" class="form-control mr-sm-2">
        </div>
        <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" id="password" class="form-control mr-sm-2">
        </div>
        <div class="form-group">
        </br>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
        </div>
        <div class="form-group">
        </br>
        Don't have account yet? <a href="register.php">Sign up</a>
        </div>


  </fieldset>
</form>

</body>
</html>
