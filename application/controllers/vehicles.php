<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
    }
	
	public function index() {
		return $this->Get();
	}
	
	public function Get() {	
		return $this->GetUtil('Vehicle\Vehicle');				
	}	
	
	public function GetManufacturers() {
		return $this->GetUtil('Vehicle\Manufacturer');				
	}	
	
	public function GetModels() {
		return $this->GetUtil('Vehicle\Model');				
	}
	
	public function GetColors() {
		return $this->GetUtil('Vehicle\Color');				
	}	
		
	public function Delete() {
		parent::Delete('Vehicle\Vehicle');
	}
	
	public function Save() {				
		parent::Save('Vehicle\Vehicle');		
	}
	
	protected function Set($data, $entity) {
				
		$this->SetEntityMember($data, 'branch');
		$this->SetEntityMember($data, 'employee', 'Employee\Employee');
		$this->SetEntityMember($data, 'model', 'Vehicle\Model');				
		$this->SetEntityMember($data, 'color', 'Vehicle\Color');
		
		
		parent::Set($data, $entity);		
	} 
	
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */