<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
    }
	
	public function index()
	{		
				
	}
	
	public function GetCities() {
		return $this->GetUtil('City');				
	}
	
	public function GetCategories() {
		return $this->GetUtil('Category');
	}
	
	public function GetProcesses() {
		return $this->GetUtil('Process'); 
	}
	
	public function GetManufacturers() {
		return $this->GetUtil('Vehicle\\Manufacturer');				
	}	
	
	public function GetModels() {
		return $this->GetUtil('Vehicle\\Model');				
	}
	public function GetColors() {
		return $this->GetUtil('Vehicle\\Color');				
	}	
	
	public function GetEmployee() {
		return $this->GetUtil('Employee');				
	}	
	
	public function GetVehicle() {
		return $this->GetUtil('Vehicle\\Vehicle');				
	}	
		
	private function GetUtil($entityName) {
		$collection = $this->em->getRepository('Entities\\'.$entityName)->findByActive(1);
		$this->WriteJSON($collection);
	}
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */