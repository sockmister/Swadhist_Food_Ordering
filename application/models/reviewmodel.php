<?
ini_set('date.timezone', 'Asia/Singapore');
class Comment {
	var $id, $user_id, $dish_id, $content, $post_at, $user_name;
	private static $db_attributes = array('user_id', 'dish_id', 'content', 'post_at');
	
	public function __construct($user_id, $dish_id, $content) {
		$this->user_id = $user_id;
		$this->dish_id = $dish_id;
		$this->content = $content;
		$this->post_at = date('Y-m-d H:i:s');
	}
	
	public function getDBAttributes() {
		$data = array();
		foreach(Comment::$db_attributes as $name) {
			$data[$name] = $this->$name;
		}
		return $data;
	}
}

class Rate {
	var $user_id, $dish_id, $rate;
	private static $db_attributes = array('user_id', 'dish_id', 'rate');
	public function __construct($user_id, $dish_id, $rate) {
		$this->user_id = $user_id;
		$this->dish_id = $dish_id;
		$this->rate = $rate;
	}
	public function getDBAttributes() {
		$data = array();
		foreach(Rate::$db_attributes as $name) {
			$data[$name] = $this->$name;
		}
		return $data;
	}
}

class ReviewModel extends CI_Model {
	private static $db;
    function __construct() {
        // Call the Model constructor
    	parent::__construct();
    	self::$db = &get_instance()->db;
    }
	
	static function getCommentsByDishId($dish_id) {
		$query = "
			SELECT comments.id AS id, comments.user_id AS user_id, dish_id, content, post_at, customers.name AS user_name 
			FROM comments, customers 
			WHERE comments.user_id = customers.NUSID and comments.dish_id = ?";
		return self::$db->query($query, array($dish_id))->result('Comment');
	}
	
	static function getAverageRateByDishId($dish_id) {
		$query = "
			SELECT AVG(rate) AS avgRate
			FROM rates
			WHERE dish_id = ?";
		return self::$db->query($query, array($dish_id))->first_row()->avgRate;
	}
	
	static function insertComment($comment) {
		if (self::$db->insert('comments', $comment->getDBAttributes())) {
			return self::$db->insert_id();
		} else {
			return 0;
		}
	}
	
	static function insertRate($rate) {
		// Check whether user has rated or not.
		$condition = array('user_id' => $rate->user_id, 'dish_id' => $rate->dish_id);
		$query = self::$db->get_where('rates', $condition, 1);
		if ($query->num_rows() > 0) {
			if (self::$db->update('rates', $rate->getDBAttributes(), $condition)) {
				return 1;			
			} else {
				return 0;
			}
		} else {
			if (self::$db->insert('rates', $rate->getDBAttributes())) {
				return 1;
			} else {
				return 0;
			}
		}
	}
}

?>