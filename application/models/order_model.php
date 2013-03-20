<?

/*
Status of order:

0: processing
1: ready to collect
2: complete
3: incomplete

*/

ini_set('date.timezone', 'Asia/Singapore');
class Slot {
	var $id;
	var $stall_id;
	var $start_at;
	var $end_at;
	var $quantity;
	var $no_available;
	
	function getStartTime() {
		$endString = intval($this->start_at*60)%60;
		if ($endString < 10)
			$endString = "0".$endString;
		return (intval($this->start_at)).":".$endString;
	}
	
	function getEndTime() {
		$endString = intval($this->end_at*60)%60;
		if ($endString < 10)
			$endString = "0".$endString;
		return (intval($this->end_at)).":".$endString;
	}
}


class Order_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getUserActiveOrders($NUSID) {
		$current =  getdate();
		$sql = "SELECT dishes.name AS dish_name, stalls.name AS stall_name, start_at, end_at, status, orders.quantity AS quantity, (orders.quantity*dishes.price) AS total_price FROM orders, dishes, stalls, slots WHERE user_id = '".$NUSID."' AND order_date = '".$current['year'].'-'.$current['mon'].'-'.$current['mday']."' AND dishes.id = orders.dish_id AND dishes.stall_id = stalls.id AND orders.slot_id = slots.id AND (orders.status = '0' || orders.status = '1') ORDER BY orders.status DESC, orders.id ";
		$query = $this->db->query($sql);
		return $query->result();
	}
    
	/**
	 * Return the list of slots which users can order
	 */
	function getAvailableSlot($stall_id) {
		$current =  getdate();
		$current_time = $current["hours"] + $current["minutes"]/60;
		$sql = "SELECT *, (slots.quantity - (SELECT IFNULL(sum(orders.quantity), 0) FROM orders WHERE order_date = '".$current['year'].'-'.$current['mon'].'-'.$current['mday']."' AND orders.slot_id = slots.id)) AS no_available
					FROM slots 
					WHERE stall_id = ".$stall_id." AND  start_at > ".$current_time." 
					ORDER BY start_at ASC
				";
		$query = $this->db->query($sql);
		return $query->result('Slot');
	}
	
	function order($NUSID, $dish_id, $slot_id, $quantity) {
		$current =  getdate();
		$order_date =  $current['year'].'-'.$current['mon'].'-'.$current['mday'];
		$order_time = $current["hours"] + $current["minutes"]/60;
		
		//check the dish available today or not
		$menu_query = $this->db->get_where('menu', array('dish_id' => $dish_id, 'day' => $current['wday']), 1);
		if ($menu_query->num_rows() == 0)
			return "The dish is not available today";
		
		$total_quantity = $menu_query->first_row()->quantity;
		// check the dish is sold out or not
		$count_order_sql = "SELECT  IFNULL(sum(quantity), 0) AS no FROM orders WHERE order_date = '".$current['year'].'-'.$current['mon'].'-'.$current['mday']."'  AND dish_id = '".$dish_id."' ";
		$no_order_query = $this->db->query($count_order_sql);
		if ($total_quantity == $no_order_query->first_row()->no) {
			return "The dish is sold out";
		}
		
		// check the order quantity and the quantity left
		if ($quantity > ($total_quantity - $no_order_query)) {
			return "Only ".($total_quantity - $no_order_query)." dishes are left for order.";
		}
		
		
		// check the quantity which can serve for this slot
		$slot_quantity_sql = "SELECT (slots.quantity - (SELECT  IFNULL(sum(orders.quantity), 0) FROM orders WHERE order_date = '".$current['year'].'-'.$current['mon'].'-'.$current['mday']."' AND orders.slot_id = slots.id)) AS no_available FROM slots WHERE id = '".$slot_id."'";
		$slot_quantity_query = $this->db->query($slot_quantity_sql);
		$slot_quantity = $slot_quantity_query->first_row()->no_available;
		
		if ($quantity  > $slot_quantity) {
			return "The slot capacity is ".$slot_quantity." dishes.";
		}
		
		
		$this->db->insert('orders', array("user_id" => $NUSID, "dish_id" => $dish_id, "quantity" => $quantity, "slot_id" => $slot_id, "order_date" => $order_date, "order_time" => $order_time, "status" => 0));
		
		return "1";
	}
}

?>