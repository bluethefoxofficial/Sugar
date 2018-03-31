
<?php
include("core/json.php");
session_start();
?>
<style>
.navbar-light .navbar-nav .nav-link {
    color: rgba(<?php echo $navbarfontcolour; ?>);
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: rgba(<?php echo $bodycolour; ?>);
}
</style>
<link rel="icon" href="<?php echo $logo; ?>">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(<?php echo $navbarcolour; ?>) !important; color: rgba(<?php echo $navbarfontcolour; ?>)">
  <a class="navbar-brand" href="index.php"><?php print($name); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="browse.php">Browse</a>
      </li>
     
	  <?php if(!$_SESSION['user']['username']){
        echo ' <li class="nav-item"><a class="nav-link" href="login.php">Login/signup</a></li>';
	  }else{
		  echo ' <li class="nav-item"><a class="nav-link" href="upload.php">upload <img width="16" height="16" src="img/upload.png"></img></a></li>';
		  echo ' <li class="nav-item"><a class="nav-link" href="user.php">'.$_SESSION['user']['username'].'<img width="16" height="16" src="users/'. $_SESSION['user']['username'] .'/profilepictures/'. $_SESSION['user']['profile_picture']. '"></img></a></li>';
	  }
	  ?>
      </li>
	  <?php
	  $dir = "plugins/";

// Open the plugins directory, and read its contents and displays as it is put
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
		
		if(file_get_contents("plugins/". $file. "/type.txt") == "menuplugin"){
      include("plugins/". $file. "/core.php");
		}
    }
    closedir($dh);
  }
}
	  ?>
    </ul>
  </div>
</nav>