<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: ../browse.php"); // Redirecting To Home Page
}
?>