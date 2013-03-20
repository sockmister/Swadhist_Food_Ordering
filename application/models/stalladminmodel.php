<?
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/stallmodel.php');

class StallAdminModel extends StallModel {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
		self::$db = &get_instance()->db;
    }
 	
	public static function addStall($stall) {
		if (self::$db->insert('stalls', $stall->getDBAttributes())) {
			$stall->id =  self::$db->insert_id();
			// insert the owning relationship
			self::$db->insert('owning', array("owner_id" => $stall->owner_id, "stall_id" => $stall->id)); 
			// insert the default slots
			$start_at = 0.0;
			$end_at = 0.5;
			for($i = 0; $i < 48; $i++){
				$query = "
					INSERT INTO slots(stall_id, start_at, end_at, quantity)
					VAlUES(?, ?, ?, 0)";
				self::$db->query($query, array($stall->id, $start_at, $end_at));
				$start_at += 0.5;
				$end_at += 0.5;
				if($end_at == 24.0)
					$end_at = 0.0;
			}
			return $stall->id ;
		} else {
			return 0;
		}
	}
	
	public static function updateStallInfo($stall) {
		if (empty($stall->id)) {
			return 0;
		} else {
			self::$db->update('stalls', $stall->getDBAttributes(), array("id" => $stall->id));
			return 1;
		}
	}
	
	public static function getStallIdByOwnerId($owner_id) {
		$query = self::$db->get_where('owning', array('owner_id' => $owner_id), 1);
		return $query->first_row()->stall_id;
	}
	
	public static function getStallSlots($stall_id) {
		$sql = "
			SELECT slots.quantity
			FROM slots
			WHERE slots.stall_id = $stall_id
			ORDER BY slots.start_at";
		return self::$db->query($sql)->result();
	}
	
	public static function updateSlot($stall_id, $slot_data) {	
		$start_time = 0;
		for($i = 0; $i < 48; $i++){
			$sql = "
				UPDATE slots
				SET quantity='".$slot_data[$i]."' 
				WHERE start_at ='".$start_time."' AND stall_id = '$stall_id'";
			self::$db->query($sql);
			$start_time += 0.5;
		}
	}
}

?>