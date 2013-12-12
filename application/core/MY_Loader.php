<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    function MY_Loader()
    {
        parent::CI_Loader();
        $this->_ci_view_path = 'frontend';
    }
}  

/* End of file MY_Loader..php */
/* Location: ./application/core/MY_Loader.php */