<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('UserModel');
    }
	
	public function index()
	{		
				
	}
	
	public function authenticate() {
		$username = isset($this->input->get('user')) ?
							$this->input->get('user')
							:'empty';
		$pass = isset($this->input->get('pass'))?
							$this->input->get('pass')
							:'empty';



		$user = $this->UserModel->get(array('usuario' => $username, 'senha' => md5($pass)));
		$user = $user[0];
		
		if($user != null && $user->ativo) {
			$this->session->set_userdata('user', $user);
		}
		
		$this->WriteUser($user);
	}
	
	private function WriteUser($user) {
		$success = $user != null;
		
		$result = array(
						'success' => $success
						,'user' => $user
						);
			
		$jResult = json_encode($result);
		
		$this->output
			->set_content_type('application/json')
			->set_output($jResult);
	
	}
	
	public function getAuthenticatedUser() {

		$user = $this->session->userdata('user');
		
		$this->WriteUser($user);			
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */