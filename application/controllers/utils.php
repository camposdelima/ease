<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utils extends MY_Controller {
	function __construct()
    {
        parent::__construct();
		
		//;
    }
	
<<<<<<< HEAD
	public function index()
	{		
		echo 'oi';
	}
	
=======
>>>>>>> 6a91e8d8cbfabf3f8d5631d63ce3e994cb9224c2
	public function GetCities() {
		return $this->GetUtil('City');				
	}
	
	public function GetCategories() {
		return $this->GetUtil('Category');
	}
	
	public function GetProcesses() {
		return $this->GetUtil('Process'); 
	}
	
	public function GetStudents() {	
		return $this->GetUtil('Student');				
	}	
		
	
	
}

/* End of file utils.php */
/* Location: ./application/controllers/user.php */