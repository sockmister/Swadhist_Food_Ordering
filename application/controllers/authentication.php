<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		define('ASSEST_URL', base_url().'assets/');	
	}
	
	public function login() {
		if($this->session->userdata('logged_in') != FALSE) {
			redirect(site_url("general/index"));
			return;
		}		
	}
	
	
	public function logout() {
		$this->session->set_userdata('logged_in', FALSE);
		$this->session->destroy();
		//redirect(site_url("general/index"));
	}
}
?>