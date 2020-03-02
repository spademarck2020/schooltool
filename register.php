<?php 
	session_start();

	include_once("connections/connection.php");
	$con = connection();
	// variable declaration
	$username = "";
	$first_name = "";
	$last_name = "";
	// $access = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$ifAdmin = "";
	// connect to database
	$db = mysqli_connect('localhost', 'root', 'mark6222', 'classroom_rfid_system');
	// $db = mysqli_connect('localhost', 'id12630875_root', 'mark6222', 'id12630875_classroom_rfid_system');


	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		// $access = mysqli_real_escape_string($db, $_POST['access']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		// $ifAdmin = mysqli_real_escape_string($db, $_POST['admin_auth']);

		$sql = "SELECT * FROM user_list WHERE username = '$username'";

    	$user = $con->query($sql) or die ($con->error);
    	$row = $user->fetch_assoc();
		$total = $user->num_rows;
		
		// if username already exist
    	if($total > 0){
			echo "Username already exist.";
    	}
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($first_name)) { array_push($errors, "First Name is required"); }
		if (empty($last_name)) { array_push($errors, "Last Name is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0 && $total == 0) {
			$password = $password_1;//encrypt the password before saving in the database
			$query = "INSERT INTO user_list (first_name,last_name,username, password) 
					  VALUES('$first_name','$last_name','$username', '$password')";
			mysqli_query($db, $query);


			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			echo header("Location: home.php");
		}

	}
?>
<!DOCTYPE html>
<html>
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
	<!-- <div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>


		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="first_name" value="<?php echo $first_name; ?>">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="last_name" value="<?php echo $last_name; ?>">
		</div>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div>
		<div class="input-group">
		<label>Access Mode</label>
        <select name="access" id="access">
            <option value="administrator" >Administrator</option>
            <option value="guest" >Guess</option>
            <br/>
        </select>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form> -->

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <!-- <a class="navbar-brand" href="img/dhvsu_cea_logo.png">RFID CLASSROOM SYSTEM</a> -->
  <img src="img/dhvsu_logo.png" alt="College of Engineering and Architecture" height ="90" width="120">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div>
	<h1 style="color:#873600; font-family:verdana;">    INSTRUCTOR LOGS DHVSU</h1>
  </div>
</nav>
</br>
<form class="" method="post" action="register.php">
	<?php include('errors.php'); ?>
  <fieldset>
    <legend>Register Page</legend>

        <div class="form-group">
			<label>First Name</label>
			<input type="text" name="first_name" class="form-control" class="form-control mr-sm-2" value="<?php echo $first_name; ?>">
        </div>
        <div class="form-group">
        	<label>Last Name</label>
			<input type="text" name="last_name" class="form-control" class="form-control mr-sm-2" value="<?php echo $last_name; ?>">
        </div>
        <div class="form-group">
        	<label>Username</label>
			<input type="text" name="username" class="form-control" class="form-control mr-sm-2" value="<?php echo $username; ?>">
        </div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password_1" class="form-control" class="form-control mr-sm-2">
        </div>
		<div class="form-group">
			<label>Confirm password</label>
			<input type="password" name="password_2" class="form-control" class="form-control mr-sm-2">
        </div>
		<!-- <div class="form-group">
		<label>Access Mode</label> -->
        <!-- <select name="access" id="access" class="form-control" class="form-control mr-sm-2">
            <option value="administrator" >Administrator</option>
            <option value="guest" >Guess</option>
			<-- <?php if($admin == "administrator"){ ?>
				<input type="password" name="accessAdmin" class="form-control" class="form-control mr-sm-2">
				<?php if($ifAdmin == "1234"){ ?>
				<?php	$admin = "administrator"; ?>
				<?php } else{ ?>
				<?php  $admin = "guest"; ?>
				<?php }} ?> -->
        <!-- </select> -->
		<!-- </div> -->
		<!-- <div class="form-group">
			<label>Admin Authentication</label>
			<input type="password" name="admin_auth" class="form-control" class="form-control mr-sm-2">
			<?php if($ifAdmin == "admin"){ ?>
				<?php	$access = "administrator"; ?>
				<?php } else{ ?>
				<?php  $access = "guest"; ?>
				<?php } ?>
        </div> -->
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="reg_user">Register</button>
		</div>
			Already a member? <a href="index.php">Sign in</a>

  </fieldset>
</form>


</body>
</html>