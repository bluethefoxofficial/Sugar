<?php 

// made by bluethefoxyt on github

// furaffinity: bluethefoxyt

//

//

//

//

//

include('functions.php'); //do not change 
if($_SESSION['user']){
	header("Location: browse.php");
}
?>
<?php include('core/json.php'); //do not change ?>

<!DOCTYPE html>

<html>

<head>

	<title><?php echo "$name - Login"; //title of your image board ?> login</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">

	<?php



include("core/menu.php")



?>

</head>

<body>



	<div class="header">

		<h2>Login</h2>

	</div>

	

	<form method="post" action="login.php">



		<?php echo display_error(); ?>



		<div class="input-group">

			<label>Username</label>

			<input type="text" name="username" >

		</div>

		<div class="input-group">

			<label>Password</label>

			<input type="password" name="password">

		</div>

		<div class="input-group">

			<button type="submit" class="btn" name="login_btn">Login</button>

		</div>

		<p>

			Not yet a member? <a href="register.php">Sign up</a>

		</p>

	</form>





</body>

</html>