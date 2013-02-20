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
        $userdata = array('username'=> $username, 'password' => md5($password), 'user_id' => $user->id);
        $this->session->set_userdata($userdata);
        $this->session->userdata('username');
        redirect('/');
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
      redirect('/');
    }
  }  
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */