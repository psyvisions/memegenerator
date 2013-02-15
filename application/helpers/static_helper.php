<?php
/**
 * Static helper
 *
 * @package         cuadro
 * @subpackage      helpers
 * @version         1.0
 * @author          Tequila Digital
 */

/**
 * Print js files
 *
 * @param String $file  Name of the file
 */
function print_js($file = null) {
    $ci =& get_instance();
    if (!empty($file)) {
        $ci->staticfiles->add_js($file, true);
    }
    echo $ci->staticfiles->print_js();
}
/**
 * Print css files
 *
 * @param String $file  Name of the file
 */
function print_css($file = null) {
    $ci =& get_instance();
    if (!empty($file)) {
        $ci->staticfiles->add_css($file, true);
    }
    echo $ci->staticfiles->print_css();
}
/**
 * Print image string for a given file.
 *
 * @param String $file  Name of the file
 * @param String $alt   Alternate text (optional)
 * @return String
 */
function print_img($file = null, $alt = '', $attr = array(), $echo = true) {
    $ci =& get_instance();
    if (empty($file)) {
        return '';
    }
    $attrs = '';
    if (!empty($attr)) {
        foreach ($attr as $key => $value) {
            $attrs .= ' ' . $key . '="' . $value . '"';
        }
    }
    $string = '<img' . $attrs . ' src="' . $ci->staticfiles->img_url($file) . '" alt="' . htmlspecialchars(xss_clean($alt)) . '" />';
    if ($echo)  echo $string;
    else        return $string;
}

function imgLogo() {
    $using_ie6 = (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE);
    if($using_ie6 == FALSE){
        print_img('logo-nissan.png', 'Home | Nissan Mexicana', array('id' => 'logoNissan')); 
    }
    else {
        print_img('logo-nissan.jpg', 'Home | Nissan Mexicana', array('id' => 'logoNissan')); 
        }
}

function configRmChar($string) {
    $str = htmlentities($string, ENT_COMPAT, "UTF-8");
    $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/','$1',$str);
    $str = html_entity_decode($str);
    $str = str_replace(' ','',$str);
    return $str;
}