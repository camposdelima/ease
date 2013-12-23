<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->em = $this->doctrine->em;
    }	
	
	protected function GetEntityName($entityName) {
		return 'Entities\\'.$entityName;
	}
	
	protected function GetUtil($entityName) {		
		$collection = $this->em->getRepository($this->GetEntityName($entityName))->findByActive(1);

		try {		
			$this->WriteJSON(\Entities\MY_Entity::DataExtract($collection));
		} catch(Exception $e) {
			print_r($e);
		}
	}
	
	
	protected function Save($entityName) {
				
		$data = $this->GetPostJSON();
		
		if($data == null) {			
			return;
		}		 
		
		if(isset($data->id) && $data->id > 0 ) {
			$entity = $this->FindEntity($data, $entityName);
			
			if($entity == null) {
				return;
			}
			
		} else {
			$entityName = $this->GetEntityName($entityName);						
			$entity = new $entityName();					
		}	
	
		$this->Set($data, $entity);
			
		$this->em->persist($entity);	
		$this->Flush();
		
		$this->WriteJSON($entity->GetID());
	}
	
	
	protected function Delete($entityName) {
		$data = $this->GetPostJSON();
		
			
		if($data == null) {			
			return;
		}		
		
		$entity = $this->FindEntity($data, $entityName); 

		if($entity == null) {
			return;
		}		
		
		$this->em->remove($entity);
		$this->Flush();
		
		$this->WriteJSON($data->id);
	}
	
	
	
	protected function GetPostJSON() {
		$data = ($this->input->post('data')?:$this->input->get('data'));
		
		$data = json_decode($data);
		
		if($data == null) {
			$this->WriteJSON(null, "Parametro 'data' é um JSON inválido.");
		}
		
		return $data;
	}
	
	private function FindEntity($data, $entityName) {				
		
		$entity = $this->em->find($this->GetEntityName($entityName), (isset($data->id)?$data->id:0));
				
		if($entity == null) {			
			$this->WriteJSON(null, 'A referência primária ao elemento "'.$entityName.'" é inválida.');
		}		
		
		
		return $entity;
	}
	
	Private function Flush() {		
		try {			
			$this->em->flush();
		} catch(Exception $ex) {			
			$this->WriteJSON(null, $ex->getMessage());	
		}	
	}
	
	
	protected function SetEntityMember($data, $key, $entityName = null) {
		if(isset($data->$key)) {
			if(is_object($data->$key))
				$data->$key = $data->$key->id;
			 	
			$data->$key	= $this->em->find($this->GetEntityName(($entityName?:$key)), $data->$key);
		}
	}
	
	protected function SetNumericMember($data, $key) {
		if(strlen($data->$key) > 0 && !is_numeric($data->$key)) 
			unset($data->$key);					
	}
	
	protected function SetDateMember($data, $key) {
		if(isset($data->$key)) {			
			$data->$key = new Datetime($data->$key);
		}
	}	
	
	protected function Set($data, $entity) {
		$entity->Set($data);				
	}
	
	
	protected function WriteJSON($data, $message=null, $success=null) {
		
		//$data = EntitiesToList($data);
		
		$result = array(
						'success' => ($success!=null?$success: $data != null)
						,'data' => $data
						,'message' => $message
						);
			
		$jResult = json_encode($result);
		
		if(strlen($this->output->get_output()) == 0) {					
				$this->output
				->set_content_type('application/json')
				->set_output($jResult);
		}
	}
}

/* End of file user.php */
/* Location: ./application/core/MY_Controller.php */