<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	var $id 	= 0;
    var $ativo   = false;
    var $usuario = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get($options = array())
    {
		while ($option = current($options)) {
			$this->db->where(key($options), $option);
			next($options);
		}
		
		$query = $this->db->select('id, ativo, usuario')->get('usuarios');
		
		if($query->num_rows() == 0) return false;
	 
		
		return $query->result();
		
    }
}