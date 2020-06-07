<?php 
	include('functions.php');
	include('core/json.json');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}




?>
<?php include("core/json.php"); ?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title><?php echo $name; ?> - User control panel</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php include("core/menu.php"); ?>
</head>
<body>
<center>
<div class="jumbotron">
<h1>User control panel</h1>
		<br/>
		<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo $usertype; ?>)</i> 
						<br>
						<a href="core/logout.php" style="color: red;">logout</a>
					</small>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="profile" aria-selected="false">Posts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="contact" aria-selected="false">Settings</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><p>111</p></div>
  <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="profile-tab"><p><div class="row">
  <div class="col-lg-6">
  
  <?php

$conn = mysqli_connect($dbhost, $usernamedb, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, author, posttimestamp FROM posts";
$result = mysqli_query($conn, $sql);
$value = 0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		if($row["author"] == $_SESSION['user']['username']){


			
        echo '<div class="card">
  <a href="view.php?id='. $row["id"] .'"><img class="" width="10%" src="posts/'. $row["id"] .'/'. $row["id"].'.png" alt="'. $row["title"] .'"></a>
  <div class="card-body">
    <h5 class="card-title">'. $row["title"] .'</h5>
    <p class="card-text">'. $row["description"] .'</p>
    <p class="card-text"><small class="text-muted">posted on: '. date("F j, Y, g:i a", $row["posttimestamp"]) .'</small> 
	<form method="post" action="" > 
	<input hidden value="'. $row["id"] .'" name="id" /> 
	<input hidden value="'. $row["author"] .'" name="author" /> 
	<input type="submit" class="btn btn-danger" name="deletepost_btn" value="Delete Post!" />  
	</form>
	</p>
  </div>
</div>';
$value += 1;
		}
    }
} else {
    if($value == 0){
		
		echo '
				<div class="alert alert-dark" role="alert">
				sorry but you havent posted anything post something by clicking <a href="upload.php">here</a>
</div>';
		
	}
}

?></p>
<p class="margin: auto;">total of posts <?php echo $value; ?></p></div></div>
</div>
  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="contact-tab"><p>
  <form>
  <p>profile picture</p>
  <input type="file" name="file" class="btn btn-success" />

	<input type="submit" class="btn btn-success" value="Set as new profile picture" />
  </form>  
  
  
  
  
  
  </p></div>
</div>
				<?php endif ?>
				</center>
</div>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>