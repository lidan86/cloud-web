<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Be_m extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		$this->_table       = 'business_entity';
                $this->_database    = $this->db;
	}

    public function get_be_by_id($id)
    {
		$query = $this->get_by($id);
		return $query->result_array(); 
    } 
	// Get All Roles of a User
    public function get_be($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('business_entity');

		if($search_string){
			$this->db->like('business_name', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    function count_be($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('business_entity');
		if($search_string){
			$this->db->like('business_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    function store_be($data)
    {
		$insert = $this->db->insert('business_entity', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_be($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('business_entity', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete manufacturer
    * @param int $id - manufacture id
    * @return boolean
    */
	function delete_be($id){
		$this->db->where('id', $id);
		$this->db->delete('business_entity'); 
	}    

}

