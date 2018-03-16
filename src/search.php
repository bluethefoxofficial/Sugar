<?php include("core/json.php"); ?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title><?php echo $name; ?> - search</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php include("core/menu.php"); ?>
	</head>
		<body>
		<center><h3 class="display-4">Your search: <?php echo strip_tags($_GET['q']); ?></h3></center>
		<?php
		$dir = "posts/";
		$q = explode(" ",$_GET['q']);
$page = 1;
$resultsPerPage = 10;

$files = array();

while(($obj = readdir($dir))) {
    $files[] = $fileman;
}

$limit = $page * $resultsPerPage;
($limit > count($files)) ? $limit = count($files) : $limit = $limit;
for($i = ($limit - $resultsPerPage); $i < $limit; $i++) {
   echo($files[$i]);
}
?>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>