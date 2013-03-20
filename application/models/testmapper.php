<?

class TestMapper extends CI_Model {
	private static $db;
    function __construct() {
        // Call the Model constructor
    	parent::__construct();
    	self::$db = &get_instance()->db;
    }
	
  static function abc() {
   	return self::$db->get('customers')->result();
  }
	
}

?>