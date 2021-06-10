<?php include("core/json.php"); include('functions.php');
?>

<html>

	<head>

	<link rel="stylesheet" href="css/bootstrap.min.css">

		<title><?php echo $name; ?> - help</title>

	<link rel="stylesheet" href="css/style.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

<?php include("core/menu.php"); ?>

	</head>

		<body>

		<center><h3 class="display-4">Help</h3></center>

<ul class="nav nav-tabs" id="myTab" role="tablist">

  <li class="nav-item">

    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#sc" role="tab" aria-controls="sc" aria-selected="true">Source code</a>

  </li>

  <li class="nav-item">

    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile management</a>

  </li>

</ul>

<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="sc" role="tabpanel" aria-labelledby="home-tab"> <h3>The source code.</h3>

    <p>The software <?php echo $name; ?> is using the <a href="https://github.com/bluethefoxyt/Sugar">Sugar Image Board(SIB)<img src="img/viewonas.png" width="10" height="10"></img></a> source code an open source image board for any developer.<br/>To download the source code with the installer click the link above.</p></div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  <h3>Configure profile.</h3>

  <p>To configure your profile goto user > settings</p>

   <h3>Edit password</h3>

  <p>You cant in this version.</p>

  </div>

</div>

		</body>

		<footer>

		<center>&copy; <?php print($copyright); ?></center>

		</footer>

</html>