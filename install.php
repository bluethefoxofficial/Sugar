<!DOCTYPE html>

<?php
if(file_exists("config/config.json")){
header("Location: index.php");
}

?>
<html>
<head>
	<title>Sugar installation</title>
</head>

<body>
	<?php include ("core/json.php"); function generateRandomString($length = 10) { return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))) , 1, $length); } ?>
	<link href="img/SIBc.png" rel="icon">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
	</script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
	</script> 
	<script src="js/bootstrap.min.js">
	</script>

	<p>Installation</p>


	<div class="h-100 row align-items-center">
		<div class="col">
			<center>
				<?php

if ($_GET['install'] == 2) {
    echo '
				        <h3>Installation step 1 Database and admin account</h3>
				        <form action="install.php" method="post">
				        
				          <div class="form-group">
				  <div class="col-3">
				  <p>Sugar config settings</p>
				  <input type="text" name="crh" width="200px" required class="form-control input-sm" placeholder="copyright holder" />
				  
				  <p>Database values</p>
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
} elseif ($_POST['install'] == 3) {
    $servername = $_POST['dbh'];
    $usernamedb = $_POST['dbu'];
    $dbpassword   = $_POST['dbp'];
    $dbname     = $_POST['db'];
    $username   = $_POST['username'];
	$email      = strip_tags($_POST['email']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$user_type  = strip_tags($_POST['user_type']);
	$con = mysqli_connect($servername, $usernamedb, $dbpassword, $dbname);
    mkdir("users/$username/");
    mkdir("users/$username/data/");
    mkdir("users/$username/posts/");
    mkdir("users/$username/profilepictures/");
	copy("img/dpfp.png", "users/$username/profilepictures/1.png");
    $query = " INSERT INTO users
	(username,
	 email,
	 user_type,
	 password,
	 profile_picture)
VALUES      ('$username',
	 '$email',
	 'admin',
	 '$password',
	 '1.png')  ";
    mysqli_query($con, $query);
    $_SESSION['success'] = "New user successfully created!!";
    mkdir("posts/" . $_POST['username'] . "/");
    mkdir("posts/" . $_POST['username'] . "/". "uploads/");
    $myObj->copyright  = $_POST['crh'];
    $myObj->dbusername = $username;
    $myObj->dbpassword = $_POST['dbp'];
    $myObj->dbhost     = $servername;
    $myObj->db         = $dbname;
    $myJSON            = json_encode($myObj);
    file_put_contents("config/config.json", $myJSON);
    echo '<img src="img/SIB.png" height="100" width="100"></img><br/>
				<h1>Great your database and admin account is setup now time for the customization</h1>
				  <a href="install.php?install=2">Back</a>
				  <a href="install.php?install=4">Next</a>';
} elseif ($_GET['install'] == 4) {
    echo '
				        <h3>Installation COMPLETE</h3>
				        
				        <p>to edit your style please go into config/style.json in your Sugar location</p>
				        <p><font color="red">delete this file to prevent security issues</font></p>';
} else {
    echo '<img src="img/SIB.png" height="100" width="100"></img><br/>
				<h1>WELCOME to the install of Sugar image board the open source image board</h1>
				<p>Please read this text carefully this will help you setup the database</p><br/>
				1) create a database with plesk or cpanel by using phpmyadmin<br/>
				2) create a table users with the following sql code:<br/>
				CREATE TABLE `users` (
					`id` int(11) NOT NULL,
					`username` text NOT NULL,
					`email` text NOT NULL,
					`password` text NOT NULL,
					`user_type` text NOT NULL,
					`profile_picture` text NOT NULL
				  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	3)create a table posts with the provided sql code:<br/>
	<code>CREATE TABLE `posts` (
		`id` int(11) NOT NULL,
		`author` text NOT NULL,
		`posttimestamp` datetime NOT NULL,
		`type` text NOT NULL,
		`title` text NOT NULL,
		`description` text NOT NULL
	  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	  COMMIT;</code>
	4) after you have done that click next and follow the steps.<br/>
				  <a href="install.php?install=2">Next</a>';
}

?>
			</center>
		</div>
	</div>


	<footer>
		<center>
			&copy; <?php
			print ($copyright); ?>
		</center>
	</footer>
</body>
</html>