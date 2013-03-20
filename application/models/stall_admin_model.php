<?
if (!defined('BASEPATH'))exit('No direct script access allowed');
include_once(APPPATH . 'models/stall_model.php');

class Stall_admin_model extends Stall_model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
	function getStallIdByOwnerId($owner_id) {
		$query = $this->db->get_where('owning', array('owner_id' => $owner_id), 1);
		if ($query->num_rows() > 0) 
			return $query->first_row()->stall_id;
		else
			return 0;
	}
}

?>