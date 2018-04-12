
<?php


//------------------------
// do not edit unless you know exactly what your doing
//
// developer bluethefox
//	(C)bluethefox 2018
//
//
//------------------------

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
session_start();
include ('core/json.php');


$db = mysqli_connect($dbhost, $usernamedb, $password, $db);
$username = "";
$email = "";
$errors = array();

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
	header("location: ../login.php");
	}

function register()
	{
	global $db, $errors;

	// receive all input values from the form

	$username = e($_POST['username']);
	$email = e($_POST['email']);
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);

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

	// register user if there are no errors in the form

	if (count($errors) == 0)
		{
		$password = md5($password_1); //encrypt the password before saving in the database
		$profilepicture = '4738783.png';
		if (isset($_POST['user_type']))
			{
			$user_type = e($_POST['user_type']);
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

function login()
	{
	global $db, $username, $errors;

	// grap form values

	$username = e($_POST['username']);
	$password = e($_POST['password']);
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
		$password = md5($password);
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1)
			{ // user found

			// check if user is admin or user

			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin')
				{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['profilepicture'] = $logged_in_user['profile_picture'];
				file_put_contents("users/". $logged_in_user['username']. "/data/enckey.encsugar", md5($logged_in_user['id']));
				file_put_contents("users/". $logged_in_user['username']. "/data/enckeyserver.encsugar", md5($logged_in_user['id'] * $logged_in_user['id']));
				$_SESSION['success'] = "You are now logged in";
				header('location: browse.php');
				}
			  else
				{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
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
				global $db;
	$id = rand(100,254654565654);
	mkdir("posts/" . $id);
	$target_dir = "posts/" . $id . "/";
	$target_file = $target_dir .  $id. ".png";
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		$uploadOk = 1;
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		$date = new DateTime();
		$type = $_POST['type'];
		$title = strip_tags(stripcslashes($_POST['nop']));
		$desc = strip_tags(stripcslashes($_POST['description']));
		$query = "INSERT INTO posts (id, author, posttimestamp, type, title, description,repost,repostauthor)
		VALUES ('". $id ."','". $_SESSION['user']['username'] ."','". $date->getTimestamp() ."','". $type ."','". $title ."','". $desc ."',0,'". null ."');"; //adds it to the database
		$_SESSION['success'] = "Post created successfully!";
	if(mysqli_query($db, $query)){
		
		
	}else{
		
		echo 'Error updating database: '.mysqli_error($db);
		exit();
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