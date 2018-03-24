<?php include('functions.php'); ?>
<?php include('core/json.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title> register</title>
	<link rel="stylesheet" href="style.css">
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
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" />
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1" />
		</div>
		<div class="input-group">
			<label>Confirm password</label>
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