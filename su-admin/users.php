
<?php 
include('../functions.php');
include('..core/json.php');

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
</head>
<body>
<center>
<div class="jumbotron">
<h1>Admin control panel > user manager</h1>
		<br/>
		<?php  if (isset($_SESSION['user'])) : ?>
					<strong>list of users and there roles</strong>

<?php

// Create connection
$conn = new mysqli($dbhost, $usernamedb, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
				<?php endif ?>
</div>
</center>
		</body>
		<footer>
		<center>&copy; <?php echo $copyright; ?></center>
		</footer>
</html>