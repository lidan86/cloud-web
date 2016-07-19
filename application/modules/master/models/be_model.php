<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class be_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
                $this->_table = 'business_entity';
		$this->_database   = $this->db;
                
	}


}