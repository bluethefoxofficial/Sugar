<?php
include ("core/json.php");
include ("functions.php");
 ?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
		<title><?php
echo $name; ?> - help</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php
include ("core/menu.php");
 ?>
	</head>
		<body>

	<?php
$conn = mysqli_connect($dbhost, $usernamedb, $password, $db);

// Check connection

if (!$conn)
	{
	die("Connection failed: " . mysqli_connect_error());
	}

$sql = "SELECT id, author, posttimestamp, type, title, description, repost, repostauthor FROM posts";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
	{

	// output data of each row

	while ($row = mysqli_fetch_assoc($result))
		{
		if ($row["id"] == $_GET['id'])
			{
			$location = 'posts/' . $row["id"] . '/' . $row["id"] . '.png';
			$title = $row["title"];
			$description = $row["description"];
			$type = $row["type"];
			$date = date("F j, Y, g:i a", $row["posttimestamp"]);
			if ($type == "music")
				{
?>

		<audio width="50%" controls>
  <source src="posts/<?php
				echo $row['id'] . "/" . $row['id']; ?>.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<?php
				}
			  else
				{
?>
	<center>

	
	<center><img width="20%" src="<?php
				echo $location; ?>"></img>
		<h1><?php
				echo $title; ?></h1> <p color="grey"><?php
				echo $date; ?>   type of post: <?php
				echo $type; ?></p></center>

		
	</center>
	<?php
				}
			}
		elseif ($row['id'] == null)
			{
			echo "<center>post doesent exist</center>";
			}
		}
	}
  else
	{
	echo "<center>post doesent exist</center>";
	}

?>

		
		</body>
		<footer>
		<center>&copy; <?php
print ($copyright); ?></center>
		</footer>
</html>
