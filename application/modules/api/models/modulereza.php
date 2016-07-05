<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Modulereza extends CI_Model {
    
    
    
    public function getTest($where=""){
        $data = $this->db->query('select * from api'.$where);
        return $data->result_array();
    }
    
      public function inserData($table_name,$data){
            $res = $this->db->insert($table_name,$data);
            return $res;
        }
        
        public function updateData($table_name,$data,$where){
            $res = $this->db->update($table_name,$data,$where);
            return $res;            
        }
        public function deleteData($table_name,$where){
             $res = $this->db->delete($table_name,$where);
            return $res;
        }
        
        public function tambah(){
        $nama = $this->input->post('nama');
        $data = array(
            'api' => $nama
        );
        $this->db->insert('api',$data);
    }
    
     
}
