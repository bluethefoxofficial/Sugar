<?php
include("../core/json.php");
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
if($_COOKIE['token'] == null){
	
	header("Location: login.php");
	
	
}elseif($_COOKIE['token'] == $token)









?>