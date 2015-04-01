<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->library('twig');
		$this->twig->add_function('base_url'); 
		$data['title'] = "Welcome to CodeIgniter";
		$data['head']  = "Welcome to CodeIgniter!";
		$data['content']  = "The page you are looking at is being generated dynamically by CodeIgniter and template engine Twig.";
		$this->twig->display('view', $data);
		// $this->load->view('welcome_message');
	}

	public function elegant() 
	{
		$users = User::all();
		foreach($users as $user)
		{
  			echo $user->name;
		}

	}
}
