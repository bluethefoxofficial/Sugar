function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$profilepicture = '4738783';
			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				mkdir("users/$username");
				mkdir("users/$username/profilepictures");
				mkdir("users/$username/data");
				copy("img/dpfp.png","users/$username/profilepictures/4738783");
				$query = "INSERT INTO users (username, email, user_type, password, profile_picture) 
						  VALUES('$username', '$email', '$user_type', '$password', '$profilepicture')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: su-admin/home.php');
			}else{
				
				$query = "INSERT INTO users (username, email, user_type, password, profile_picture) 
						  VALUES('$username', '$email', $user_type, '$password', '4738783.png')";
				mysqli_query($db, $query);
				mkdir("users/$username");
				mkdir("users/$username/data");
				file_put_contents("users/$username/data/bio.sugar", base64_encode("no bio has been placed in this"));
				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: user.php');				
			}

		}

	}
