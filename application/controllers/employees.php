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
	
	
	public function Save() {
		$this->Persist('Entities\Employee\Employee');		
	}
	
	
	protected function Set($data, $entity) {
					
		if(isset($data->school)) {
			if(isset($data->school->id))
				$data->school	= 	$this->em->find('Entities\School', $data->school->id);
			else
				unset($data->school);
		}
					
		if(isset($data->departments)) {
			if (is_array($data->departments)) {
				$arr = new Doctrine\Common\Collections\ArrayCollection();
				foreach($data->departments as $department)
					$arr[] = $this->em->find('Entities\Employee\Department', $department->id);
		
				
				$data->departments =	$arr;
			} else
				unset($data->departments);
			
		}
		
		
		if(isset($data->user)) {
			if(isset($data->user->id))			
				$data->user 	= 	$this->em->find('Entities\User', $data->user->id);
			else 
				unset($data->user);			
		}

		
			
		parent::Set($data, $entity);
	} 
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */