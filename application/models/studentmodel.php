<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StudentModel extends CI_Model {

	var $id = 0;
	var $id_naturalidade = '';
	var $id_municipio = '';
	var $id_processo = '';
	
	var $ativo = false;
	var $nome = '';
	var $sobrenome = '';
	var $nascimento = null;	
	var $pai = '';
	var $mae = '';
	var $sexo = false;	
	var $rua = '';
	var $numero = 0;
	var $complemento = '';
	var $bairro = '';
	var $cep = '';	
	var $renach = '';

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
		
		$query = $this->db->get('alunos');
		
		if($query->num_rows() == 0) return false;
	 
		
		return $query->result();
		
    }
}