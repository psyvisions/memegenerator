<?php
class Template {
    private $template_data = array();
    public $loaded=false;
    
    public function set($name, $value)
    {
            $this->template_data[$name] = $value;
    }
     
    public function load($template = null, $view = '' , $view_data = array(), $return = FALSE)
    {
        if($template==null)
            $template='template/main';

        $this->loaded=true;
        
        $CI =& get_instance();
        $this->set('contents', $CI->load->view($view, $view_data, TRUE));
        return $CI->load->view($template, $this->template_data, $return);
    }

    public function  __get($name) {
        return $this->template_data[$name];
    }

    public function  __set($name, $value) {
        if(is_array($value)){
            if(isset($this->template_data[$name])){
                $this->template_data[$name] = array_merge($this->template_data[$name],$value);
            }
            else
                $this->template_data[$name] = $value;
        }else{
            $this->template_data[$name] = $value;
        }
    }
}