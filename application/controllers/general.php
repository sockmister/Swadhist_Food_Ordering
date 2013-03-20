<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Singapore');
class General extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->helper('general');
		$this->load->database();
		$this->config->load('myapplication');
		//Load models
		$this->load->model('StallModel');
		$this->load->model('CustomerOrderModel');	
		$this->load->model('DishModel');	
		$this->load->model('ReviewModel');	
		$this->load->model('StallOwnerAccountModel');	
		$this->load->model('BlacklistModel');	
		// Constants
		define('ASSEST_URL', base_url().'assets/');				
	}
	
	/**
	 * MAIN PAGE
	 */
	public function index() {	
		$data["stalls"] = StallModel::findAllStalls();
		$this->load->view('mobile/index.php', $data);
	}
	
	/**
	 * PAGE LOADS THE STALL DETAILS
	 * Parameter: the id of  stall
	 */
	public function stall_details($stall_id) {
		if (empty($stall_id)) {
			redirect(site_url("general/system_error/stall_id_empty"));
			return;
		}
		$data["stall"] = StallModel::findStallById($stall_id);
		$data["dishes"] = DishModel::findDishesByStallId($stall_id);
		$this->load->view('mobile/stall_details.php', $data);
	}
	
	/**
	 * PAGE LOADS THE DISH DETAILS
	 *  Parameter: the id of dish
	 */
	public function dish_details($dish_id) {
		
		$dish = DishModel::findDishById($dish_id);
		if ($dish->isAvailable() && !$dish->isSoldOut()) {
			$data['slots'] = CustomerOrderModel::findAvailableSlotsByStallId($dish->stall_id);
		}
		$data['dish'] = $dish;
		$data["avgRate"] = intval(ReviewModel::getAverageRateByDishId($dish_id));
		$data["comments"] = ReviewModel::getCommentsByDishId($dish_id);
		$data["is_customer"] = $this->session->userdata('logged_in') == "customer"?TRUE:FALSE;
		if ($data["is_customer"]) {
			$data["is_in_blacklist"] = BlacklistModel::isExists($this->session->userdata('NUSID'), $dish->stall_id);
		} else {
			$data["is_in_blacklist"] = "0";
		}
		$this->load->view('mobile/dish_details.php', $data);
	}
	
	/**
	 * PAGE FOR SEARCHING DISHES
	 */ 
	public function search() {
		if(isAjax()) {
			$keyword = $this->input->get('search');
			$dishes = DishModel::findDishesByKeywords($keyword);
			$this -> output -> set_content_type('application/json') -> set_output(json_encode($dishes));
		} else {
			$this->load->view('mobile/search.php');
		}
	}
	
	/**
	 * PAGE ABOUT US
	 */
	public function aboutUs() {
		$this->load->view('mobile/about_us.php');
	}
	
	/**
	 * PAGE FOR CONTACT
	 */
	public function contact() {
		$this->load->view('mobile/contact.php');
	}
	
	
	/**
	 * PAGE FOR SIGNING UP A STALL OWNER ACCOUNT
	 */
	public function ownerSignUp() {
		// get input
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$password2 = $this->input->post("password2");
		
		if (!empty($username) && !empty($email) && !empty($password) && !empty($password2)) {
			$is_exist = StallOwnerAccountModel::is_exist($username);
			if ($is_exist == false) {
				$data = array("name" => $username, "email" => $email, "password" => $password);
				$stall_owner_id = StallOwnerAccountModel::signup($data);
				// Automatically login once sign up is successful
				$this->session->set_userdata(
						array(
							"logged_in" => "stallowner", 
							"name" => $username ,
							"email" => $email,
							"owner_id" => $stall_owner_id,
							"stall_id" => ""
						)
					);
				// redirect to dashboard here
				redirect(site_url("stall_owner/createStall"));
			}else {
				// user name already exists, registration unsuccessful
				$data["result"] = "User name already exists";
				$this->load->view('desktop/owner_register.php', $data);
			}
		}
		else {
				$data["result"] = "Enter info to register";
				$this->load->view('desktop/owner_register.php', $data);
		}
	}
	
	
	/**
	 * PAGE FOR STALL OWNER TO GET BACK THE PASSWORD
	 */
	public function forgetPassword() {	
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		
		if (!empty($username) && !empty($email)) {
			// validate stallowner
			$stallowner = StallOwnerAccountModel::retrieve_password($username, $email);
			if ($stallowner != false) {
				// validation successful, proceed to send email
				$password = $stallowner->password;
				// config for email account
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'swadhist.owner@gmail.com',
					'smtp_pass' => 'swadhist123',
					'mailtype'  => 'html',
					'charset' => 'utf-8',
					'wordwrap' => TRUE
				);
				
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				// constructing email
				$to = $email;
				$subject = "Stall Owner Password Retrieval";
				$message = "Stall Owner Admin
							\nHello $username!
							\nHere is the password you requested:
							\nPassword: $password
							\nThank you, the Swadhist Support Team.";
				$from = "swadhist.owner@gmail.com";
				
				// codeigniter format
				$this->email->from($from, 'Swadhist Admin');
				$this->email->to($email);
				$this->email->subject($subject);
				$this->email->message($message);
				
				// sending email
				if ($this->email->send()) {
        			$data["result"] = "Information has been sent to your email, please check shortly.";
    			}
				else {
        			show_error($this->email->print_debugger());
					$data["result"] = "Error sending email";
   				}
				
			}
			else {
				// did not validate successfully, either user entered wrong details or someone is trying to get hack information
				// do nothing here and display the same message
				$data["result"] = "Information has been sent to your email, please check shortly.";
			}
			
			$this->load->view('desktop/owner_forget_pass.php', $data);
		}
		else {
				$data["result"] = "Enter details to retrieve password";
				$this->load->view('desktop/owner_forget_pass.php', $data);
		}
	}
	
	
	/**
	 * PAGE TO SHOW THE SYSTEM ERROR
	 */
	public function system_error() {	
		$error = $this->uri->segment(3);
		echo "Our system has encountered a problem. We are sorry for the inconvenience.<br/>";
		echo "<b>Error code: </b> $error<br/>";
		echo "Please back to <a href='".site_url("general/index")."'> home page </a> and try again or email us the error code you encountered at <a href='mailto:contact@nusprofectus.com?body=Error code:".$error."'>contact@nusprofectus.com<a>";
	}
	
}