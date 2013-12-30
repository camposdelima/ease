<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
    }
	
	public function index() {
		return $this->Get();
	}
	
	public function Get() {
		return $this->GetUtil('Employee\Employee');		
	}
	
	public function GetDepartments() {	
		return $this->GetUtil('Employee\Department');				
	}	
	
	public function GetInstructors() {
		return $this->GetUtil('Employee\Employee');		
	}
	
	public function Save() {
		$this->Persist('Employee\Employee');		
	}
	
	
	protected function Set($data, $entity) {
					
		if(isset($data->departments)) {
			if (is_array($data->departments)) {
				$arr = new Doctrine\Common\Collections\ArrayCollection();
				foreach($data->departments as $department)
					$arr[] = $this->em->find('Entities\Employee\Department', $department->id);
		
				
				$data->departments =	$arr;
			} else
				unset($data->departments);
			
		}
		
		$this->SetEntityMember($data, 'user');
		
		parent::Set($data, $entity);
	} 
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */