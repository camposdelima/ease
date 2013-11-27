<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	function __construct()
    {
        parent::__construct();
    }
	
	public function Authenticate() {
			
		$username = $this->input->get('user');
		$pass = $this->input->get('pass');		
		$user = null;
			
		if( strlen($username) > 0 && strlen($pass) > 0) {
					
			$user = $this->em->getRepository('Entities\User')
								->findOneBy(array(
												'username' => $username
												,'password' => $this->BCrypt($pass)
												)
											);
											
		}
		
		if($user != null && $user->isActive()) {
			$this->session->set_userdata('user', $user);
		}
		
		$this->WriteUser($user);
	}
	
	public function Logout() {
		$this->session->sess_destroy();
	}
	
	public function GetAuthenticatedUser() {

		$user = $this->session->userdata('user');
		
		$this->WriteUser($user);			
	}
	
	private function WriteUser($user) {
		$message = null;		
		
		
		if($user == null) {
			$message = 'Credenciais inválidas.';
		}
	
		$this->WriteJSON($user, $message);
	}
	
	private function BCrypt($text) {
		return crypt(
					$text,
					'$2a$07$'.$this->config->item('encryption_key').'$'
		);
	}
	
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */