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
<?php include("../core/adminmenu.php"); 



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://raw.githubusercontent.com/bluethefoxyt/Sugar/master/version.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);



?>
</head>
<body>
<center>
<div class="jumbotron">
<h1>Admin control panel</h1>
		<br/>
		<?php
		if($data == file_get_contents("../version.txt"))
		{
		
		?>
				<div class="alert alert-success" role="alert">
  Sib is up to date | your current version is <?php echo file_get_contents("../version.txt"); ?>
</div>
		<?php
		
		}elseif($data > file_get_contents("../version.txt"))
		{
		?>
		
		<div class="alert alert-danger" role="alert">
  Sib is not up to date download the latest version on the github repo to hide this message and get the latest bug and security patches and have extra features  <p>the github version is <?php echo file_get_contents("https://raw.githubusercontent.com/bluethefoxyt/Sugar/master/version.txt"); ?> | your current version is <?php echo file_get_contents("../version.txt"); ?></p>
</div>
		
		<?php
		}
		?>
		<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="core/logout.php" style="color: red;">logout</a>
					</small>

				<?php endif ?>
</div>
</center>
		</body>
		<footer>
		<center>&copy; <?php echo $copyright; ?></center>
		</footer>
</html>