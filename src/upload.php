<?php include("core/json.php"); ?>
<html>
	<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<?php

include("core/menu.php")

?>
	</head>
		<body>
		<?php
if(!$token == $_COOKIE['token']){
	
	echo "<center><p>Access denied please login</p></center></body>		<footer>
		<center>&copy; ". $copyright. "</center>
		</footer>";
	exit();
	
}elseif($_COOKIE['token'] == null){
		echo "<center><p>Access denied please login</p></center></body>		<footer>
		<center>&copy; ". $copyright. "</center>
		</footer>";
		exit();
}
?>
		<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4"><?php echo $username; ?></h1>
    <p class="lead">

	<?php if(!$allowuploading == true){
	    echo "<center><p>File uploading is disabled by the administrators</p></center>";
		exit();
		
	}
	?>
	<form>

	<div id="dropContainer" style="border:1px solid black;height:200px; background-color: grey;">
   <center>Drop Image Here
   <br/>
   </center>
</div>

<input type="checkbox" onclick="toggleDiv('fileInput');toggleDiv('dropContainer');">toggle file input dialog</input>
  <input type="file" width="500px" style="display: none;" name="file" id="fileInput" />
  <script>
function toggleDiv(id) {
    var div = document.getElementById(id);
    div.style.display = div.style.display == "none" ? "block" : "none";
}
</script>
		<script>
	// dragover and dragenter events need to have 'preventDefault' called
// in order for the 'drop' event to register. 
// See: https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Drag_operations#droptargets
dropContainer.ondragover = dropContainer.ondragenter = function(evt) {
  evt.preventDefault();
};

dropContainer.ondrop = function(evt) {
  // pretty simple -- but not for IE :(
  fileInput.files = evt.dataTransfer.files;
  document.getElementById("dropContainer").style.backgroundColor = "green";
  evt.preventDefault();
};
	</script>
	<input name="nameofpoast" placeholder="name of the post" class="form-control" />
	</form>
	</p>
  </div>
</div>
		</body>
		<footer>
		<center>&copy; <?php print($copyright); ?></center>
		</footer>
</html>