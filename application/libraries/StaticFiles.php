<?php
/**
 * StaticFiles
 *
 * @package         bachoco
 * @subpackage      libraries
 * @version         1.0
 * @author          Tequila Digital
 */

class StaticFiles
{
    public $CI;
    public $js;
    public $css;
    public $baseUrl;

    /**
     * Initialize class variables
     *
     * @access public
     */
    public function __construct()
    {
        $this->CI       =& get_instance();
        $this->js       = array();
        $this->css      = array();
        $this->baseUrl  = str_replace($this->CI->config->item('index_page'), '', base_url()) . 'statics/';
    }

    /**
     * Add one or multiple javascript files
     *
     * @param string|array File or array of files
     * @return bool
     */
    public function add_js($file = null, $view = false)
    {
        if (empty($file)) {
            return false;
        }

        if (is_array($file)) {
            if ($view) $file = array_reverse($file);
            foreach ($file as $f) {
                $this->add_js($f, $view);
            }
        }else{
            if ($view)  array_unshift($this->js, $file);
            else        $this->js[] = $file;
        }

        return true;
    }

    /**
     * Add one or multiple styleesheet files
     *
     * @param string|array File or array of files
     * @return bool
     */
    public function add_css($file, $view = false)
    {
        if (empty($file)) {
            return false;
        }

        if (is_array($file)) {
            if ($view) $file = array_reverse($file);
            foreach ($file as $f) {
                $this->add_css($f, $view);
            }
        }else{
            if ($view)  array_unshift($this->css, $file);
            else        $this->css[] = $file;
        }

        return true;
    }

    /**
     * Return string of javascript files
     *
     * @return String
     */
    public function print_js()
    {
        $string = '';
        foreach ($this->js as $js) {
            $string .= '<script type="text/javascript" src="' . $this->baseUrl . 'js/' . $js  . '.js"></script>' . "\n";
        }

        $this->js = array();

        return $string;
    }

    /**
     * Return string of stylesheets
     *
     * @return String
     */
    public function print_css()
    {
        $string = '';
        foreach ($this->css as $css)
        {
            $string .= '<link rel="stylesheet" href="' . $this->baseUrl . 'css/' . $css  . '.css" type="text/css" />' . "\n";
        }

        $this->css = array();

        return $string;
    }

    /**
     * Return image url
     *
     * @param String $file  Name of the image file
     * @return String
     */
    public function img_url($file = null)
    {
        if (empty($file)) {
            return false;
        }

        return $this->baseUrl . 'img/' . $file;
    }
}