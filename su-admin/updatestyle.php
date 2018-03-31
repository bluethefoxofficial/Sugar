<?php 
include('../functions.php');
include('../core/json.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<?php include("core/json.php"); ?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title><?php echo $name; ?> - Admin control panel</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php include("../core/menu.php"); ?>
</head>
<body>
<center>
<div class="jumbotron">
<h1>Admin control panel - style.css editor</h1>
<form action="">
<textarea class="form-control"></textarea>
<input type="submit" value="edit" name="submit"/>
</form>
</center>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>