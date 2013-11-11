<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
    }
	
	public function index()
	{		
				
	}
	
	public function getCities() {
		$this->load->model('CityModel');
		
		$cities =  $this->CityModel->get(array( 'cast(ativo as int) =' =>  true));
		
		$jResult = json_encode($cities);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	}
	
	public function getCategories() {
		$this->load->model('CategoryModel');
		
		$categories =  $this->CategoryModel->get(array( 'cast(ativo as int) =' =>  true));
		
		$jResult = json_encode($categories);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	}
	
	public function getProcesses() {
		$this->load->model('ProcessModel');
		
		$processes =  $this->ProcessModel->get(array( 'cast(ativo as int) =' =>  true));
		
		$jResult = json_encode($processes);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	}
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */