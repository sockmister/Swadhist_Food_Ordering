<?
ini_set('date.timezone', 'Asia/Singapore');
class Stall {
	var $id, $name, $contact, $description, $img, $no_dishes, $owner_id;
	private static $db_attributes = array('name', 'contact', 'description', 'img');
	
	public function __construct($name, $contact, $description, $img) {
		$this->name = $name;
		$this->contact = $contact;
		$this->description = $description;
		$this->img = $img;
	}
	
	public function getDBAttributes() {
		$data = array();
		foreach(Stall::$db_attributes as $name) {
			$data[$name] = $this->$name;
		}
		return $data;
	}
}


class StallModel extends CI_Model {
	protected static $db;
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    	self::$db = &get_instance()->db;
    }
    
	public static function findAllStalls() {
		$sql = "
			SELECT stalls.id AS id, stalls.name AS name, count(dishes.id) AS no_dishes
			FROM stalls
			LEFT JOIN dishes
			ON stalls.id = dishes.stall_id
			GROUP BY stalls.id, stalls.name
		";
		return self::$db->query($sql)->result('Stall');
	}
	
	public static function findStallById($id) {
		return self::$db->get_where('stalls', array('id' => $id), 1)->first_row('Stall');
	}
	
}

?>