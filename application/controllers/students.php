<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
    }
	
	public function index() {
		return $this->Get();
	}
	
	public function Get() {
		return $this->GetUtil('Student');				
	}	
	
	public function Save() {				
		parent::Save('Student');		
	}
	
	protected function Set($data, $entity) {

		$this->SetEntityMember($data, 'branch');		
		$this->SetEntityMember($data, 'user');							
		$this->SetEntityMember($data, 'city');	
		$this->SetEntityMember($data, 'placeOfBirth', 'City');					
		
		$this->SetNumericMember($data, 'cellularPhone');
		$this->SetNumericMember($data, 'phone');
				
		$this->SetDateMember($data, 'birthdate');		

		
		parent::Set($data, $entity);		
	} 
	
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */