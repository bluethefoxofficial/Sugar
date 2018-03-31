<?php include("core/json.php"); 

if(file_exists("install.php")){
	
	//header("Location: install.php");
}
if($skipindex == false){
	
	
	
}else{
	
	header("Location: browse.php");
	
}
?>
<html>
	<head>
	<link rel="icon" href="<?php echo $logo; ?>">
		<title><?php echo $name; ?> - homepage</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
	</head>
		<body height="100%">
		<p><?php 
		
		if($showversion = true){
		
		echo "Version: ". $version; 
		
		}else{
			
			
		}
		?></p>
		<div class="h-100 row align-items-center">
  <div class="col">
  <center>
  <img src="<?php print($logo); ?>" height="100" width="100"></img><br/>
  <h3><?php print($name); ?></h3>
  
  <form action="search.php">
  <div class="form-group">
  <div class="col-3">
  <a href="help.php">Help</a> <a href="browse.php">Browse</a>  <a href="upload.php">Upload</a>
  <input type="text" name="q" width="200px" class="form-control input-sm" placeholder="Search..." />
  </div>
  </div>
  </form>
  </center>
  </div>
</div>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>