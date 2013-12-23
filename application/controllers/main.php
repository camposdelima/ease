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
//<<<<<<< HEAD
//		$this->load->view('../../frontend/login.html');
		//$this->load->library('doctrine');
//=======
	
	echo 'oi';
		//	$this->load->view('main');
		//	$this->load->library('doctrine');
//>>>>>>> 6a91e8d8cbfabf3f8d5631d63ce3e994cb9224c2
	
		//$em = $this->doctrine->em;
		
		//$user = $this->em->find('Entities\User', 3);
		
			
		//print_r($user);
//<<<<<<< HEAD
		
///=======
//>>>>>>> 6a91e8d8cbfabf3f8d5631d63ce3e994cb9224c2
		//$user = new Entity\User;
		//$user->setUsername('Joseph');
		//$user->setPassword('secretPassw0rd');
		//$user->setEmail('josephatwildlyinaccuratedotcom');
		
		//$em->persist($user);
		//$em->flush();
	}
}

/* Location: ./application/controllers/welcome.php */