<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//	$this->load->view('main');
	//	$this->load->library('doctrine');
	
		//$em = $this->doctrine->em;
		
		//$user = $this->em->find('Entities\User', 3);
		
		
		//print_r($user);
		$user = new Entity\User;
		//$user->setUsername('Joseph');
		//$user->setPassword('secretPassw0rd');
		//$user->setEmail('josephatwildlyinaccuratedotcom');
		
		//$em->persist($user);
		//$em->flush();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */