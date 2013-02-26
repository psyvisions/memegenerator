<?php 
class ME_Controller extends CI_Controller implements ArrayAccess
{
  private $models;
  public  $template_file;
  public  $view;
  public  $view_data = array();
  
  public function __construct()
  {
    parent::__construct();
    $this->template_file = null;
  }
  
  public function offsetExists($offset)
  {
    
  }
  
  public function offsetGet($offset){
      $model = "model_{$offset}";
      if(!isset($this->models[$model]))
      {
          $this->load->model("{$offset}model",  $model);
          $this->models[$model]=$this->$model;
      }

      return $this->models[$model];
  }

  public function offsetSet($offset, $value)
  {
    
  }

  public function offsetUnset($offset)
  {
      unset($this->models[$offset]);
      return $this;
  }

  public function _remap($method,$params)
  {

      if(method_exists($this,$method))
          call_user_func_array(array($this,$method), $params);
      else
          call_user_func_array(array($this,'index'), $params);
  }

  public function _output($output)
  {
    $this->view_data['username'] = "";
	  if($this->session->userdata('username'))
	    $this->view_data['username'] = $this->session->userdata('username');
    
      if($this->view == null)
          show_error ('$this->view not defined');
      
      if($this->template->loaded==false && $this->view!=null && !$this->input->is_ajax_request()){
          echo $this->template->load($this->template_file,$this->view,$this->view_data,TRUE);
      }else
          echo $this->load->view($this->view,$this->view_data,true);
  }
  
  public function check_login()
  {
    if(!($this->session->userdata('username') && $this->session->userdata('password')))
      redirect('/login');
  }
  
    
}