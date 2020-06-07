<?php
$json = file_get_contents("config/config.json");
$json2 = file_get_contents("config/style.json");
$config = json_decode($json);
$style = json_decode($json2);
$dpfp = $style->{'defaultprofilepicture'};
$allowuploading = $style->{'allowuploading'};
$logo = $style->{'logo'};
$navbarcolour = $style->{'navbarcolour'};
$navbarfontcolour = $style->{'navbarfontcolour'};
$bodycolour = $style->{'bodycolour'};
$background = $style->{'background'};
$name = $style->{'name'};
$copyright = $style->{'copyright'};
$showversion = $style->{'showversion'};
$usernamedb = $config->{'dbusername'};
$password = $config->{'dbpassword'};
$nsfw = $style->{'nsfw'};
$version = file_get_contents("../version.txt");
$db = $config->{'db'};
$dbhost = $config->{'dbhost'};
$limit = $style->{'showlimit'};
$userlimit = $style->{'userlimit'};
$skipindex = $style->{'skipsearchscreen'};
?>