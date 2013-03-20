<?
class Owner {
	var $id, $name, $email, $password;
	
	public function __construct($id, $name, $email, $password) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}
}

class StallOwnerAccountModel extends CI_Model {
	private static $db;
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
    
	static function authenticate($username, $password) {
		if(!empty($username) && !empty($password)) {
			$query = self::$db->get_where('stall_owner', array('name' => $username, 'password' => $password), 1);
			if($query->num_rows()==1) {
				return $query->first_row("Owner");
			}
			else {
				return false;
			}
		}
		return false;
	}
	
	function is_exist($username) {
		if(!empty($username)) {
			$query = self::$db->get_where('stall_owner', array('name' => $username), 1);
			if($query->num_rows()==1) {
				return $query->first_row("Owner");
			}
			else {
				return false;
			}
		}
		return false;
	}
	
	function signup($data) {
		if (!empty($data) && !empty($data["name"])) {
			self::$db->insert('stall_owner', $data); 
			return self::$db->insert_id();
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
			self::$db->where('name', $username);
			self::$db->update('stall_owner', $data); 
			return true;
		}
		else {
			return false;
		}
		return false;
	}
	
	function retrieve_password($username, $email) {
		if(!empty($username) && !empty($email)) {
			$query = self::$db->get_where('stall_owner', array('name' => $username, 'email' => $email), 1);
			if($query->num_rows()==1) {
				return $query->first_row("Owner");
			}
			else {
				return false;
			}
		}
		return false;
	}
	
}

?>