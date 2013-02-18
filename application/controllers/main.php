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
		$this->view_data['memes'] = $this['meme']->getAll();
	  $this->template_file = 'template/main';
		$this->view = 'main/index';
	}
	
	public function gallery()
	{
		
	}
	
	public function generate()
	{
		$this->template_file = 'template/main';
		$this->view = 'main/generate';
	}
	
	public function meme()
	{
	  $text = $this->input->post('text');
		$title = $this->input->post('title');
		$image = $_FILES['fondo']['name'];		
		$date = date('Y-m-d');
		
		$params = array(
			'title' => $title,
			'text' => $text,
			'image' => $image,
			'date' => $date
		);
	  
		$meme_id = $this['meme']->insert($params);
		
	  move_uploaded_file($_FILES["fondo"]["tmp_name"], "statics/memes/temp/".$image);
	  chmod("statics/memes/temp/".$image, 0777); 
	  	  
	  //header("Content-type: image/jpeg");
	  
    $imagen = imagecreatefromjpeg("statics/memes/temp/".$image);
		
		$size = getimagesize("statics/memes/temp/".$image);
		
		$fondo = imagecreatetruecolor(($size[0] + 30), ($size[1] + 110));
    $negro = imagecolorallocate($imagen,255,255,255);

    $fuente = 'statics/fonts/nissanag-bold-webfont.ttf';

    // Añadir algo de sombra al texto
    //imagettftext($imagen, 20, 0, 11, 21, $negro, $fuente, $text);

    // Añadir el texto
    imagettftext($fondo, 20, 0, 20, $size[1] + 40, $negro, $fuente, $text);

    imagefilledrectangle ( $imagen , 0 , 289 , 470 , 300 , $negro );

    imagecopymerge($fondo, $imagen, 15,10,0,0, $size[0], $size[1], 100);
		
    imagejpeg($fondo, "statics/memes/created/".$meme_id.".jpg");
    imagedestroy($imagen);
    imagedestroy($fondo);
		
		chmod("statics/memes/created/".$meme_id.".jpg", 0777);
		
		redirect('/');
    
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */