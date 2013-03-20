<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'controllers/general.php');

class Customer extends General {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		$this->load->helper('general');
		// Load models
		$this->load->model('CustomerAccountModel');		
		$this->load->model('DishModel');	
		$this->load->model('CustomerOrderModel');	
		$this->load->model('ReviewModel');	
		// Define constant
		define('ASSEST_URL', base_url().'assets/');	
		// Check permission
		if($this->session->userdata('logged_in') != "customer") {
			if(isAjax()) {
				echo 0;
				exit;
			} else {
				$this->session->set_userdata('redirect_link', current_url());
				redirect(site_url("customer_auth/login"));
				return;
			}
		}					
	}
	
	public function index() {
		$data["orders"] = CustomerOrderModel::findActiveOrdersByUserId($this->session->userdata('NUSID'));
		$data["order_logs"] = CustomerOrderModel::findOldOrdersByUserId($this->session->userdata('NUSID'));
		$this->load->view('mobile/customer_index.php', $data);
	}
	
	public function update_info() {
		if ($this->input->post("submitted") == "submitted") {
			$data = array(
				"name" =>  $this->input->post("contactName"), 
				"email" => $this->input->post("contactEmail"), 
				"phone_number" => $this->input->post("contactPhone"));
			// add +65 if the phone number is less than 10 digits
			if(strlen($data["phone_number"]) < 10) {
				$data["phone_number"] = "+65".$data["phone_number"];
			}
			$customer = new Customer_($this->session->userdata('NUSID'), $data["name"], $data["phone_number"], $data["email"]);
			CustomerAccountModel::update($customer);
			$this->session->set_userdata(array(
				"name" => $data["name"], 
				"email" => $data["email"],
				"phone_number" => $data["phone_number"]));
			// if the request is ajax, return the data only
			if(isAjax()) {
				echo $this->session->userdata('NUSID');
				return 1;
			} 
			// if it is not ajax, redirect the other page
			if ($this->session->userdata('login_redirect_link') != FALSE) {
				$login_redirect_link = str_replace("__", "/", $this->session->userdata('login_redirect_link'));
				$this->session->unset_userdata('login_redirect_link');
				redirect(site_url($login_redirect_link));
			} else {
				$this->load->view('mobile/update_info.php');
			}
		} else {
			$this->load->view('mobile/update_info.php');
		}
	}
	
	
	public function makeOrder() {
		if ($this->input->post("submitted") == "submitted") {
			$dish_id = $this->input->post("dishId");
			$slot_id = $this->input->post("orderSlot");
			$quantity = $this->input->post("orderQuantity");
			$order = new Order($this->session->userdata('NUSID'), $dish_id, $quantity, $slot_id);
			echo CustomerOrderModel::order($order);
		} else {
			echo "The required fields are empty";
		}
	}
	
	public function comment() {
		$dish_id =  $this->input->post("dish_id");
		$comment = $this->input->post("comment");
		
		if (empty($dish_id) || empty($comment)) {
			echo 0;
		} else {
			$comment = new Comment($this->session->userdata('NUSID'), $dish_id, $comment);
			echo ReviewModel::insertComment($comment);
		}
	}
	
	public function rate() {
		$dish_id =  $this->input->post("dish_id");
		$rate = $this->input->post("rate");
		
		if (empty($dish_id) || empty($rate)) {
			echo 0;
		} else {
			$rate = new Rate($this->session->userdata('NUSID'), $dish_id, $rate);
			echo ReviewModel::insertRate($rate);
		}
	}
}
?>