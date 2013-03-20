<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'controllers/authentication.php');

class Customer_auth extends Authentication {

	public function __construct() {
		parent::__construct();
		$this->load->model('CustomerAccountModel');			
	}
	
	public function login() {
		parent::login();
		
		// If the data from IVLE is not available, redirect the page to IVLE to get token
		if ($this->uri->segment(3) != 'redirect') {
			if ($this->uri->segment(3) != FALSE)
				$this->session->set_userdata('login_redirect_link', $this->uri->segment(3));
			$redirect_back_link = site_url("customer_auth/login/redirect");
			$ivle_login_link = $this->config->item('IVLE_LOGIN_URL').$redirect_back_link;
			redirect($ivle_login_link);
			return;
		} 
		
		// Get token from IVLE and get the information of users
		$user_data["token"] = $_GET['token'];
		if (!empty($user_data["token"])) {
			$url_get_ui = $this->config->item('IVLE_UI_URL').$user_data["token"];
			$url_get_name = $this->config->item('IVLE_NAME_URL').$user_data["token"];
			$NUSID  = str_replace('"', '', file_get_contents($url_get_ui));
			$name = str_replace('"', '', file_get_contents($url_get_name));
			
			/**
			 * Check database whether the user exist or not.
			 * If not, insert the information into database. Otherwise, log in user into system.
			 */
			$is_exist = CustomerAccountModel::isExist($NUSID);
			if ($is_exist != FALSE) {
				$this->session->set_userdata(array(
					"logged_in" => "customer", 
					"NUSID" => $NUSID, 
					"name" => $is_exist->name,
					"email" => $is_exist->email,
					"phone_number" => $is_exist->phone_number
				));
				if ($this->session->userdata('login_redirect_link') == FALSE) {
					redirect(site_url("general/index"));
				} else {
					$login_redirect_link = str_replace("__", "/", $this->session->userdata('login_redirect_link'));
					$this->session->unset_userdata('login_redirect_link');
					redirect(site_url($login_redirect_link));
				}
			} else {
				// Add new customer
				$customer = new Customer_($NUSID, $name, "", $NUSID."@nus.edu.sg");
				CustomerAccountModel::addCustomer($customer);
				$this->session->set_userdata(array(
					"logged_in" => "customer", 
					"NUSID" => $NUSID, 
					"name" => $name, 
					"email" => $NUSID."@nus.edu.sg", 
					"phone_number" =>''
				));
				$redirect_link = $this->session->userdata('login_redirect_link');
				// redirect them to general/index
				if (empty($redirect_link))
						$this->session->set_userdata('login_redirect_link', "general__index");
				redirect(site_url("customer/update_info"));
			}
		} else {
			redirect(site_url("general/system_error/loginredirect_notoken"));
		}
	}
	
	public function logout() {
		parent::logout();
		redirect(site_url("general/index"));
	}
}
?>