<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
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
	
	public function Get() {	
		return $this->GetUtil('Vehicle\\Vehicle');				
	}
	
	public function asdf() {
		
		//$teste = $this->input->post('teste');
		print_r(json_decode($teste));
	}
	
	public function Add() {
		$data = json_decode($this->input->post('data'));
		$entity = 	new Entities\Vehicle\Vehicle();		
		
		$this->Set($data, $entity);
	}
	
	public function Edit() {
		$data = json_decode($this->input->post('data'));
		$entity = $this->em->find('Entities\\Vehicle\\Vehicle', $data->id);
		
		
		$this->Set($data, $entity);
	}
	
	private function Set($data, $entity) {	
		$data->branch = 	$this->em->find('Entities\\Branch', $data->branch);
		$data->employee =	$this->em->find('Entities\\Employee', $data->employee);
		$data->model 	= 	$this->em->find('Entities\\Vehicle\Model', $data->model);
		$data->color	=	$this->em->find('Entities\\Vehicle\Color', $data->color);
		
	
		$entity->Set($data);
		$this->em->persist($entity);
		$this->em->flush();
		
		
		$this->WriteJSON($entity->GetID());
	}
	
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */