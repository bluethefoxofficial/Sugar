
<?php


//------------------------
// do not edit unless you know exactly what your doing
//
// developer bluethefox
//	(C)bluethefox 2018
//
//
//------------------------
session_start();
include ('core/json.php');




//delete folder function used in deletepost and plugins
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}

//end of delete code



$db = mysqli_connect($dbhost, $usernamedb, $password, $db);
$username = "";
$email = "";
$errors = array();


if($_COOKIE['token'] == ""){
	session_destroy();
}else{
	
	$sqls = "SELECT * FROM tokens WHERE TOKEN LIKE '". $_COOKIE['token']."';";
	//echo $sqls;
	
	$result = mysqli_query($db, $sqls);
	
	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
	  while($row = mysqli_fetch_assoc($result)) {
		$_SESSION['user']['username'] = $row['user'];
		$_SESSION['profilepicture'] = $row['profile_picture'];
	  }
	} else {
	  session_destroy();
	}
}


if($nsfw == true){


	if(!$_COOKIE['aou']){
?>
<style>
#dimScreen
{
    position:fixed;
    padding:0;
    margin:0;

    top:0;
    left:0;

    width: 100%;
    height: 100%;
    background:url("<?php echo $background; ?>");
	z-index: 100;
}
</style>



<div id="dimScreen">

<div style="  width: 50%; margin: 0 auto;">
<h1>age check.</h1>
<p>Are you over 18 years of age?</p>
<a class="btn btn-info" href="#" onclick="document.cookie='aou=true'; checked();">Yes i am let me proceed.</a>
<br/>
<a class="btn btn-info" href="https://google.com/">Im not over 18 GET ME OUT OF HERE!</a>
</div>
<script>
function checked(){

	var ad = document.getElementById("dimScreen");
	ad.remove(); 
}
</script>

</div>

<?php
	}else{}
}else{}

//userdatacheck
$sqlu = "SELECT * FROM users WHERE username LIKE '". $_SESSION['user']['username'] ."'";
$resultu = mysqli_query($db, $sqlu);


  while($roww = mysqli_fetch_assoc($resultu)) {
	$profileun = $roww['username'];//username
	$usertype = $roww['user_type'];//usertype
	$bio = $roww['bio'];//bio
	$profilepicture = $roww['profile_picture'];//profile picture
		
  }



if (isset($_POST['register_btn']))
	{
	register();
	}
	if (isset($_POST['deletepost_btn']))
	{
	deletepost();
	}

if (isset($_POST['post_btn']))
	{
	post();
	}
	if (isset($_POST['applyskin_btn']))
	{
	applyskin();
	}

if (isset($_POST['login_btn']))
	{
	login();
	}

if (isset($_GET['logout']))
	{
	session_destroy();
	unset($_SESSION['user']);
	setcookie('token', null, -1, "/"); 
	header("location: ../login.php");
	}

function register()
	{
	global $db, $errors;

	// receive all input values from the form

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];

	// form validation: ensure that the form is correctly filled

	if (empty($username))
		{
		array_push($errors, "Username is required");
		}

	if (empty($email))
		{
		array_push($errors, "Email is required");
		}

	if (empty($password_1))
		{
		array_push($errors, "Password is required");
		}

	if ($password_1 != $password_2)
		{
		array_push($errors, "The two passwords do not match");
		}
		$connul = new mysqli($dbhost, $usernamedb, $password, $db);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "SELECT * FROM users";
		$userper = 0;
		$result = $connul->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$userper +=1;
			}
		} else {
			
		}
		if($userlimit == $userper){
			if($userlimit == 0){

			}else{
			array_push($errors, "ThIs imageboard has reached is maximum user capacity.");
			}
		}

	// register user if there are no errors in the form

	if (count($errors) == 0)
		{
		$password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database
		$profilepicture = '4738783.png';
		if (isset($_POST['user_type']))
			{
			$user_type = $_POST['user_type'];
			$userid = rand(1,999999);
			mkdir("users/$username");
			mkdir("users/$username/profilepictures");
			mkdir("users/$username/data");
			copy("img/dpfp.png", "users/$username/profilepictures/4738783.png");
			file_put_contents("users/$username/data/bio.sugar", base64_encode("no bio has been placed in this"));
			$query = "INSERT INTO users (username, email, password, user_type, profile_picture,id) 
					  VALUES('$username', '$email', '$password', 'user', '$profilepicture',". $userid. ")";
			mysqli_query($db, $query);
			$_SESSION['success'] = "New user successfully created!!";
			header('location: su-admin/home.php');
			}
		  else
			{
				$userid = rand(1,999999);
$query = "INSERT INTO users (username, email, password, user_type, profile_picture,id) 
					  VALUES('$username', '$email', '$password', 'user', '$profilepicture',". $userid. ")";
			if (!mysqli_query($db, $query))
				{
				echo "error: " . mysqli_error($db). "  id>:  ". $userid;
				exit();
				}
			  else
				{
				}

			mkdir("users/$username");
			mkdir("users/$username/profilepictures");
			mkdir("users/$username/data");
			copy("img/dpfp.png", "users/$username/profilepictures/4738783.png");
			file_put_contents("users/$username/data/bio.sugar", base64_encode("no bio has been placed in this"));

			// get id of the created user

			$logged_in_user_id = mysqli_insert_id($db);
			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success'] = "You are now logged in";
			header('location: user.php');
			}
		}
	}

