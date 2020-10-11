<?php include("core/json.php"); ?>

<?php include("functions.php"); ?>

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

if(!$_SESSION['user']['username']){

	

	echo "<center><p>Access denied please login</p></center></body>		<footer>

		<center>&copy; ". $copyright. "</center>

		</footer>";

	exit();

	

}elseif($_SESSION['user']['username'] == null){

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

<?php


if($_SESSION['error']){

?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong><?PHP echo $_SESSION['error']; ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php

}elseif($_SESSION['success']){

?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?PHP echo $_SESSION['success']; ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
}
?>
	<form id="uploadform" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data" >









  <input class="btn btn-success" type="file" width="500px" name="file" id="fileInput" />

  <br/>

  <label>Thumbnale of post</label>

  <br/>

  

  <script>

  //redundent

function toggleDiv(id) {

    var div = document.getElementById(id);

    div.style.display = div.style.display == "none" ? "block" : "none";

}

</script>



	<input name="nop" placeholder="name of the post" class="form-control" />

	<textarea name="description" class="form-control"></textarea>

	    <label for="type">type of content</label>

    <select name="type" class="form-control" id="type">

      <option>music</option>

      <option>art</option>

      <option>photography</option>

    </select>

	<input type="hidden" value="uploadform" name="<?php echo ini_get("session.upload_progress.name"); ?>">

	<input type="submit" name="post_btn" class="btn btn-success" value="Post!" id="submit" >



	<script>

	//	var btn = document.getElementById("submit");

		btn.onclick = function() {





			$('#upload').modal({

				keyboard: false,

				show: true,

				backdrop: 'static'

			})





		};









	</script>

<div class="modal" id="upload" tabindex="-1" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Uploading... </h5>

      </div>

      <div class="modal-body">

        <p>Post uploading.</p>

      </div>

      <div class="modal-footer">

      </div>

    </div>

  </div>

</div>

	</form>

	</p>

  </div>

</div>

		</body>

		<footer>

		<center>&copy; <?php print($copyright); ?></center>

		</footer>

</html>