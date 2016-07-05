<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class capacity extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->_database   = $this->db;
	}

    public function get_capacity($id=NULL) {
        $this->_table = 'capacity';
        $this->db->where('id', $id);
        $result = $this->get_all();
        return $result;
    }
}
