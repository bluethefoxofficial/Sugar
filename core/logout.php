<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
setcookie('token', null, -1, "/"); 
header("Location: ../browse.php"); // Redirecting To Browse page.
}
?>