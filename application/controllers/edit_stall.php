<?php
class Edit_stall extends CI_Controller{
	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->database();
		$this->config->load('myapplication');
		define('ASSEST_URL', base_url().'assets/');		
		// check permission
		if($this->session->userdata('logged_in') != "stallowner") {
			$this->session->set_userdata('redirect_link', current_url());
			redirect(site_url("stall_owner_auth/login"));
			return;
		}		
	}
	
	public function updateStallInfo() {
		$this->load->model('StallAdminModel');
		$stall_id = $this->session->userdata('stall_id');
		if ($this->input->post("submitted") == "submitted") {
			$stall = new Stall($this->input->post("name"), $this->input->post("contact"), $this->input->post("description"), $this->input->post("img"));
			$stall->id = $stall_id;
			if (StallAdminModel::updateStallInfo($stall) == 1) {
				$data["message"] = "Your information is updated successfully!";
			} else {
				$data["message"] = "There is an error when updating the information, please try again!";
			}
		}
		
		$data["stall"] = StallAdminModel::findStallById($stall_id);
		$data["top_bar_selected"] = "tb_stall_info";
		$this->load->view('desktop/edit_stall_info', $data);
	}
	
	public function createStall() {
		$this->load->model('StallAdminModel');
		$stall = new Stall("name", "contact", "", "");
		$stall->owner_id = $this->session->userdata('owner_id');
		
		$stall_id = StallAdminModel::addStall($stall);
		if ($stall_id != 0) {
			$this->session->set_userdata("stall_id", $stall_id);
			redirect(site_url("edit_stall/updateStallInfo"));
		} else {
			echo "error to add the new stall";
		}
	}
	
	
	public function test() {
		$start_at = 0.0;
		$end_at = 0.5;
		$slots = array();
		
	}
}

?>