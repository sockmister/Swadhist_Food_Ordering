<?
class Stall_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_all_stalls() {
		$sql = "
			SELECT stalls.id AS id, stalls.name AS name, count(dishes.id) AS no_dishes
			FROM stalls
			LEFT JOIN dishes
			ON stalls.id = dishes.stall_id
			GROUP BY stalls.id, stalls.name
		";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_stall_info($id) {
		$query = $this->db->get_where('stalls', array('id' => $id), 1);
		return $query->first_row();
	}
}

?>