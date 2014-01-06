<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	function __construct()
    {
        parent::__construct();
    }
	
	public function Authenticate() {
		$data = $this->GetJSON();
		
		$username = (isset($data->username)?$data->username:null);
		$pass = (isset($data->password)?$data->password:null);
				
		$user = null;
		
		if( strlen($username) > 0 && strlen($pass) > 0) {
					
			$user = $this->em->getRepository('Entities\User')
								->findOneBy(array(
												'username' => $username
												,'password' => $this->BCrypt($pass)
												)
											);
											
		}
		
		if($user != null && $user->IsActive()) {
			$this->session->set_userdata('user', $user);
		}
		
		$this->GetAuthenticatedUser();		
	}
	
	public function Logout() {
		$this->session->sess_destroy();
	}
	
	public function GetAuthenticatedUser() {

		$user = $this->session->userdata('user');	
				
		if($user == null) {
			$message = 'Credenciais inválidas.';
		}
	
		$this->WriteJSON($user);		
	}
	
	public function Delete() {
		parent::Delete('User');
	}
	
	public function Save() {				
		parent::Save('User');		
	}
	
	protected function Set($data, $entity) {
		if(isset($data->password))
			$data->password = $this->BCrypt($data->password);
		 
		parent::Set($data, $entity);		
	} 
	
	private function BCrypt($text) {
		return crypt(
					$text,
					'$2a$07$'.$this->config->item('encryption_key').'$'
		);
	}
	
	
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */