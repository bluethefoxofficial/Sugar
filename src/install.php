<?php include("core/json.php"); 
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
?>
<html>
	<head>
		<link rel="icon" href="img/SIBc.png">
		<title>Sugar installation</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
	</head>
		<body height="100%">
		<p>Installation</p>
		<div class="h-100 row align-items-center">
  <div class="col">
  <center>
  <?php
  
  if($_GET['install'] == 2){
	    echo '
		<h3>Installation step 1 Database and admin account</h3>
		<form action="install.php" method="post">
		
		  <div class="form-group">
  <div class="col-3">
  <input type="text" name="dbu" width="200px" required class="form-control input-sm" placeholder="database username" />
  <input type="text" name="dbp" width="200px" required class="form-control input-sm" placeholder="database password" />
  <input type="text" name="db" width="200px" required class="form-control input-sm" placeholder="database" />
  <input type="text" name="dbh" width="200px" required class="form-control input-sm" placeholder="host" value="localhost" />
  <input type="text" hidden name="install" value="3" />
  <p>Admin/owner account</p>
  <input type="text" name="username" width="200px" required class="form-control input-sm" placeholder="admin username" value="username" />
  <input type="text" name="email" width="200px" required class="form-control input-sm" placeholder="admin email" value="email" />
  <input type="text" name="password" width="200px" required class="form-control input-sm" placeholder="admin password" value="password" />
  <textarea type="text" name="bio" width="200px" required class="form-control input-sm" placeholder="admin bio" value="password" ></textarea>
  </div>
  </div>
		<button class="btn btn-success">next</button>
		</form>';
	  
  }elseif($_POST['install'] == 3){
	  $servername = $_POST['dbh'];
$usernamedb = $_POST['dbu'];
$password = $_POST['dbp'];
$dbname = $_POST['db'];
$username = $_POST['username'];
$email = strip_tags($_POST['email']);
// Create connection
$conn = mysqli_connect($servername, $usernamedb, $password, $dbname);
// Check connection
if (!$conn) {
	    echo '<img src="img/SIB.png" height="100" width="100"></img><br/>
<h1>OHNO! your database isnt setup correctly try again by clicking back</h1>
  <a href="#" onlcick="document.back();">Back</a>
  <a href="install.php?install=4">Next</a>';
}
// sql to create table
$sql = "CREATE TABLE ". $username ." (
id LONGTEXT, 
username LONGTEXT,
password LONGTEXT,
profilepicture LONGTEXT,
role LONGTEXT,
ban LONGTEXT,
token LONGTEXT,
email LONGTEXT,
bio LONGTEXT
);";
if (mysqli_query($conn, $sql) === TRUE) {
	$sql = "INSERT INTO ". $username ." (id, username, password, email, profilepicture, role, ban, token, bio)
VALUES ('". rand(100,999).rand(100,999).rand(100,999).rand(100,999).rand(100,999).rand(100,999).rand(100,999999999)."', '". strip_tags($username) ."', '". password_hash($_POST['password'],PASSWORD_BCRYPT)."', '". $email ."', 'novalue', 'Admin', '0', '". generateRandomString(rand(10,99)) ."','". $_POST['bio'] ."')";

if (mysqli_query($conn, $sql) === TRUE) {
	mkdir("posts/". $_POST['username']. "/");
mkdir("posts/". $_POST['username']. "/uploads/");
$myObj->copyright = "BLUETHEFOX 2018";
$myObj->version = "1.0.0";
$myObj->dbusername = $dbusername;
$myObj->dbpassword = $password;
$myObj->dbhost = $servername;
$myObj->db = $dbname;
$myJSON = json_encode($myObj);
file_put_contents("config/config.json", $myJSON);
	    echo '<img src="img/SIB.png" height="100" width="100"></img><br/>
<h1>Great your database and admin account is setup now time for the customization</h1>
  <a href="install.php?install=2">Back</a>
  <a href="install.php?install=4">Next</a>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
} else {
    echo "Error creating table: " . mysqli_error($conn);
	
}


  }elseif($_GET['install'] == 4){
	  	    echo '
		<h3>Installation COMPLETE</h3>
		
		<p>to edit your style please go into config/style.json in your Sugar location</p>
		<p>delete this file to prevent security issues</p>';
  }else{
  echo '<img src="img/SIB.png" height="100" width="100"></img><br/>
<h1>WELCOME to the install of Sugar image board the open source image board</h1>
  <a href="install.php?install=2">Next</a>';
  }
  ?>
  </center>
  </div>
</div>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>