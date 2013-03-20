<?
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/order_model.php');


class Admin_order_model extends Order_model {
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }
	
	static function initStall($user_id){
		//create stall in db
		$query = "INSERT INTO stalls(name) 
				VALUES('".stall_name."')";
		$this->db->query($query);
		$stall_id = $this->db->insert_id();
		
		//link stall_id to user_id
		$query = "INSERT INTO owning(owner_id, stall_id)
					VALUES('".$user_id."',
							'".$stall_id."')";
		
		//create slots in db with stallID
		$start_at = 0.0;
		$end_at = 0.5;
		for($i = 0; $i < 48; $i++){
			$query = "INSERT INTO slots(stall_id, start_at, end_at, quantity)
					VAlUES('".$stall_id."',
							'".$start_at."',
							'".$end_at."', 0)";
			$this->db->query($query);
			$start_at += 0.0;
			$end_at += 0.5;
			if($end_at == 24.0)
				$end_at = 0.0;
		}
	}
	
	function getProcessedOrders($stall_id)
	{
		/*
		$query = $this->db->get('orders');
		return $query->result_array();
		*/
		//$sql = "SELECT * FROM orders";
		//, dishes WHERE orders.id = dishes.id";
		$query = $this->db->query("SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
										   dishes.name, (orders.quantity * dishes.price) AS price
								 FROM orders, dishes 
								 WHERE orders.dish_id = dishes.id AND orders.status = '0' AND dishes.stall_id = '".$stall_id."' ");
		return $query->result();
		//print_r( $query->result());
	}
	
	function getReadyOrders($stall_id)
	{
		$query = $this->db->query("SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
										  dishes.name, (orders.quantity * dishes.price) AS price
								 FROM orders, dishes 
								 WHERE orders.dish_id = dishes.id AND orders.status = '1' AND dishes.stall_id = '".$stall_id."' ");
		return $query->result();
	}
	
	function getIncompleteOrders($stall_id){
		$sql = "
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, dishes.name,
					(orders.quantity * dishes.price) AS price
			FROM orders, black_list, dishes
			WHERE orders.dish_id = dishes.id AND orders.status = '3' AND dishes.stall_id = '".$stall_id."' AND
				black_list.customer_id != orders.user_id
			ORDER BY orders.order_time
			";
			
		$data = $this->db->query($sql)->result();
		
		return $data;
	}

	function getBlacklistedUsers($stall_id){
		$sql = "
			SELECT customers.NUSID, customers.name, customers.phone_number, customers.email
			FROM customers, black_list
			WHERE customers.NUSID = black_list.customer_id AND black_list.stall_id = ".$stall_id."
			";
		
		$data = $this->db->query($sql)->result();
		
		return $data;
	}
	
	function setOrderStatus($orderID, $status)
	{
		$this->db->query("UPDATE orders SET status='".$status."' WHERE id ='".$orderID."'");
	}
	
	function getStallSlots($stall_id)
	{
		$sql = "SELECT slots.quantity
					FROM slots
					WHERE slots.stall_id = $stall_id
					ORDER BY slots.start_at";
	
		$query = $this->db->query($sql);
		
		foreach($query->result() as $row){
			print_r($row->quantity);
		}
		
		return $query->result();
	
	}
	
	function updateSlot($stall_id, $slot_data)
	{	
		$start_time = 0;
		for($i = 0; $i < 48; $i++){
			$sql = "UPDATE slots
					SET quantity='".$slot_data[$i]."' WHERE start_at ='".$start_time."' AND stall_id = '$stall_id'";
			$this->db->query($sql);
			$start_time += 0.5;
		}
	}
}
