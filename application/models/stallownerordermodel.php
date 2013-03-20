<?
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/customerordermodel.php');


class StallOwnerOrderModel extends CustomerOrderModel {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
    
	public static function getProcessedOrders($stall_id) {
		$sql = "
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
						dishes.name, (orders.quantity * dishes.price) AS price
			FROM orders, dishes 
			WHERE orders.dish_id = dishes.id AND orders.status = '0' AND dishes.stall_id = '".$stall_id."' ";
		return $query = self::$db->query($sql)->result();
	}
	
	public static function getReadyOrders($stall_id) {
		$sql = "
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
						dishes.name, (orders.quantity * dishes.price) AS price
			FROM orders, dishes 
			WHERE orders.dish_id = dishes.id AND orders.status = '1' AND dishes.stall_id = '".$stall_id."' ";
		return self::$db->query($sql)->result();
	}
	
	public static function getIncompleteOrders($stall_id){
		$sql = "
			
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, dishes.name,
					(orders.quantity * dishes.price) AS price
			FROM orders, dishes
			WHERE orders.dish_id = dishes.id AND orders.status = '3' AND dishes.stall_id = '".$stall_id."' 
					AND NOT EXISTS (SELECT 1 FROM black_list WHERE black_list.customer_id = orders.user_id)
			ORDER BY orders.order_time
			";
		return self::$db->query($sql)->result();
	}
	
	public static function setOrderStatus($orderID, $status) {
		self::$db->update('orders', array("status" => $status), array('id' => $orderID));
	}
	
	public static function customerPhoneNumber($orderID) {
		$sql = "
			SELECT customers.phone_number AS customer_phone_number, dishes.name AS dish_name
			FROM customers, orders, dishes
			WHERE customers.NUSID = orders.user_id 
						AND dishes.id = orders.dish_id 
						AND orders.id = ?
		";
		return self::$db->query($sql, $orderID)->first_row();
	}
}

?>