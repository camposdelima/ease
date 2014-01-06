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
	
	Public Function GetAvailable() {
			$data = ($this->GetJSON(true)?:(object)array(
											'minDate' => null
											,'maxDate' => null));
							
		try {

			$rsm = new \Doctrine\ORM\Query\ResultSetMappingBuilder($this->em);
			$rsm->addRootEntityFromClassMetadata('Entities\Student', 's');					
						
			$query = 'select id, nome, sobrenome from alunosdisponiveis(?, ?);';
					
			$qb = $this->em
					->createNativeQuery($query, $rsm);
			
			//$empty = (object)array('id' => null);
			
			if(!key_exists('minDate', $data) || strtotime($data->minDate) == null ) 		
				$data->minDate = null;			
					
			if(!key_exists('maxDate', $data) || strtotime($data->maxDate) == null )
				$data->maxDate = null;
						
			$qb->setParameter(1, $data->minDate);
			$qb->setParameter(2, $data->maxDate);
		 	 		
		 	$collection = $qb->getArrayResult();	
			
			//print_r($collection);
			
			$this->WriteJSON($collection);
		} catch(Exception $e) {
			print_r($e);
		}
	}	
	
	public function Save() {				
		parent::Save('Student');		
	}
	
	public function Delete() {				
		parent::Delete('Student');		
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