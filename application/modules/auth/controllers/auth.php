<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MX_Controller 
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('auth/login_model');
		$this->load->model('site/site_model');
		
		if(!$this->login_model->check_login())
		{
			redirect('airline-login');
		}
	}
}

?>