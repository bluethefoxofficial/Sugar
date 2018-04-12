<?php
// Create a blank image and add some text
$im = imagecreatetruecolor(1080, 1080);
$text_color = imagecolorallocate ( $im , 233, 14, 91);
imagestring($im, 1080, 5, 5,  'This image was not found and this image in in for the replacement', $text_color);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');


imagejpeg($im, "", 100);
// Free up memory

?>