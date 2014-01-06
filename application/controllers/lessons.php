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
		$criteria = $this->GetCriteria();
		
		try {
			 
			$collection =  $this->em->getRepository($this->GetEntityName('Lesson'))->matching($criteria);			
			
			$this->WriteJSON(\Entities\MY_Entity::DataExtract($collection, true));
		} catch(Exception $e) {
			print_r($e);
		}
	}


	/** GROUP COM NATIVE QUERY ***/
	
	public function GetDays() {
		$data = ($this->GetJSON(true)?:(object)array(
											'minDate' => null
											,'maxDate' => null
											,'employee'=> null
											,'category'=> null
											,'student' => null));
							
		try {

			$rsm = new \Doctrine\ORM\Query\ResultSetMapping();			
			$rsm->addScalarResult('dia', 'day');
			$rsm->addScalarResult('completo', 'full');
			
			$query = 'select * from diasdeaula(?, ?, ?, ?, ?);';
					
			$qb = $this->em
					->createNativeQuery($query, $rsm);
			
			$empty = (object)array('id' => null);
			
			if(!key_exists('minDate', $data) || strtotime($data->minDate) == null ) 		
				$data->minDate = null;			
					
			if(!key_exists('maxDate', $data) || strtotime($data->maxDate) == null )
				$data->maxDate = null;
			
			if(!key_exists('employee', $data) || ($data->employee == null || !key_exists('id', $data->employee)) )
				$data->employee = $empty;
			
			if(!key_exists('category', $data) || ( $data->category == null || !key_exists('id', $data->category)) )	
				$data->category= $empty;
			
			if(!key_exists('student', $data) || ( $data->student == null || !key_exists('id', $data->student)) )
				$data->student = $empty;
			
			$qb->setParameter(1, $data->minDate);
			$qb->setParameter(2, $data->maxDate);
		 	$qb->setParameter(3, $data->employee->id);
		 	$qb->setParameter(4, $data->category->id);
		 	$qb->setParameter(5, $data->student->id);
				
			 		
		 	$collection = $qb->getArrayResult();	
			
			$this->WriteJSON($collection);
		} catch(Exception $e) {
			print_r($e);
		}
	}
	
	public function Save() {				
		parent::Save('Lesson');
	}
	
	protected function Set($data, $entity) {		
		$this->SetEntityMember($data, 'employee', 'Employee\Employee');
			
		$this->SetEntityMember($data, 'vehicle', 'Vehicle\Vehicle');		
		$this->SetEntityMember($data, 'category');
		$this->SetEntityMember($data, 'student');
		$this->SetDateMember($data, 'start');
		$this->SetDateMember($data, 'end');		
		
		parent::Set($data, $entity);		
	} 
	
	private function GetCriteria() {
		$data = ($this->GetJSON(true)?: array());			
		
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
				
		
		if(key_exists('student', $data) && key_exists('id', $data->student) ) 
			$criteria				
				->andWhere(Criteria::expr()->eq('student', $data->student->id));
	
		return $criteria;
	}
}

/* End of file lessons.php */
/* Location: ./application/controllers/lessons.php */