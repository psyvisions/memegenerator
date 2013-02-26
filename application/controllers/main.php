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
	  $this->check_login();
		$this->template_file = 'template/main';
		$this->view = 'main/generate';
	}
	
	public function contact()
	{
	  $this->template->js_scripts = array('contact');
	  $this->template_file = 'template/main';
		$this->view = 'main/contact';
  }
	
	public function create()
	{
	  $text = $this->input->post('text');
		$title = $this->input->post('title');
		$message = $this->input->post('message');
		$image = $_FILES['fondo']['name'];
		$image_type = $_FILES['fondo']['type'];
		$date = date('Y-m-d');
		
		$params = array(
			'title' => $title,
			'text' => $text,
			'message' => $message,
			'image' => $image,
			'date' => $date
		);
				
		switch($image_type)
	  {
	    case 'image/png':
	      $params['type'] = 'png';
	      break;
	    case 'image/jpeg':
	      $params['type'] = 'jpg';
	      break;
	    case 'image/gif':
	      $params['type'] = 'gif';
	      break;
	  }
		
		$meme_id = $this['meme']->insert($params);
		
	  move_uploaded_file($_FILES["fondo"]["tmp_name"], "statics/memes/temp/".$image);
	  chmod("statics/memes/temp/".$image, 0777); 
	  	  
	  //header("Content-type: image/jpeg");
	  switch($image_type)
	  {
	    case 'image/png':
	      $imagen = imagecreatefrompng("statics/memes/temp/".$image);
	      break;
	    case 'image/jpeg':
	      $imagen = imagecreatefromjpeg("statics/memes/temp/".$image);
	      break;
	    case 'image/gif':
	      $imagen = imagecreatefromgif("statics/memes/temp/".$image);
	      break;
	  }
		
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
		
		switch($image_type)
	  {
	    case 'image/png':
	      imagepng($fondo, "statics/memes/created/".$meme_id.".png");
	      break;
	    case 'image/jpeg':
	      imagejpeg($fondo, "statics/memes/created/".$meme_id.".jpg");
	      break;
	    case 'image/gif':
	      imagegif($fondo, "statics/memes/created/".$meme_id.".gif");
	      break;
	  }
	  
    imagedestroy($imagen);
    imagedestroy($fondo);
		
		chmod("statics/memes/created/".$meme_id.".".$params['type'], 0777);
		
		redirect('/');
    
	}
	
	public function send()
	{
	  $name = $this->input->post('name');
	  $email = $this->input->post('email');
	  $comment = $this->input->post('comment');
	  
	  $params = array(
	    'name' => $name,
	    'email' => $email,
	    'comment' => $comment
	  );
	  
	  $this['contact']->insert($params);
	  
	  $this->load->library('email');
	  
	  $this->email->from('no-reply@memegenerator.com', 'Contact');
    $this->email->to('eurzua@tequiladigital.com.mx');
    //$this->email->to('claudia.cabrera@bachoco.net');
    //$this->email->bcc('rcuriel@tequiladigital.com.mx');
    $this->email->bcc('urzuae@gmail.com');
    $this->email->subject('Contact');
    $this->email->message("$name with email address: $email send you this message: <br/>" . nl2br($comment));

    $enviado = $this->email->send();
    
    echo 'ok';
    die();
	  
  }
  
  public function login()
  {
    $this->template->css_scripts = array();
    $this->template->js_scripts = array();
    $this->view_data['login_failed'] = false;
    $this->template_file = 'template/main';
    $this->view = 'main/login';
  }

  public function signin()
  {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $usuario = $this['users']->search($username, md5($password));

      if($usuario)
      {
        $userdata = array('username'=> $username, 'password' => md5($password), 'user_id' => $usuario['id']);
        $this->session->set_userdata($userdata);
        $this->session->userdata('username');
        redirect('/meme');
      }
      else
      {
        $this->template->css_scripts = array();
        $this->template->js_scripts = array();
        $this->view_data['role'] = "";
        $this->view_data['login_failed'] = true;
        $this->template_file = 'template/main';
        $this->view = 'main/login';
      }

    }

  public function logout()
  {
    $userdata = array('username' => '', 'password' => '');
    $this->session->unset_userdata($userdata);
    redirect('/');
  }
  
  public function signup()
  {
    $this->view_data['errormessage'] = "";
    $this->template_file = 'template/main';
    $this->view = 'main/register';
  }
  
  public function register()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $usuario = $this['users']->search($username, md5($password));
    
    if($usuario && $usuario[0])
    {
      $this->view_data['errormessage'] = "This username is already taken please choose another one";
      $this->template_file = 'template/main';
      $this->view = 'main/register';
    }
    else
    {
      $params = array(
        'username' => $username,
        'password' => md5($password)
      );
      $user_id = $this['users']->insert($params);
      $userdata = array('username'=> $username, 'password' => md5($password), 'user_id' => $user_id);
      $this->session->set_userdata($userdata);
      $this->session->userdata('username');
      redirect('/meme');
    }
  }  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */