<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poh extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		define('ASSEST_URL', base_url().'assets/');				
	}
	
	public function index() {
		echo "hello world";
		$this->load->view('poh');
	}
	
	
}