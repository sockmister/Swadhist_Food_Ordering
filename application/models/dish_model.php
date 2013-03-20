<?
ini_set('date.timezone', 'Asia/Singapore');
class Dish {
	private static $day_string = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	var $id;
	var $stall_id;
	var $name;
	var $description;
	var $img;
	var $price;
	// 
	var $stall_name;
	var $days = array();
	var $quantity;
	var $no_order;
	
	public function add_day($day) {
		$this->days[$day] = $day;
	}
	
	public function get_day() {
		if (count($this->days) == 0) {
			return "Not Available";
		} else {
			
			if (count($this->days) == 7) {
				return "Available on all days";
			}
			
			$string = "Available on";
			foreach($this->days as $day) {
				$string.=" ".Dish::$day_string[$day];
			}
			return $string;
		}
	}
	
	public function is_available() {
		$today = getdate();
		if (isset($this->days[$today['wday']])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function set_quantity($quantity) {
		$this->quantity = $quantity;
	}
	
	public function set_no_order($no) {
		$this->no_order = $no;
	}
	
	public function is_sold_out() {
		if ($this->quantity > $this->no_order) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function no_available() {
		$no =  $this->quantity - $this->no_order;
		if ($no < 0) {
			return 0;
		} else {
			return $no;
		}
	}
}

class Dish_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
	function getDishesByStallId($stall_id) {
		$dishes_query = $this->db->get_where('dishes', array('stall_id' => $stall_id));
		$dishes_array = array();
		foreach ($dishes_query->result('Dish') as $dish) {
			$dishes_array[$dish->id] = $dish;
		}
		
		$menu_sql = "SELECT * FROM menu WHERE dish_id IN (SELECT id FROM dishes WHERE stall_id = '".$stall_id."') ORDER BY menu.day";
		$menu_query = $this->db->query($menu_sql);
		foreach ($menu_query->result() as $row)
		{
		   $dishes_array[$row->dish_id]->add_day($row->day);
		}
		
		return $dishes_array;
	}
	
	function getDishById($dish_id) {
		$dish_sql = "SELECT dishes.id AS id, dishes.name AS name, dishes.description AS description, dishes.img AS img, price, stalls.name AS stall_name, stall_id FROM dishes, stalls WHERE dishes.id = ".$dish_id." AND dishes.stall_id = stalls.id LIMIT 1";
		$dish_query =  $this->db->query($dish_sql);
		$dish = $dish_query->first_row('Dish');
		
		$menu_sql = "SELECT * FROM menu WHERE dish_id = ".$dish_id;
		$menu_query = $this->db->query($menu_sql);
		foreach ($menu_query->result() as $row) {
		   $dish->add_day($row->day);
		}
		
		$today = getdate();
		$quantity_query = $this->db->get_where('menu', array('dish_id' => $dish_id, 'day' => $today['wday']), 1);
		$dish->set_quantity($quantity_query->first_row()->quantity);
		
		$count_order_sql = "SELECT IFNULL(sum(quantity), 0) AS no FROM orders WHERE order_date = '".$today['year'].'-'.$today['mon'].'-'.$today['mday']."'  AND dish_id = '".$dish_id."' ";
		$no_order_query = $this->db->query($count_order_sql);
		$dish->set_no_order($no_order_query->first_row()->no);
		
		return $dish;
	}
	
}

?>