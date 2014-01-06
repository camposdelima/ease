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
			$this->WriteJSON(\Entities\MY_Entity::DataExtract($collection, true));
		} catch(Exception $e) {
			print_r($e);
		}
	}
	
	
	protected function Save($entityName) {
				
		$data = $this->GetJSON();
		
		
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

		
		$this->Flush($entity);
		
		$this->WriteJSON($entity->GetID());
	}
	
	
	protected function Delete($entityName) {
		$data = $this->GetJSON();
					
		if($data == null) {			
			return;
		}		
		
		$entity = $this->FindEntity($data, $entityName); 

		if($entity == null) {
			return;
		}		
		
		
		$entity->SetInactive();					
		
		$this->Flush($entity);
		
		$this->WriteJSON($data->id);
	}
	
	
	
	protected function GetJSON($nullable=false) {
		$data = file_get_contents('php://input');//($this->input->post('data')?:$this->input->get('data'));	
		
		if($data == null && $nullable)
			return false;
		
		$data = json_decode($data);
		
		if($data == null) {
			$this->WriteJSON(null, "Parametro 'data' é um JSON inválido.");
		}
		
		return $data;
	}
	private function FindEntity($data, $entityName) {				
		
		if(!is_numeric($data)) {			
			if(key_exists('id', $data))
				$data=  $data->id;
			else 
				$data = 0;
		}
		
		
		
		$entity = $this->em->find($this->GetEntityName($entityName), $data);
				
		if($entity == null) {			
			$this->WriteJSON(null, 'A referência primária ao elemento "'.$entityName.'" é inválida.');
		}		
		
		
		return $entity;
	}
	
	Private function Flush($entity) {		
		try {
//			print_r($entity);			
			$this->em->persist($entity);				
			$this->em->flush();	
		} catch(Exception $ex) {
			$this->WriteJSON(null, $ex->getMessage());	
		}
	}
	
	
	protected function SetEntityMember($data, $key, $entityName = null) {
		if(isset($data->$key)) {
			if(is_object($data->$key))
				$data->$key = $data->$key->id;			
			
			$data->$key	= $this->FindEntity($data->$key, ($entityName?:$key));
		}
	}
	
	protected function SetNumericMember($data, $key) {		
		if(key_exists($key, $data) && strlen($data->$key) > 0 && !is_numeric($data->$key)) 
			unset($data->$key);					
	}
	
	protected function SetDateMember($data, $key) {
		if(isset($data->$key)) {
			try {
				$data->$key = new Datetime($data->$key);				
			} catch(Exception $e) {
				$data->$key = null;
				$this->WriteJSON(null, 'A propriedade de tempo e data "'.$key.'" é inválida.');
			}
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