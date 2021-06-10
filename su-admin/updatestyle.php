<?php 
include('../functions.php');

$json = file_get_contents("../config/config.json");
$json2 = file_get_contents("../config/style.json");
$obj = json_decode($json);
$obj2 = json_decode($json2);
$dpfp = $obj2->{'defaultprofilepicture'};
$allowuploading = $obj2->{'allowuploading'};
$logo = $obj2->{'logo'};
$navbarcolour = $obj2->{'navbarcolour'};
$navbarfontcolour = $obj2->{'navbarfontcolour'};
$bodycolour = $obj2->{'bodycolour'};
$name = $obj2->{'name'};
$copyright = $obj2->{'copyright'};
$showversion = $obj2->{'showversion'};
$usernamedb = $obj->{'dbusername'};
$password = $obj->{'dbpassword'};
$version = file_get_contents("../version.txt");
$db = $obj->{'db'};
$dbhost = $obj->{'dbhost'};
$limit = $obj2->{'showlimit'};
$skipindex = $obj2->{'skipsearchscreen'};



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
<html>
	<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<title><?php echo $name; ?> - Admin control panel</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php include("../core/adminmenu.php"); ?>
<?php


if($_POST['submit']){
	file_put_contents("../style.css", $_POST['content']);
}
?>
</head>
<body>
<center>
<div class="jumbotron">
<h1>Admin control panel - style.css editor</h1>
<form action="" method="post">
<textarea rows="20" name="content" class="form-control" ><?php echo file_get_contents("../style.css"); ?></textarea>
<br/>
<input type="submit" class="btn btn-success" value="edit" name="submit"/>
</form>


</center>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>