<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'controllers/authentication.php');

class Stall_owner_auth extends Authentication {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		$this->load->model('StallOwnerAccountModel');
		$this->load->model('StallAdminModel');
		define('ASSEST_URL', base_url().'assets/');
	}
	
	public function login() {
		parent::login();
		
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		
		// check that both username and password are not empty
		if (!empty($username) && !empty($password)) {
			$stallowner = StallOwnerAccountModel::authenticate($username, $password);
			
			if ($stallowner != false) {
				// login success
				$stall_id = StallAdminModel::getStallIdByOwnerId($stallowner->id);
				$this->session->set_userdata(
					array(
						"logged_in" => "stallowner", 
						"name" => $stallowner->name,
						"email" => $stallowner->email,
						"owner_id" => $stallowner->id,
						"stall_id" => $stall_id
					)
				);
				
				// redirect to dashboard here
				redirect(site_url("stall_owner/getStallOrder"));
			}
			else {
				// wrong username or password
				$data["result"] = "Wrong username or pw";
				$this->load->view('desktop/owner_login.php', $data);
			}
		}
		else {
			$data["result"] = "Enter username and pw to login";
			$this->load->view('desktop/owner_login.php', $data);
		}
		
	}
	public function logout() {
		parent::logout();
		redirect(site_url("stall_owner_auth/login"));
	}
}
?>