<?php
include("core/json.php");
// Create connection
$conn       = mysqli_connect($servername, $usernamedb, $password, $dbname);
// Check connection
if (!$conn) {
    echo '<div class="alert alert-danger" role="alert">No connection to database reason: '. mysqli_connect_error(). '</div>';
}
$sql    = "SELECT id,username,password,token,profilepicture,bio FROM " . $_COOKIE['username'];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        if ($_COOKIE['token'] == $row['token']) {
            $token          = $row['token'];
            $username       = $row['username'];
            $id             = $row['id'];
            $profilepicture = $row['profilepicture'];
            $bio            = $row['bio'];
        } else {
            
            $token          = "";
            $username       = "";
            $id             = "";
            $profilepicture = "";
            $bio            = "";
            
        }
    }
}

?>

<link rel="icon" href="<?php echo $logo; ?>">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        <a class="nav-link" href="login.php">Login/signup</a>
      </li>
    </ul>
  </div>
</nav>