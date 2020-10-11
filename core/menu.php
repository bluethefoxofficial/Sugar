<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src='js/spectrum.js'></script>

<link rel='stylesheet' href='css/spectrum.css' />

<link rel='stylesheet' href='mainpagestyle.css' />

<?php

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

<button class="btn btn-link" data-toggle="modal" data-target=".bd-example-modal-lg">live style editor</button>

<!--<button class="btn btn-link" id="adminnavbtn">X</button> -->

</div>

<script>

   function slideToggle() {

       var content = document.getElementById('hidden_content');

       var style = window.getComputedStyle(content);



       style['display'] == 'none' ? slideDown(content) : slideUp(content)

   }

   var btn = document.getElementById('adminnavbtn');

   btn.addEventListener('click', function(){

       slideToggle();

   })

          function slideUp(content) {

           content.style.overflow = 'hidden';

           var i = content.clientHeight;

           var totalHeight = content.clientHeight;

           var loop = setInterval(function(){

               if(content.clientHeight == 0) {

                   clearInterval(loop);

                   content.style.display = 'none';

                   content.style.height = totalHeight+'px';

               }

               content.style.height = i+'px';

               i -= 1;

           }, 10);

       }



       function slideDown(content) {

           content.style.overflow = 'hidden';

           content.style.display = 'block';

           var totalHeight = content.clientHeight;



           content.style.height = 0;

           var i = 0;

           var loop = setInterval(function(){

               if(content.clientHeight == totalHeight) {

                   clearInterval(loop);

               }

               content.style.height = i+'px';

               i += 1;

           }, 10);

       }



</script>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="jumbotron">

      <form method="post">

	  <br/>

	  <p>Background color of navbar</p>

	  <input type='text' class="flat" name="navbarset" />

	    <p>foreground color(Text) of navbar</p>

	  <input type='text' class="flat2" name="navbarfontset" />

	  	    <p>mobile toggle colour</p>

	  <input type='text' class="flat3" name="navbartoggleset" />

	  	  	    <p>background colour</p>

	  <input type='text' class="flat4" name="bodybackground" />

	  	<p>text colour</p>

	  <input type='text' class="flat5" name="bodyfont" />

	<p>jumbotron background colour</p>

	  <input type='text' class="flat6" name="jumbotronbackground" />

	  <br/>

	  <input type='submit' class="btn btn-success" value="Set style" name="applyskin_btn" />

	  <!-- Just an image -->

<nav id="navbare" class="navbar navbar-light" style="">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#enb" aria-controls="enb" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>

  <div class="collapse navbar-collapse" id="enb">

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" href="#">Test</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#">Test</a>

      </li>

    </ul>

  </div>

</nav>

	  <script>

$(".flat").spectrum({

  

	preferredFormat: "rgb",

change: function(color) {



    $('.navbar').css('background-color',  color.toRgbString(), "; !important")

}

});

$(".flat2").spectrum({



preferredFormat: "rgb",

change: function(color) {

    $('.nav-link').css('color',  color.toRgbString(), "; !important");

    $('.navbar-brand').css('color',  color.toRgbString(), "; !important");

}

});

$(".flat3").spectrum({

  

preferredFormat: "rgb",

change: function(color) {

    $('.navbar-toggler-icon').css('border-color',  color.toRgbString(), "; !important")

}

});

$(".flat4").spectrum({



preferredFormat: "rgb",

change: function(color) {

    $('body').css('background-color',  color.toRgbString(), "; !important")

}

});

$(".flat5").spectrum({

    

preferredFormat: "rgb",

change: function(color) {

    $('body').css('color',  color.toRgbString(), "; !important")

}

});

$(".flat6").spectrum({

 

preferredFormat: "rgb",

change: function(color) {

    $('.jumbotron').css('background-color',  color.toRgbString(), "; !important")

}

});



	  </script>

	 

    </form>

</div>

    </div>

  </div>

</div>

<?php

}

//end of admin check

?>

<style>

.navbar-light .navbar-nav .nav-link {

    

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

<nav class="navbar navbar-expand-lg navbar-light" style="">

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

        break;

        }

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

