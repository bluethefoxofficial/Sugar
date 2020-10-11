	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link rel="stylesheet" href="css/style.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

<?php
if($_SESSION['user']){
	header("Location: browse.php");
}


if(isset($_POST["submit"]))

{

 $name = $_POST["name"];

$email = $_POST["email"];

$password = $_POST["password"];

 

$name = mysqli_real_escape_string($db, $name);

$email = mysqli_real_escape_string($db, $email);

$password = mysqli_real_escape_string($db, $password);

$password = password_hash($password,PASSWORD_BCRYPT);

$sql = "SELECT email FROM users WHERE email='$email'";

$result = mysqli_query($db,$sql);

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

 

if(mysqli_num_rows($result) == 1)

{

 echo "Sorry...This email already exist..";

}

else

{

 $query = mysqli_query($db, "INSERT INTO users (name, email, password)VALUES ('$name', '$email', '$password')");

 

if($query)

{

 echo "you are now registrered to use this website you can now countinue by going to <a href='login.php'>login </a>page <br/><br/><br/><br/><br/><br/><br/>";

}

}

}

?>

<center>

<form method="post" action="">

<fieldset>

<legend>signup Form</legend>

<table width="400" border="0" cellpadding="10" cellspacing="10">

<tr>

<td style="font-weight: bold"><div align="right"><label for="name">Name</label></div></td>

<td><input name="name" type="text" class="input" size="25" required /></td>

</tr>

<tr>

<td style="font-weight: bold"><div align="right"><label for="email">Email</label></div></td>

<td><input name="email" type="email" class="input" size="25" required /></td>

</tr>

<tr>

<td height="23" style="font-weight: bold"><div align="right"><label for="password">Password</label></div></td>

<td><input name="password" type="password" class="input" size="25" required /></td>

</tr>

<tr>

<td height="23"></td>

<td><div align="right">

  <input type="submit" name="submit" value="Register!" />

</div></td>

</tr>

</table>

</fieldset>

</form>

<a href="login.php">login.php</a>

</center>