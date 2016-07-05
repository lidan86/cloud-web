<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_options extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->_database   = $this->db;
	}

    function get_all_msg($id='') {
        $this->db->where('dest_id', $id);
//        $this->db->where('action !=', 0);
//        $this->db->where('action !=', 4);
//        $this->db->where('action !=', 99);
//        $this->db->where('action !=', 11);
        $result = $this->db->get('m_msg')
                ->result_array();
            return $result;
    }

}
