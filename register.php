<?php include('functions.php'); ?>
<?php include('core/json.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "$name - Register"; //title of your image board ?> login</title>
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
	<h2><?php echo "$name - Register"; ?></h2>
</div>
	<form method="post">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" />
		</div>
		<div class="input-group">
			<label>Your Email</label><br/>
			<input type="email" name="email" value="<?php echo $email; ?>" />
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1" />
		</div>
		<div class="input-group">
			<label>Password Confirm</label>
			<input type="password" name="password_2" />
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html>