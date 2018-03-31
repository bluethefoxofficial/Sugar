<?php
$json = file_get_contents("config/config.json");
$json2 = file_get_contents("config/style.json");
$obj = json_decode($json);
$obj2 = json_decode($json2);
$dpfp = $obj2->{'defaultprofilepicture'};
$allowuploading = $obj2->{'allowuploading'};
$logo = $obj2->{'logo'};
$navbarcolour = $obj2->{'navbarcolour'};
$navbarfontcolour = $obj2->{'navbarfontcolour'};
$bodycolour = $obj2->{'bodycolour'};
$name = $obj2->{'name'};
$copyright = $obj2->{'copyright'};
$showversion = $obj2->{'showversion'};
$usernamedb = $obj->{'dbusername'};
$password = $obj->{'password'};
$version = $obj->{'version'};
$db = $obj->{'db'};
$dbhost = $obj->{'dbhost'};
$limit = $obj2->{'showlimit'};
$skipindex = $obj2->{'skipsearchscreen'};
?>