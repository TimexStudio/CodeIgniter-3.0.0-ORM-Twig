<?php
/**
 	* @category Libraries
 	* @package  CodeIgniter 3.0
 	* @author   Yp <purwantoyudi42@gmail.com>
 	* @link     https://timexstudio.com
 	* @license  Protected
**/
class Whoops
{
	public $whoops;
	public function __construct()
	{
		$CI = &get_instance();
		$_env = ENVIRONMENT;
		require_once __DIR__ . '/../../vendor/autoload.php'; 
	
		$whoops = new Whoops\Run();
		// Configure the PrettyPageHandler:
		$errorPage = new Whoops\Handler\PrettyPageHandler();
				
		$errorPage->setPageTitle("Oh No, It's broken!"); // Set the page's title
		$errorPage->setEditor("sublime");         // Set the editor used for the "Open" link
		$errorPage->addDataTable("Extra Info", array(
			"route" => $CI->uri->uri_string()
		));
		
		$whoops->pushHandler($errorPage);	 	
				
		if ($CI->input->is_ajax_request() == true) {
			$whoops->pushHandler(new Whoops\Handler\JsonResponseHandler());
		}
		// Debug true in env development
		if($_env=='development') {
			$whoops->register();
			$this->whoops = $whoops;
		}
	}
}