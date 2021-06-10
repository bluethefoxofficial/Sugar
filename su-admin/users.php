
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
$userlimit = $obj2->{'userlimit'};
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
						// Create connection
						$conn = new mysqli($dbhost, $usernamedb, $password, $db);
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
</head>
<body>
<center>
<div class="jumbotron">
<h1>Admin control panel > user manager</h1>
		<br/>
		
					<strong>list of users and there roles</strong>
					<?php if($userlimit == 0){

					}else{

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users";
$userper = 0;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$userper +=1;
    }
} else {
    
}?>



					<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo  number_format($userper / $userlimit * 100); ?>%" aria-valuenow="<?php echo  number_format($userper / $userlimit * 100); ?>" aria-valuemin="0" aria-valuemax="100"></div>
</div>



<?php

					}
					?>
					<br/>
					<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">User type</th>
	  <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
					<?php  if (isset($_SESSION['user'])) : ?>
					<?php
// Create connection
//$conn = new mysqli($dbhost, $usernamedb, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
		    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['user_type']; ?></td>
	  <td><button class="btn btn-danger btn-sm">delete account</button> <button class="btn btn-danger btn-sm">make admin</button> <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Changes the email and password to make it inaccesible meaning this action cant be undone.">ban account</button> <button class="btn btn-danger btn-sm" >unban account</button></td>
    		</tr>
		<?php
    }
}
$conn->close();
?>
<?php endif ?>
</tbody>
</table>
</div>
</center>
		</body>
		<footer>
		<center>&copy; <?php echo $copyright; ?></center>
		</footer>
</html>