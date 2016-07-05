<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->_database   = $this->db;
	}
	public function getTest($where=""){
		$data = $this->db->query('select * from api'.$where);
		return $data->result_array();
	}
}
