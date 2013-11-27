<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->em = $this->doctrine->em;
    }	
	
	function WriteJSON($data, $message=null) {
		$data = $this->ConvertToList($data);
				
		$result = array(
						'success' => $data != null
						,'data' => $data
						,'message' => $message
						);
			
		$jResult = json_encode($result);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	}
	
	private function ConvertToList($arr) {
		if ( is_array($arr) ) {
			$nArr = array();
			
			for($i = 0; $i < count($arr); $i++) {			
				$nArr[$i] = $arr[$i]->ToArray();
			}
			
			return $nArr;
		} else {
			$arr = $arr->ToArray();
		}
		return $arr;
	}
}

/* End of file user.php */
/* Location: ./application/core/MY_Controller.php */