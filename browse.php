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
<?php include("core/menu.php"); ?>
</head>
<body>

<center><h1>Browse</h1></center>
<div class="row">
<?php
$conn = mysqli_connect($dbhost, $usernamedb, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, author, posttimestamp, type, title, description, repost, repostauthor FROM posts";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
		echo '<div class="col-sm-6">
  <a href="view.php?id='. $row["id"] .'"><img class="card-img-top" src="posts/'. $row["id"] .'/'. $row["id"].'.png" alt="'. $row["title"] .'"></a>
  <div class="card-body">
    <h5 class="card-title">'. strip_tags(stripcslashes($row["title"])) .'</h5>
    <p class="card-text">'. strip_tags(stripcslashes($row["description"])) .'</p>
    <p class="card-text"><small class="text-muted">posted on: '. date("F j, Y, g:i a", $row["posttimestamp"]) .'</small><div/>'; 
	if(!$row["title"] = "1"){
			echo '<span>this is a repost repost author is: </div>'. $row["repostauthor"] .'</p>
  </div>
</div>';
	}else{
	echo '<a href="repost.php?id='. $row["id"] .'">Repost</a></div></p>
  </div>
</div>';
	
    }
}
} else {
    echo "</div><p><center>no posts on this image board</center></p>";
}

?>
</div>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>