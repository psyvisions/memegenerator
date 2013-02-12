<?php
 
header("Content-type: image/jpeg");

$text = "Hola a todos nosotros";

$fondo = imagecreatetruecolor(500, 400);
$imagen = imagecreatefromjpeg('thumb-juke-asientos-piel-2.jpg');

$negro = imagecolorallocate($imagen,255,255,255);
 
imagesetpixel($imagen,30,30,$negro);

$fuente = './nissanag-bold-webfont.ttf';

// Añadir algo de sombra al texto
//imagettftext($imagen, 20, 0, 11, 21, $negro, $fuente, $text);

// Añadir el texto
imagettftext($fondo, 20, 0, 20, 350, $negro, $fuente, $text);

imagefilledrectangle ( $imagen , 0 , 289 , 470 , 300 , $negro );

imagecopymerge($fondo, $imagen, 15,10,0,0,470,289,100);

imagejpeg($fondo);
 
imagedestroy($imagen);
imagedestroy($fondo);
