<?
ini_set('date.timezone', 'Asia/Singapore');
class Dish {
	private static $day_string = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	var $id, $stall_id, $stall_name, $description, $img, $price, $quantity, $no_order, $avgRate = 0, $days = array();
	
	public function addDay($day) {
		$this->days[$day] = $day;
	}
	
	public function displayDay() {
		if (count($this->days) == 0) {
			return "Not Available";
		} else if (count($this->days) == 7) {
			return "Available on all days";
		} else {
			$string = "Available on";
			foreach($this->days as $day) {
				$string.=" ".Dish::$day_string[$day];
			}
			return $string;
		}
	}
	
	public function isAvailable() {
		$today = getdate();
		if (isset($this->days[$today['wday']])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function isSoldOut() {
		if ($this->quantity > $this->no_order) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function noAvailable() {
		$no =  $this->quantity - $this->no_order;
		if ($no < 0) {
			return 0;
		} else {
			return $no;
		}
	}
}


class DishModel extends CI_Model {
	protected static $db;
	function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
	
	static function findDishesByStallId($stall_id) {
		$dishes = array();
		foreach (self::$db->get_where('dishes', array('stall_id' => $stall_id))->result('Dish') as $dish) {
			$dishes[$dish->id] = $dish;
		}
		$avgRating_sql = "
			SELECT dish_id, AVG(rate) AS avgRate
			FROM rates
			WHERE dish_id IN (SELECT id FROM dishes WHERE stall_id = ?)
			GROUP BY dish_id
			";
		foreach (self::$db->query($avgRating_sql, array($stall_id))->result() as $row) {
		   $dishes[$row->dish_id]->avgRate = $row->avgRate;
		}
		$menu_sql = "
			SELECT * 
			FROM menu 
			WHERE dish_id 
			IN (SELECT id FROM dishes WHERE stall_id = ?) ORDER BY menu.day";
		foreach (self::$db->query($menu_sql, array($stall_id))->result() as $row) {
		   $dishes[$row->dish_id]->addDay($row->day);
		}
		return $dishes;
	}
	
	static function findDishById($dish_id) {
		$dish_sql = "
			SELECT dishes.id AS id, dishes.name AS name, dishes.description AS description,
						 dishes.img AS img, price, stalls.name AS stall_name, stall_id 
			FROM dishes, stalls 
			WHERE dishes.id = ? AND dishes.stall_id = stalls.id 
			LIMIT 1";
		$dish = self::$db->query($dish_sql, array($dish_id))->first_row('Dish');
		$menu_sql = "
			SELECT * 
			FROM menu 
			WHERE dish_id = ?";
		foreach (self::$db->query($menu_sql, array($dish_id))->result() as $row) {
		   $dish->addDay($row->day);
		}
		
		$today = getdate();
		$dish->quantity = self::$db->get_where('menu', array('dish_id' => $dish_id, 'day' => $today['wday']), 1)
									->first_row()
									->quantity;
		$count_order_sql = "
			SELECT IFNULL(sum(quantity), 0) AS no FROM orders 
			WHERE order_date = ?  AND dish_id = ? ";
		$dish->no_order = self::$db->query($count_order_sql, array($today['year'].'-'.$today['mon'].'-'.$today['mday'], $dish_id))
									   ->first_row()
									   ->no;
		return $dish;
	}
	
	static function findDishesByKeywords($keywords) {
		$sql = "
			SELECT dishes.id AS id, dishes.name AS name, stalls.name AS stall_name
			FROM dishes
			LEFT JOIN stalls ON stalls.id = dishes.stall_id
			WHERE dishes.name LIKE ?
			";
		return self::$db->query($sql, "%".$keywords."%")->result('Dish');
	}
	
	static function getAllDishMenu($stall_id) {
		$sql = "
			SELECT menu.dish_id AS dish_id, menu.day AS day, menu.quantity AS quantity
			FROM menu
			WHERE dish_id IN (SELECT id FROM dishes WHERE dishes.stall_id = ?)
		";
		$query = self::$db->query($sql, $stall_id );
		$data = array();
		foreach($query->result() AS $row) {
			$data[$row->dish_id][$row->day] = $row->quantity;
		}
		return $data;
	}
}
?>