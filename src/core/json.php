<?php
$json = file_get_contents("config/config.json");
$json2 = file_get_contents("config/style.json");
$obj = json_decode($json);
$obj2 = json_decode($json2);
$dpfp = $obj2->{'defaultprofilepicture'};
$allowuploading = $obj2->{'allowuploading'};
$logo = $obj2->{'logo'};
$name = $obj2->{'name'};
$copyright = $obj2->{'copyright'};
$showversion = $obj->{'showversion'};
$usernamedb = $obj->{'dbusername'};
$password = $obj->{'password'};
$version = $obj->{'version'};
$db = $obj->{'db'};
$dbhost = $obj->{'dbhost'};
?>