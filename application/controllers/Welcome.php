<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
 	* @category Libraries
 	* @package  CodeIgniter 3.0
 	* @author   Yp <purwantoyudi42@gmail.com>
 	* @link     https://timexstudio.com
 	* @license  Protected
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
