<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'controllers/authentication.php');

class Stall_owner_update extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		$this->load->model('Stall_owner_account_model');	
		$this->load->model('Stall_admin_model');	
		define('ASSEST_URL', base_url().'assets/');	
	}
	
	public function update_details() {
		$email = $this->input->post("email");
		
		if (!empty($email)) {
			$username = $this->session->userdata('name');
			$data = array("name" => $username, "email" => $email);
			$stallowner = $this->Stall_owner_account_model->update_details($username, $data);
			
			if ($stallowner != false) {
				// update session
				$this->session->set_userdata(
					array(
						"logged_in" => "stallowner", 
						"name" => $username,
						"email" => $email,
						"owner_id" => $this->session->userdata('owner_id'),
						"stall_id" => $this->session->userdata('stall_id')
					)
				);
				
				$data["result"] = "Details updated";
				$this->load->view('stall_owner_update_details.php', $data);
			}
			else {
				// update failed for some reason
				$data["result"] = "Update failed";
				$this->load->view('stall_owner_update_details.php', $data);
			}
		}
		else {
				$data["result"] = "Change details to update";
				$this->load->view('stall_owner_update_details.php', $data);
		}
		
	}
	
	public function change_password() {
		$password = $this->input->post("password");
		$newpassword = $this->input->post("newpassword");
		
		if (!empty($password) && !empty($newpassword)) {
			$username = $this->session->userdata('name'); 
			$stallowner = $this->Stall_owner_account_model->authenticate($username, $password);
			
			if ($stallowner != false) {
				$username = $stallowner->name;
				$data = array("name" => $username, "password" => $newpassword);
			
				$stallowner = $this->Stall_owner_account_model->change_password($username, $data);
			
				if ($stallowner != false) {
					// change new password
					$data["result"] = "Password changed successfully";
					$this->load->view('stall_owner_change_password.php', $data);
				}
				else {
					// changed failed for some reason
					$data["result"] = "Change password failed";
					$this->load->view('stall_owner_update_details.php', $data);
				}
			}
			else {
				// failed to authenticate
				$data["result"] = "Authentication failed";
				$this->load->view('stall_owner_change_password.php', $data);
			}
		}
		else {
				$data["result"] = "Change your password";
				$this->load->view('stall_owner_change_password.php', $data);
		}
	}
	
}
?>