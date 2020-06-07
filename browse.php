<?php include("functions.php"); ?>
<?php include("core/json.php"); 

$_SESSION['success'] = null;
	if (isset($_POST['applyskin_btn']))
	{
	applyskin();
	}

	
?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title><?php echo $name; ?> - Browse</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<style>
.center {
  margin: auto;
  width: 50%;
  padding: 10px;
}
</style>
<?php include("core/menu.php"); ?>
</head>
<body>


<div class="jumbotron">
<h1 style="text-align: center;">Browse</h1>
<div class="row">
<?php
$conn = mysqli_connect($dbhost, $usernamedb, $password, $db);
// Check connection
if (!$conn) {
	$conerror = mysqli_connect_error();
	echo '<div style="margin: auto;" class="alert alert-danger" role="alert">
	Connection error $conerror
  </div>';
    exit();
}

$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($row['type'] == "music"){
			echo '<div class="col-sm-3">
			<div style="border: 1px solid grey; ">
	  <a class="center" href="view.php?id='. $row["id"] .'"><img style="width: 20%" class="card-img-top" src="img/music-icon.png" alt="'. $row["title"] .'"></a>
	  <div class="card-body">
		<h5 class="card-title">'. strip_tags(stripslashes($row["title"])) .'</h5>
		<p class="card-text">'. strip_tags(stripslashes($row["description"])) .'</p>
		<p class="card-text"><p class="text-muted">posted on: '. gmdate("Y-m-d\TH:i:s\Z", $row["posttimestamp"]) .'</p>
		<p class="card-text"><p class="text-muted">author: <a href="profile.php?u='. $row["author"] .'">'. $row["author"] .'</a></p></div></div></div>
		'; 
		}elseif($row['type'] == "other"){
			echo '<div class="col-sm-3">
			<div style="border: 1px solid grey; ">
	  <a class="center" href="view.php?id='. $row["id"] .'"><img style="width: 20%" class="card-img-top" src="img/other.png" alt="'. $row["title"] .'"></a>
	  <div class="card-body">
		<h5 class="card-title">'. strip_tags(stripslashes($row["title"])) .'</h5>
		<p class="card-text">'. strip_tags(stripslashes($row["description"])) .'</p>
		<p class="card-text"><p class="text-muted">posted on: '. gmdate("Y-m-d\TH:i:s\Z", $row["posttimestamp"]) .'</p>
		<p class="card-text"><p class="text-muted">author: <a href="profile.php?u='. $row["author"] .'">'. $row["author"] .'</a></p></div></div></div>
		'; 
		}else{
		echo '<div class="col-sm-3">
		<div style="border: 1px solid grey; ">
  <a class="center" href="view.php?id='. $row["id"] .'"><img style="width: 20%" class="card-img-top" src="posts/'. $row["id"] .'/'. $row["id"].'.png" alt="'. $row["title"] .'"></a>
  <div class="card-body">
    <h5 class="card-title">'. strip_tags(stripslashes($row["title"])) .'</h5>
    <p class="card-text">'. strip_tags(stripslashes($row["description"])) .'</p>
	<p class="card-text"><p class="text-muted">posted on: '. gmdate("Y-m-d\TH:i:s\Z", $row["posttimestamp"]) .'</p>
	<p class="card-text"><p class="text-muted">author: <a href="profile.php?u='. $row["author"] .'">'. $row["author"] .'</a></p></div></div></div>'; 

}
}
} else {
    echo '<div style="margin: auto;" class="alert alert-info" role="alert">
	No posts have been uploaded to this image board currently.
  </div>';
}
?>
</div>
</div>
		</body>
		<footer>
		<div style="border: 10px">
		<center>&copy; <?php print($copyright); ?></center>
		</div>
		</footer>
</html>