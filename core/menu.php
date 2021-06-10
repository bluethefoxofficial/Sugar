<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src='js/spectrum.js'></script>

<link rel='stylesheet' href='css/spectrum.css' />

<link rel='stylesheet' href='mainpagestyle.css' />

<?php

$rightbar = "";

include("core/json.php");


if(file_exists("config/config.json")){



}else{

  header("location: install.php");

}

session_start();





?>

<?php

if ($_SESSION['user']['user_type'] == "admin") {

    ?>

<div id="hidden_content" style="min-height: 40px;max-height: 80; width: 100%; background-color: black; overflow: scroll; overflow-y: auto; overflow-x: hidden;" width="100%">

<img width="30" height="30" src="img/SIB.png"></img>

<a class="btn btn-link" href="su-admin/home.php">admin control panel</a>


</div>



<?php

}

//end of admin check

?>

<style>

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

<nav class="navbar navbar-expand-lg navbar-light">

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

		  echo ' <li class="nav-item"><a class="nav-link" href="user.php">'.$_SESSION['user']['username'].'<img width="16" height="16" src="users/'. $_SESSION['user']['username'] .'/profilepictures/'. $profilepicture. '"></img></a></li>';

	  }

	  ?>

      </li>

	  <?php

	  $dir = "plugins/";



// Open the plugins directory, and read its contents and displays as it is put

if (is_dir($dir)){

  if ($dh = opendir($dir)){

    while (($file = readdir($dh)) !== false){

        if($file == ".." ){

        break;

        }

        if($file == "."){

        break;

        }



        if(file_exists("plugins/". $file. "/type.txt")){ }else{

          echo '<div class="alert alert-danger" role="alert">

          ERROR: '. $file.' does not have a type file associated with it.

        </div>';

        }

        if(file_exists("plugins/". $file. "/inactive.txt")){

          continue;

        }

		if(file_get_contents("plugins/". $file. "/type.txt") == "menuplugin"){
      if(file_get_contents("plugins/". $file. "/side.txt") == "right"){
        $rightbar = "plugins/". $file. "/core.php";
      }else{
      include("plugins/". $file. "/core.php");
      }

		}

    }

    closedir($dh);

  }

}

	  ?>

    </ul>

  </div>
  <?php

$dir = "plugins/";
// Open the plugins directory, and read its contents and displays as it is put

if (is_dir($dir)){

if ($dh = opendir($dir)){

while (($file = readdir($dh)) !== false){

    if($file == ".." ){

    break;

    }

    if($file == "."){

    break;

    }


    if(file_exists("plugins/". $file. "/inactive.txt")){

      continue;

    }

if(file_get_contents("plugins/". $file. "/type.txt") == "menuplugin"){
  if(file_get_contents("plugins/". $file. "/side.txt") == "right"){
    include("plugins/". $file. "/core.php");
  }
}
}
closedir($dh);
}
}
?>
</nav>