function getUserById($id)
	{
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);
	return $user;
	}
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
function login()
	{
	global $db, $username, $errors;

	// grap form values

	$username = stripslashes(strip_tags($_POST['username']));
	$password = $_POST['password'];
	if (empty($username))
		{
		array_push($errors, "Username is required");
		}

	if (empty($password))
		{
		array_push($errors, "Password is required");
		}

	// attempt login if no errors on form

	if (count($errors) == 0)
		{
		$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1)
			{ // user found
			//check password
			// check if user is admin or user

			$logged_in_user = mysqli_fetch_assoc($results);
			if(!password_verify($password,$logged_in_user['password'])){

				array_push($errors, "Wrong username/password combination");

			}else{
			if ($logged_in_user['user_type'] == 'admin')
				{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['profilepicture'] = $logged_in_user['profile_picture'];
				file_put_contents("users/". $logged_in_user['username']. "/data/enckey.encsugar", md5($logged_in_user['id']));
				file_put_contents("users/". $logged_in_user['username']. "/data/enckeyserver.encsugar", md5($logged_in_user['id'] * $logged_in_user['id']));
				$_SESSION['success'] = "You are now logged in";
				$rans = generateRandomString(55);
				setcookie("token", $rans, 255*255*255*255, "/");
				$sql = "INSERT INTO tokens (token, user, useragent) VALUES ('". $rans ."', '". $username. "', '". $_SERVER['HTTP_USER_AGENT']."')";

if (mysqli_query($db, $sql)) {
  echo "New record created successfully";
  header('location: browse.php');
}else{

}
				
				}
			  else
				{
					$rans = generateRandomString(55);
					setcookie("token", $rans);
					$sql = "INSERT INTO tokens (token, user, useragent) VALUES ('". $rans ."', '". $username. "', '". $_SERVER['HTTP_USER_AGENT']."')";
	
	if (mysqli_query($db, $sql)) {
	  echo "New record created successfully";
	  header('location: browse.php');
	}else{
	
	}
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
				}
			}
			}
		  else
			{
			array_push($errors, "Wrong username/password combination");
			}
		}
	}

function isLoggedIn()
	{
	if (isset($_SESSION['user']))
		{
		return true;
		}
	  else
		{
		return false;
		}
	}

function isAdmin()
	{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin')
		{
		return true;
		}
	  else
		{
		return false;
		}
	}

// escape string

function e($val)
	{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
	}

function display_error()
	{
	global $errors;
	if (count($errors) > 0)
		{
		echo '<div class="error">';
		foreach($errors as $error)
			{
			echo $error . '<br />';
			}

		echo '</div>';
		}
	}

function post()
	{
	

	// Check if image file is a actual image or fake image

	if (isset($_POST["post_btn"]))
		{
			if(strip_tags(stripcslashes($_SESSION['user']['username']) == "")){
			
			}else{
				global $db;
	$id = time();
	mkdir("posts/" . $id);
	$target_dir = "posts/" . $id . "/";
	$target_file = $target_dir .  $id. ".png";
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		$uploadOk = 1;
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		$img = new Imagick($target_file);
        $img->stripImage();
        $img->writeImage($target_file);
        $img->clear();
        $img->destroy();
		$date = new DateTime();
		$type = $_POST['type'];
		$title = strip_tags(stripcslashes($_POST['nop']));
		$desc = strip_tags(stripcslashes($_POST['description']));
		$author = strip_tags(stripcslashes($_SESSION['user']['username']));
		$time = time();
		$query = "INSERT INTO posts (id, author, type, title, description,repost,repostauthor)	VALUES ('". $id ."', '". $author."', '". $_POST['type'] ."', '". $_POST['nop'] ."', '". $_POST['description'] ."',0,0)"; //adds it to the database
		

	if(mysqli_query($db, $query)){
		$_SESSION['success'] = "Post created successfully!";
	}else{
		
		$_SESSION['error'] = "ERROR: check your database config file.";
	}
		}
	}
}

	function deletepost(){
		global $db;
		if($_SESSION['user']['username'] == $_POST['author']){ //check's if the author is the same as the users username
		//if so then delete from database and filesystem(try to)
		$query = "DELETE FROM `posts` WHERE `posts`.`id` =  '". $_POST['id']. "'";
	if(mysqli_query($db, $query)){ //error checking
		//successfully deleted from database now filesystem
		delete_directory("posts/". $_POST['id']. "/");
	}else{
		
		echo 'Error updating database: '.mysqli_error($db). "   sql   :    ". $query; //mysql error
		exit();
	}
		
	}else{
		
		echo 'invalid author'. $_POST['author'];
		
	}

}
		function applyskin(){
		
		
	file_put_contents("mainpagestyle.css"," 



	.navbar{
		
	background-color: ". $_POST['navbarset'] ." !important;
	color: ". $_POST['navbarfontset'] ."	!important;
		
		
	}
	body{
	
	
	background-color: ". $_POST['bodybackground'] ." !important;
	color: ". $_POST['bodyfont'] ." !important;
	}
	.jumbotron{
		
		background-color: ". $_POST['bodybackground'] ." !important;
		
	}
	");
	}