<?
class Customer_ {
	var $NUSID, $name, $phone_number, $email, $created;
	public function __construct($NUSID, $name, $phone_number, $email) {
		$this->NUSID = $NUSID;
		$this->name = $name;
		$this->phone_number = $phone_number;
		$this->email = $email;
		$this->created = date('Y-m-d H:i:s');
	}
}

class CustomerAccountModel extends CI_Model {
	private static $db;
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
    
	public static function isExist($user_id) {
		if(!empty($user_id)) {
			$query = self::$db->get_where('customers', array('NUSID' => $user_id), 1);
			if($query->num_rows()>0) {
				return $query->first_row('Customer_');
			} else {
				return FALSE;
			}
		}
		return FALSE;
	}
	
	public static function addCustomer($customer) {
		if (!empty($customer->NUSID)) {
			self::$db->insert('customers', $customer); 
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public static function update($customer) {
		if (!empty($customer->NUSID)) {
			self::$db->where('NUSID', $customer->NUSID);
			self::$db->update('customers', $customer); 
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>