<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->em = $this->doctrine->em;
		$this->load->helper("convert");
    }	
	
	protected function GetUtil($entityName) {		
		$collection = $this->em->getRepository('Entities\\'.$entityName)->findByActive(1);						
		$this->WriteJSON($collection);
	}
	
	protected function Persist($entityName) {		
		$data = json_decode($this->input->post('data'));
		
		if($data == null) {
			$this->WriteJSON(null, "Parametro 'data' é um JSON inválido.", false);
			return;
		}
				
		if(isset($data->id) && $data->id > 0 ) {			
			$entity = $this->em->find($entityName, $data->id);			
		} else {						
			$entity = new $entityName();					
		}	
		
		$this->Set($data, $entity);
		
		//print_r($entity->toArray());
		//return;
		
		$this->em->persist($entity);		
		$this->em->flush();
		
		
		$this->WriteJSON($entity->GetID());
	}
	
	protected function Set($data, $entity) {
		$entity->Set($data);				
	}
	
	protected function WriteJSON($data, $message=null, $success=null) {
		
		$data = EntitiesToList($data);
		
		
		$result = array(
						'success' => ($success!=null?$success: $data != null)
						,'data' => $data
						,'message' => $message
						);
			
		$jResult = json_encode($result);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	}
}

/* End of file user.php */
/* Location: ./application/core/MY_Controller.php */