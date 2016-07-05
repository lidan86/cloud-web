<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class m_request extends MY_Model {

    public function __construct()
    {
            parent::__construct();
            $this->_database   = $this->db;
    }
    public function get_capacity($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('capacity');
        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }
    function get_all_capacity_request($id='') {
        $this->db->where('user_add', $id);
        $this->db->where('action !=', 0);
        $this->db->where('action !=', 4);
        $this->db->where('action !=', 99);
        $this->db->where('action !=', 11);
        $result = $this->db->get('capacity')
                ->result_array();
            return $result;
    }
    function get_all_req() {
//        $this->db->where('id', $id);
//        $this->db->where('action !=', 0);
//        $this->db->where('action !=', 4);
//        $this->db->where('action !=', 99);
//        $this->db->where('action !=', 11);
        $result = $this->db->get('capacity')
                ->result_array();
            return $result;
    }
    function get_comment($id='',$code='') {
        $sql = $this->db->query("SELECT * FROM m_msg WHERE code = '".$code."' AND dest_id = ".$id." ORDER BY id DESC limit 1");      
        return $sql->result();
    }
    public function delete_capacity($id) {
        $data= array( 'action' => 99);
        $this->db->where('id',$id);
        $this->db->update('capacity',$data);
    }
}
