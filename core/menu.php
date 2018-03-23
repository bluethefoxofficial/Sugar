<?php
include('session.php');
?>
<?php
include("core/json.php");
session_start();
?>

<link rel="icon" href="<?php echo $logo; ?>">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(<?php echo $navbarcolour; ?>) !important;">
  <a class="navbar-brand" href="index.php"><?php print($name); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="browse.php">Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="help.php">Help</a>
      </li>
      <li class="nav-item">
	  <?php if(!$_SESSION['user']['username']){
		  
        echo '<a class="nav-link" href="login.php">Login/signup</a>';
	  }else{
		  echo '<a class="nav-link" href="upload.php">upload</a>';
	  }
	  ?>
      </li>
    </ul>
  </div>
</nav>