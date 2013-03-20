<?
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/dishmodel.php'); 

class StallDishModel extends DishModel  {
	function __construct()  {
        // Call the Model constructor
        parent::__construct();
		self::$db = &get_instance()->db;
    }
		
	public static function deleteDish($dish_id) {
		self::$db->delete('dishes', array('id' => $dish_id)); 
	}
	
	public static function updateDish($dish_id, $dish_name, $dish_description, $dish_img, $dish_price, $days_checked) {	
		$sql = "
			UPDATE dishes
			SET name = '".$dish_name."', 
				   description = '".$dish_description."',
				   img = '".$dish_img."',
				   price = '".$dish_price."'
			WHERE id = '".$dish_id."'";
		self::$db->query($sql);

		$dishID = $dish_id;
		$daysChecked = $days_checked;
		//for each day that is checked, insert quantity into menu table. Quantity is 0 if day is unchecked. 
		for ($i = 0; $i < count($daysChecked); $i++) {
			$sql = "
				UPDATE menu 
				SET menu.quantity = '".$daysChecked[$i]."' 
				WHERE dish_id = '".$dishID."' AND day = '".$i."'";
			self::$db->query($sql);
		}
	}
	
	
	//returns database index of newly-added dish
	public static function addDish($stall_id, $dish_name, $dish_description, $dish_img, $dish_price, $days_checked)  {
		$sql = "
			INSERT INTO dishes(stall_id, name, description, img, price) 
			VALUES('".$stall_id."',
								   '".$dish_name."',
								   '".$dish_description."',
								   '".$dish_img."',
								   '".$dish_price."')";
		self::$db->query($sql);							   
		$dishID = self::$db->insert_id();
		$daysChecked = $days_checked;
		//for each day that is checked, insert quantity into menu table. Quantity is 0 if day is unchecked. 
		for ($i = 0; $i < count($daysChecked); $i++)  {
			$sql = "
				INSERT INTO menu(dish_id, day, quantity) 
				VALUES('".$dishID."','".$i."','".$daysChecked[$i]."')
			";
			self::$db->query($sql);
		}						
		return $dishID;
	}
}
?>