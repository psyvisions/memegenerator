<?php

$text = "Hola a todos nosotros";

$fondo = imagecreatetruecolor(500, 400);
$imagen = imagecreatefromjpeg('thumb-juke-asientos-piel-2.jpg');

$negro = imagecolorallocate($imagen,255,255,255);
 
//imagesetpixel($imagen,30,30,$negro);

$fuente = './nissanag-bold-webfont.ttf';

$size = getimagesize('thumb-juke-asientos-piel-2.jpg');


imagecopy($fondo,$imagen,0,0,0,0,$size[0],$size[1]);
//imagecopymerge($fondo, $imagen, 15,10,0,0,$size[0],$size[1],100);
header('Content-Type: image/jpeg');
//imagettftext($fondo, 20, 0, 11, 21, $negro, $fuente, $text);
imagejpeg($fondo);
imagedestroy($fondo);
// Añadir algo de sombra al texto


// Añadir el texto
//imagettftext($fondo, 20, 0, 20, 350, $negro, $fuente, $text);

//imagefilledrectangle ( $imagen , 0 , 289 , 470 , 300 , $negro );



//imagejpeg($fondo);
 
/*imagedestroy($imagen);
imagedestroy($fondo);*/
