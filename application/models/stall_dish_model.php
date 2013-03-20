<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/dishmodel.php'); 

class Stall_dish_model extends DishModel 
{
	function __construct() 
	{
        // Call the Model constructor
        parent::__construct();
    }
		
	function addDish($dish_name, $dish_description, $dish_img, $dish_price, $days_checked) //returns database index of newly-added dish
	{
		$this->db->query("INSERT INTO dishes(stall_id, name, description, img, price) 
							VALUES('".$this->session->userdata('stall_id')."',
								   '".$dish_name."',
								   '".$dish_description."',
								   '".$dish_img."',
								   '".$dish_price."')");
								
								   
		$dishID = $this->db->insert_id();
		$daysChecked = $days_checked;
		for ($i = 0; $i < count($daysChecked); $i++) //for each day that is checked, insert quantity into menu table. Quantity is 0 if day is unchecked. 
		{
			$this->db->query("INSERT INTO menu(dish_id, day, quantity) 
								VALUES('".$dishID."','".$i."','".$daysChecked[$i]."')");
		}
								
		return $dishID;
	}
	
	function deleteDish($dish_id)
	{
		$this->db->query("DELETE FROM dishes WHERE dishes.id = '".$dish_id."'");
	}
	
	function updateDish($dish_id, $dish_name, $dish_description, $dish_img, $dish_price, $days_checked)
	{	
		$this->db->query("UPDATE dishes
						  SET name = '".$dish_name."', 
							  description = '".$dish_description."',
							  img = '".$dish_img."',
							  price = '".$dish_price."'
						  WHERE id = '".$dish_id."'");

		$dishID = $dish_id;
		$daysChecked = $days_checked;
		for ($i = 0; $i < count($daysChecked); $i++) //for each day that is checked, insert quantity into menu table. Quantity is 0 if day is unchecked. 
		{
			$this->db->query("UPDATE menu 
								SET menu.quantity = '".$daysChecked[$i]."' 
								WHERE dish_id = '".$dishID."' AND day = '".$i."'");
		}
	}
	
	function isSoldOnDay($dish_id, $day) 
	{
		$query = $this->db->query("SELECT FROM menu 
									WHERE menu.dish_id = '".$dish_id."' AND menu.day = '".$day."'");
		$dishInMenu = $query->result();
		
		if ($dishInMenu['day'] == 0)
				return false;
		else
			return true;
	}
}
?>