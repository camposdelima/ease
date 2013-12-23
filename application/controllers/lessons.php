<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Doctrine\Common\Collections\Criteria;

class Lessons extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
    }
	
	public function index() {
		return $this->Get();
	}
	
	public function Get() {
		$data = ($this->GetPostJSON()?: array());
					
		
    		
		$collection = $this->em->getRepository($this->GetEntityName('Lesson'));
		
		$criteria =	Criteria::create();
		
		if(key_exists('minDate', $data) && strtotime($data->minDate) != null ) 
			$criteria
				->andWhere(Criteria::expr()->gt('start', new DateTime($data->minDate)));
		
		
		if(key_exists('maxDate', $data) && strtotime($data->maxDate) != null ) 
			$criteria				
				->andWhere(Criteria::expr()->lt('start', new DateTime($data->maxDate)));


		if(key_exists('employee', $data) && key_exists('id', $data->employee) ) 
			$criteria				
				->andWhere(Criteria::expr()->eq('employee', $data->employee->id));


		if(key_exists('category', $data) && key_exists('id', $data->category) ) 
			$criteria				
				->andWhere(Criteria::expr()->eq('category', $data->category->id));

		//TODO: Toda a lógica para caso o cara busque vagas abertas;		
		try {		
			if(key_exists('student', $data)) {
				
				if($data->student == null) 
					$collection = $collection->findByStudent(null);	
				elseif(key_exists('id', $data->student)) 
					$criteria->andWhere(Criteria::expr()->eq('student', $data->student->id));
				
							
			}
			 
			$collection =  $collection->matching($criteria);
			
				
			$this->WriteJSON(\Entities\MY_Entity::DataExtract($collection));
		} catch(Exception $e) {
			print_r($e);
		}
	}	
	
	public function Save() {				
		parent::Save('Lesson');
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