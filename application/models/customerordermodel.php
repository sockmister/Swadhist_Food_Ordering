<?
ini_set('date.timezone', 'Asia/Singapore');
class Slot {
	var $id, $stall_id, $start_at, $end_at, $quantity, $no_available;
	
	function displayStartTime() {
		$endString = intval($this->start_at*60)%60;
		if ($endString < 10)
			$endString = "0".$endString;
		return (intval($this->start_at)).":".$endString;
	}
	
	function displayEndTime() {
		$endString = intval($this->end_at*60)%60;
		if ($endString < 10)
			$endString = "0".$endString;
		return (intval($this->end_at)).":".$endString;
	}
}

class Order {
	var $id, $user_id, $dish_id, $quantity, $slot_id, $order_date, $order_time, $status, $note;
	private static $db_attributes = array('user_id', 'dish_id', 'quantity', 'slot_id', 'order_date', 'order_time', 'status');
	public static $ERRORS = array(
		"0" => "The dish is not available today",
		"1" => "The dish is sold out",
		"2" => "Only XXXX dishes are left for order.",
		"3" => "The slot capacity is XXXX dishes.",
		"4" => "You are in the black list of this stall."
	);
	
	public function __construct($user_id, $dish_id, $quantity, $slot_id) {
		$current =  getdate();
		$this->user_id = $user_id;
		$this->dish_id = $dish_id;
		$this->quantity = $quantity;
		$this->slot_id = $slot_id;
		$this->order_date =  $current['year'].'-'.$current['mon'].'-'.$current['mday'];
		$this->order_time = $current["hours"] + $current["minutes"]/60;
		$this->status = 0;
	}
	public function getDBAttributes() {
		$data = array();
		foreach(Order::$db_attributes as $name) {
			$data[$name] = $this->$name;
		}
		return $data;
	}
}

class CustomerOrderModel extends CI_Model {
	protected static $db;
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
    
	public static function findActiveOrdersByUserId($user_id) {
		$current =  getdate();
		$sql = "
			SELECT dishes.name AS dish_name, stalls.name AS stall_name, start_at, end_at, 
						status, orders.quantity AS quantity, (orders.quantity*dishes.price) AS total_price 
			FROM orders, dishes, stalls, slots 
			WHERE user_id = ? AND order_date = ? 
						 AND dishes.id = orders.dish_id AND dishes.stall_id = stalls.id AND orders.slot_id = slots.id 
						 AND (orders.status = '0' || orders.status = '1') 
			ORDER BY orders.status DESC, orders.id ";
		return self::$db->query($sql, array($user_id, $current['year'].'-'.$current['mon'].'-'.$current['mday']))->result();
	}
	
	public static function findOldOrdersByUserId($user_id) {
		$current =  getdate();
		$sql = "
			SELECT dishes.name AS dish_name, stalls.name AS stall_name, start_at, end_at, 
						status, orders.quantity AS quantity, (orders.quantity*dishes.price) AS total_price , order_date
			FROM orders, dishes, stalls, slots 
			WHERE user_id = ? AND order_date < ? 
						 AND dishes.id = orders.dish_id AND dishes.stall_id = stalls.id AND orders.slot_id = slots.id
			ORDER BY order_date DESC, orders.status DESC, orders.id
			LIMIT 10
			";
		return self::$db->query($sql, array($user_id, $current['year'].'-'.$current['mon'].'-'.$current['mday']))->result();
	}
	
	public static function findAvailableSlotsByStallId($stall_id) {
		$current =  getdate();
		$current_time = $current["hours"] + $current["minutes"]/60;
		$sql = "
			SELECT *, (slots.quantity - (
				SELECT IFNULL(sum(orders.quantity), 0) 
				FROM orders 
				WHERE order_date = ?
				AND orders.slot_id = slots.id)) AS no_available 
			FROM slots 
			WHERE stall_id = ? AND  start_at > ? 
			ORDER BY start_at ASC";
		return self::$db->query($sql, array($current['year'].'-'.$current['mon'].'-'.$current['mday'], $stall_id, $current_time))->result('Slot');
	}
	
	public static function order($order) {
		$current =  getdate();
		
		//check whether in the black list or not
		$black_list_sql = "
			SELECT 1 
			FROM black_list, dishes
			WHERE black_list.customer_id = ?
						AND black_list.stall_id = dishes.stall_id
						AND  dishes.id = ?
		";
		$black_list_query = self::$db->query($black_list_sql, array($order->user_id, $order->dish_id));
		if ($black_list_query->num_rows()  > 0)
			return Order::$ERRORS[4];
		
		
		//check the dish available today or not
		$menu_query = self::$db->get_where('menu', array('dish_id' => $order->dish_id, 'day' => $current['wday']), 1);
		if ($menu_query->num_rows() == 0)
			return Order::$ERRORS[0];
		
		// check the dish is sold out or not
		$total_quantity = $menu_query->first_row()->quantity;
		$count_order_sql = "
			SELECT  IFNULL(sum(quantity), 0) AS no
			FROM orders 
			WHERE order_date = ?  AND dish_id = ? ";
		$no_order_query = self::$db->query($count_order_sql, array($order->order_date, $order->dish_id));
		if ($total_quantity <= $no_order_query->first_row()->no)
			return Order::$ERRORS[1];
		
		// check the order quantity and the quantity left
		if ($order->quantity > ($total_quantity - $no_order_query->first_row()->no))
			return str_replace("XXXX", $total_quantity - $no_order_query->first_row()->no, Order::$ERRORS[2]);
		
		// check the quantity which can serve for this slot
		$slot_quantity_sql = "
			SELECT (slots.quantity - (
				SELECT  IFNULL(sum(orders.quantity), 0) 
				FROM orders 
				WHERE order_date = ? AND orders.slot_id = slots.id)) AS no_available 
			FROM slots WHERE id = ?";
		$slot_quantity = self::$db->query($slot_quantity_sql, array($order->order_date, $order->slot_id))->first_row()->no_available;
		if ($order->quantity  > $slot_quantity)
			return str_replace("XXXX", $slot_quantity, Order::$ERRORS[3]);
		
		// insert
		self::$db->insert('orders', $order->getDBAttributes());
		return "1";
	}
}

?>