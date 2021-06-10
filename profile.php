<?php include("core/json.php"); 	include('functions.php');?>

<html>

	<head>

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link rel="stylesheet" href="css/style.css">

	<title><?php echo $name; ?> - Browse</title>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

<?php include("core/menu.php"); ?>

</head>

<body>



<?php

$u = strip_tags( stripcslashes ($_GET['u']));

			$query = "SELECT * FROM users WHERE username='$u' LIMIT 1";

			$results = mysqli_query($db, $query);

			$row = mysqli_fetch_assoc($results);





?>



	<div class="jumbotron">

	<center><h1><?php echo strip_tags( stripcslashes ($_GET['u'])); ?></h1></center>

			

</div>





		</body>

		<footer>

		<center>&copy; <?php print($copyright); ?></center>

		</footer>

</html>