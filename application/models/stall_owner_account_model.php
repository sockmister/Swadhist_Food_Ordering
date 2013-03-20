<?
class Stall_owner_account_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
	function authenticate($username, $password) {
		if(!empty($username) && !empty($password)) {
			$query = $this->db->get_where('stall_owner', array('name' => $username, 'password' => $password), 1);
			if($query->num_rows()==1) {
				return $query->first_row();
			}
			else {
				return false;
			}
		}
		return false;
	}
	
	function is_exist($username) {
		if(!empty($username)) {
			$query = $this->db->get_where('stall_owner', array('name' => $username), 1);
			if($query->num_rows()==1) {
				return $query->first_row();
			}
			else {
				return false;
			}
		}
		return false;
	}
	
	function signup($data) {
		if (!empty($data) && !empty($data["name"])) {
			$this->db->insert('stall_owner', $data); 
			return $this->db->insert_id();
		}
		else {
			return 0;
		}
		return 0;
	}
	
	function update_details($username, $data) {
		if (!empty($username)) {
			$this->db->where('name', $username);
			$this->db->update('stall_owner', $data); 
			return true;
		}
		else {
			return false;
		}
		return false;
	}
	
	function change_password($username, $data) {
		if (!empty($username)) {
			$this->db->where('name', $username);
			$this->db->update('stall_owner', $data); 
			return true;
		}
		else {
			return false;
		}
		return false;
	}
	
	function retrieve_password($username, $email) {
		if(!empty($username) && !empty($email)) {
			$query = $this->db->get_where('stall_owner', array('name' => $username, 'email' => $email), 1);
			if($query->num_rows()==1) {
				return $query->first_row();
			}
			else {
				return false;
			}
		}
		return false;
	}
	
}

?>