<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->_database   = $this->db;
	}

    
    function get_info_user($id='') {
        $sql = $this->db->query("SELECT * FROM ion_users WHERE id = '".$id."' ORDER BY id DESC limit 1");      
        return $sql->result();
    }

}
