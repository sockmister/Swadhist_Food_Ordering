<?php
class Stall_owner extends CI_Controller{
	/*
	getStallOrder() gets all the current stall orders and display
	them
	*/
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
	
	
	/**
	 * Create a default stall for new owner
	 */
	public function createStall() {
		$this->load->model('StallAdminModel');
		$stall = new Stall("name", "contact", "", "");
		$stall->owner_id = $this->session->userdata('owner_id');
		
		$stall_id = StallAdminModel::addStall($stall);
		if ($stall_id != 0) {
			$this->session->set_userdata("stall_id", $stall_id);
			redirect(site_url("stall_owner/updateStallInfo"));
		} else {
			echo "error to add the new stall";
		}
	}
	
	/**
	 * Update the information of stall
	 */
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
	
	/**
	 * Update the stall owner information
	 */
	public function update_details() {
		$this->load->model('StallOwnerAccountModel');
		
		$email = $this->input->post("email");
		
		if (!empty($email)) {
			$username = $this->session->userdata('name');
			$data = array("name" => $username, "email" => $email);
			$stallowner = StallOwnerAccountModel::update_details($username, $data);
			
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
				$this->load->view('desktop/owner_update_details.php', $data);
			}
			else {
				// update failed for some reason
				$data["result"] = "Update failed";
				$this->load->view('desktop/owner_update_details.php', $data);
			}
		}
		else {
				$data["result"] = "Change details to update";
				$this->load->view('desktop/owner_update_details.php', $data);
		}
		
	}
	
	/**
	 * The page for stall owner to change password
	 */
	public function change_password() {
		$this->load->model('StallOwnerAccountModel');
		
		$password = $this->input->post("password");
		$newpassword = $this->input->post("newpassword");
		
		if (!empty($password) && !empty($newpassword)) {
			$username = $this->session->userdata('name'); 
			$stallowner = StallOwnerAccountModel::authenticate($username, $password);
			
			if ($stallowner != false) {
				$username = $stallowner->name;
				$data = array("name" => $username, "password" => $newpassword);
			
				$stallowner = StallOwnerAccountModel::change_password($username, $data);
			
				if ($stallowner != false) {
					// change new password
					$data["result"] = "Password changed successfully";
					$this->load->view('desktop/owner_change_pass.php', $data);
				}
				else {
					// changed failed for some reason
					$data["result"] = "Change password failed";
					$this->load->view('desktop/owner_change_pass.php', $data);
				}
			}
			else {
				// failed to authenticate
				$data["result"] = "Authentication failed";
				$this->load->view('desktop/owner_change_pass.php', $data);
			}
		}
		else {
				$data["result"] = "Change your password";
				$this->load->view('desktop/owner_change_pass.php', $data);
		}
	}
	
	
	/**
	 *
	 */ 
	public function getStallOrder() {
		//load model
		$this->load->model("StallOwnerOrderModel");
		
		//get orders 
		$data['Processing'] = StallOwnerOrderModel::getProcessedOrders($this->session->userdata('stall_id'));
		$data['ReadyToCollect'] = StallOwnerOrderModel::getReadyOrders($this->session->userdata('stall_id'));
		
		//send to view
		$data["top_bar_selected"] = "tb_manage_queue";
		$this->load->view('desktop/live_queue_interface.php', $data);
	}
	
	
	
	public function getIncompleteOrder(){	
		//load model
		$this->load->model("StallOwnerOrderModel");
		$this->load->model("BlacklistModel");

		$data['Incomplete'] = StallOwnerOrderModel::getIncompleteOrders($this->session->userdata('stall_id'));
		$data['Blacklisted'] = BlacklistModel::getBlacklistedUsers($this->session->userdata('stall_id'));
		
		$data["top_bar_selected"] = "tb_manage_queue";
		$this->load->view('desktop/live_collected_interface.php', $data);
	}
	
	
	
	public function manageQueueSlot(){	
		//load model
		$this->load->model("StallAdminModel");
		
		$data['slotQuota'] = StallAdminModel::getStallSlots($this->session->userdata('stall_id'));
		$data["top_bar_selected"] = "tb_queue_slot";
		$this->load->view('desktop/slotManager.php', $data);
	}
	
	
	/**
	 * Ajax to update slot
	 */
	public function updateSlot(){
		//load model
		$this->load->model("StallAdminModel");
		$slot_data = $this->input->post("slot_data");
		StallAdminModel::updateSlot($this->session->userdata('stall_id'), $slot_data);
	}
	
	
	public function manageMenu() {
		//load model
		$this->load->model("DishModel");
		
		$data['dishes'] = DishModel::findDishesByStallId($this->session->userdata('stall_id'));
		$data['menuArray'] = DishModel::getAllDishMenu($this->session->userdata('stall_id'));
	
		$data["top_bar_selected"] = "tb_menu_manage";
		$this->load->view('desktop/menuManager.php', $data);
	}
	
	/**
	 * Ajax
	 */
	public function deleteDish($dish_id) { 
		
		//load model
		$this->load->model("DishModel");
		$this->load->model("StallDishModel");
		
		StallDishModel::deleteDish($dish_id);
		$data['dishes'] = DishModel::findDishesByStallId($this->session->userdata('stall_id'));
		echo "1";
	}
	
	/**
	 * Ajax
	 */
	public function updateDish() {
		$dish_id = $this->input->post("dish_id");
		$dish_name = $this->input->post("dish_name");
		$dish_description = $this->input->post("dish_description");
		$dish_img = $this->input->post("dish_image_link");
		$dish_price = $this->input->post("dish_price");
		$days_checked = $this->input->post("days_checked");

		//load model
		$this->load->model("StallDishModel");
		StallDishModel::updateDish($dish_id, $dish_name, $dish_description, $dish_img, $dish_price, $days_checked); 
	}
	
	
	/*
	 * Ajax
	 */
	public function addDish(){
		$dish_name = $this->input->post("dish_name");
		$dish_description = $this->input->post("dish_description");
		$dish_img = $this->input->post("dish_image_link");
		$dish_price = $this->input->post("dish_price");
		$days_checked = $this->input->post("days_checked");
		$stall_id = $this->session->userdata('stall_id');
		$this->load->model("StallDishModel");
		$dish_id = StallDishModel::addDish($stall_id, $dish_name, $dish_description, $dish_img, $dish_price, $days_checked);
		echo $dish_id;
	}
	
	public function addBlacklistUser(){
		$this->load->model("StallOwnerOrderModel");
		$orderID = $this->input->post("orderID");
		StallOwnerOrderModel::setOrderStatus($orderID, 4);
		
		$this->load->model("BlacklistModel");
		$customer_id = $this->input->post("customerID");
		if(BlacklistModel::addUser($customer_id, $this->session->userdata('stall_id')) == 1)
			echo 1;
		else
			echo 0;
	}
	
	public function removeBlacklistUser(){
		$this->load->model("BlacklistModel");
		$customer_id = $this->input->post("customerID");
		BlacklistModel::removeUser($customer_id, $this->session->userdata('stall_id'));
		echo 1;
	}
	
	
	public function manageSales(){
		$this->load->model("StallReportModel");
		$data['sales'] = StallReportModel::getYearSales($this->session->userdata('stall_id'));
		$data["top_bar_selected"] = "tb_sales";
		$this->load->view('desktop/salesManager', $data);
	}
	
	public function monthSales($year, $month){
		$this->load->model("StallReportModel");
		$data['sales'] = StallReportModel::getMonthSales($this->session->userdata('stall_id'), $year, $month);
		$data["top_bar_selected"] = "tb_sales";
		$this->load->view('desktop/salesManagerMonth', $data);
	}
	
	public function daySales($year, $month, $day){
		$this->load->model("StallReportModel");
		$data['sales'] = StallReportModel::getDaySales($this->session->userdata('stall_id'), $year, $month, $day);
		$data['resolveSales'] = StallReportModel::getDayResolveSales($this->session->userdata('stall_id'), $year, $month, $day);
		$data["top_bar_selected"] = "tb_sales";
		$this->load->view('desktop/salesManagerDay', $data);
	}
	
	public function report($limit = 5, $period = NULL) {
		$this->load->model('StallReportModel');
		$best_seller_report = StallReportModel::bestSellers($this->session->userdata('stall_id'), $period);
		$data['bestSeller'] = $best_seller_report->getPieChartLink($limit, "3072F3");
		$hourly_selling_report = StallReportModel::reportHourlySelling($this->session->userdata('stall_id'), $period);
		$data['hourlySelling'] = $hourly_selling_report->getPieChartLink($limit);
		$this->load->view('desktop/reportView', $data);
	}
	
	
	/*
	 * Ajax
	 * 
	 */
	public function readyToCollect(){
		$orderID = $_GET["orderID"];
		
		$this->load->model('StallOwnerOrderModel');
		StallOwnerOrderModel::setOrderStatus($orderID, 1);
		
		
		/**
		 * call sently service to send sms 
		 */
		 $order = StallOwnerOrderModel::customerPhoneNumber($orderID);
		 if (!empty($order->customer_phone_number)) {
		 	$username = $this->config->item('SENTLY_USERNAME');
		 	$password = $this->config->item('SENTLY_PASSWORD');
			$message = urlencode("The ".$order->dish_name." is ready to collect");
			$url_link = 'https://sent.ly/command/sendsms?username='.$username.'&password='.$password.'&to='.urlencode($order->customer_phone_number).'&text='.$message;
		 	$senty_return = file_get_contents($url_link);
			echo $senty_return;
		 } else {
		 	echo "no sms";
		 }
	}
	
	
	public function orderCompleted(){
		$orderID = $_GET["orderID"];
		$this->load->model('StallOwnerOrderModel');
		StallOwnerOrderModel::setOrderStatus($orderID, 2);	//status 2 for completed order
	}
	
	public function orderIncomplete(){
		$orderID = $_GET["orderID"];
		$this->load->model('StallOwnerOrderModel');
		StallOwnerOrderModel::setOrderStatus($orderID, 3);	//status 3 for incomplete order
	}
	
	public function orderResolve(){
		$orderID = $_GET["orderID"];
		$this->load->model('StallOwnerOrderModel');
		StallOwnerOrderModel::setOrderStatus($orderID, 4);	//status 4 for resolved order
	}
	
	public function ajaxOrder() {
		$this->load->model("StallOwnerOrderModel");
		$data['Processing'] = StallOwnerOrderModel::getProcessedOrders($this->session->userdata('stall_id'));
		echo $this->load->view('desktop/queue_table', $data);
	}
	
	public function ajaxIncomplete(){
		$this->load->model("StallOwnerOrderModel");
		$data['Incomplete'] = StallOwnerOrderModel::getIncompleteOrders($this->session->userdata('stall_id'));
		echo $this->load->view('desktop/incomplete_table', $data);
	}
	
	public function ajaxBlacklist(){
		$this->load->model("BlacklistModel");
		$data['Blacklisted'] = BlacklistModel::getBlacklistedUsers($this->session->userdata('stall_id'));
		echo $this->load->view('desktop/blacklist_table', $data);
	}
	
	public function pendingPrepareOrder() {
		$this->load->model("StallOwnerOrderModel");
		$data['Processing'] = StallOwnerOrderModel::getProcessedOrders($this->session->userdata('stall_id'));
		echo $this->load->view('desktop/queue_table', $data);
	}
	
	public function pendingCollectionOrder() {
		$this->load->model("StallOwnerOrderModel");
		$data['ReadyToCollect'] = StallOwnerOrderModel::getReadyOrders($this->session->userdata('stall_id'));
		echo $this->load->view('desktop/collection_table', $data);
	}
	
}
?>
