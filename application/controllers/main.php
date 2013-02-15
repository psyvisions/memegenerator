<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends ME_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	  $this->template_file = 'template/main';
		$this->view = 'main/index';
	}
	public function meme()
	{
	  $text = $this->input->post('text');
	  $image = $_FILES['fondo']['name'];
	  
	  move_uploaded_file($_FILES["fondo"]["tmp_name"], "statics/memes/temp/".$image);
	  chmod("statics/memes/temp/".$image, 0777); 
	  	  
	  header("Content-type: image/jpeg");
	  
	  $fondo = imagecreatetruecolor(500, 400);
    $imagen = imagecreatefromjpeg("statics/memes/temp/".$image);

    $negro = imagecolorallocate($imagen,255,255,255);

    imagesetpixel($imagen,30,30,$negro);

    $fuente = 'statics/fonts/nissanag-bold-webfont.ttf';

    // Añadir algo de sombra al texto
    //imagettftext($imagen, 20, 0, 11, 21, $negro, $fuente, $text);

    // Añadir el texto
    imagettftext($fondo, 20, 0, 20, 350, $negro, $fuente, $text);

    imagefilledrectangle ( $imagen , 0 , 289 , 470 , 300 , $negro );

    imagecopymerge($fondo, $imagen, 15,10,0,0,470,289,100);

    imagejpeg($fondo);

    imagedestroy($imagen);
    imagedestroy($fondo);
    
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */