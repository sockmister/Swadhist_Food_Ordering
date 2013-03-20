<?
class Customer_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
	/**
	 * return true if the customer is already exist.
	 */
	function is_exist($NUSID) {
		if(!empty($NUSID)) {
			$query = $this->db->get_where('customers', array('NUSID' => $NUSID), 1);
			if($query->num_rows()>0) {
				return $query->first_row();
			} else {
				return FALSE;
			}
		}
		return FALSE;
	}
	
	function add_customer($data) {
		if (!empty($data) && !empty($data["NUSID"])) {
			$this->db->insert('customers', $data); 
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function update($NUSID, $data) {
		if (!empty($NUSID)) {
			$this->db->where('NUSID', $NUSID);
			$this->db->update('customers', $data); 
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>