<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

	/**
 	* @category Libraries
 	* @package  CodeIgniter 3.0
 	* @author   Yp <purwantoyudi42@gmail.com>
 	* @link     https://timexstudio.com
 	* @license  Protected
 	*/

class Twig
{
	private $CI;
	private $_twig;
	private $_template_dir;
	private $_cache_dir;
	private $_ext;

	function __construct($debug = false)
	{
		$this->CI =& get_instance();
		$this->CI->config->load('twig');
		 
		ini_set('include_path',
		ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'libraries/Twig');
		require_once (string) "Autoloader.php";
		log_message('debug', "Twig Autoloader Loaded");
		Twig_Autoloader::register();
		$this->_template_dir = $this->CI->config->item('template_dir');
		$this->_cache_dir = $this->CI->config->item('cache_dir');
		$this->_ext = $this->CI->config->item('ext');
		$loader = new Twig_Loader_Filesystem($this->_template_dir);
		$this->_twig = new Twig_Environment($loader, array(
                'cache' => $this->_cache_dir,
                'debug' => $debug,
		));
		
	        foreach(get_defined_functions() as $functions) {
            		foreach($functions as $function) {
                		$this->_twig->addFunction($function, new Twig_Function_Function($function));
            		}
        	}
	}
	public function add_function($name) 
	{
		$this->_twig->addFunction($name, new Twig_Function_Function($name));
	}
	public function render($template, $data = array()) 
	{
		$template = $this->_twig->loadTemplate($template);
		return $template->render($data);
	}
	public function display($template, $data = array()) 
	{
		$template = $this->_twig->loadTemplate($template.$this->_ext);
		/* elapsed_time and memory_usage */
		$data['elapsed_time'] = $this->CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');
		$memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2) . 'MB';
		$data['memory_usage'] = $memory;
		$template->display($data);
	}
}
