<?php
 
header("Content-type: image/png");

$text = "Colibritany";

$imagen = imagecreatefromjpeg('pbzoosm.jpg');
 
$negro = imagecolorallocate($imagen,0,0,0);
 
imagesetpixel($imagen,30,30,$negro);

$fuente = 'fonts/nissanag-regular-webfont.ttf';

// Añadir algo de sombra al texto
imagettftext($imagen, 20, 0, 11, 21, $negro, $fuente, $text);

// Añadir el texto
imagettftext($imagen, 20, 0, 10, 20, $negro, $fuente, $text);
 
imagepng($imagen);
 
imagedestroy($imagen);
