<?php
//-------------------
//(C)bluethefox 2018
//WHATEVER YOU DO, DO NOT DELETE THIS FILE SINCE IT IS FUNDIMENTAL TO USERS TO BACKUP THERE DATA
//WHEN YOU DELETE THIS FILE YOU MAKE THEM LOSE THAT FUNCTIONALITY.
//--------------------
$profile = '

"username":"'. $_SESSION['user']['username'] .'",
"password":"'. $_SESSION['user']['password'] .'",
"id":'. $_SESSION['user']['id'] .',
"commentfromapplication":"do not edit any contents of this file or you WILL corrupt your account beyond repair."





';
file_put_contents("../". $_SESSION['user']['username']. "/data/accountbackup.databackup", $profile);
?>