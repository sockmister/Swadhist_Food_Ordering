<?
ini_set('date.timezone', 'Asia/Singapore');
class Blacklist {
	var $customer_id, $stall_id;
}

class BlacklistModel extends CI_Model {
	private static $db;
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
	
	public static function getBlacklistedUsers($stall_id){
		$sql = "
			SELECT customers.NUSID, customers.name, customers.phone_number, customers.email
			FROM customers, black_list
			WHERE customers.NUSID = black_list.customer_id AND black_list.stall_id = ".$stall_id."
			";
		return self::$db->query($sql)->result();
	}
	
	public static function isExists($customer_id, $stall_id) {
		$query = self::$db->get_where('black_list', array('customer_id' => $customer_id, 'stall_id' => $stall_id), 1);
		if ($query->num_rows() > 0) {
			return "1";
		} else {
			return "0";
		}
	}
	
	public static function addUser($customer_id, $stall_id){
		echo $customer_id;
		$sql = "
			SELECT *
			FROM customers
			WHERE customers.NUSID = '".$customer_id."'
		";
		echo $sql;
		$username_query = self::$db->query($sql);
		if($username_query->num_rows() == 0){
			return 0;
		}
		
		$sql = "
			INSERT INTO black_list (customer_id, stall_id)
			VALUES ('".$customer_id."', ".$stall_id.")
		";
		
		self::$db->query($sql);
		return 1;
	}
	
	public static function removeUser($customer_id, $stall_id){
		$sql = "
			DELETE FROM black_list
			WHERE black_list.customer_id = '".$customer_id."'
			AND black_list.stall_id = ".$stall_id."
		";
		echo $sql;
		self::$db->query($sql);
	}
}
?>