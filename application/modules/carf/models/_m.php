<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _m extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->_database   = $this->db;
	}

	/*public function xxxxx ()	{

	}*/
	public function get_carf($id) {
		$this->_table = 'carf';
		$this->db->where('id', $id);
		$result = $this->get_all();
		return $result;
	}
}
