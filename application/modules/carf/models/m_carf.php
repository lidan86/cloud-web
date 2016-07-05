<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class m_carf extends MY_Model {

    public function __construct()
    {
            parent::__construct();
            $this->_database   = $this->db;
    }
    public function get_carf($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('carf');
        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }
    
    function sendMail($to='',$sub='',$msg='')
    {
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'bajau.smtp@gmail.com',
            'smtp_pass' => 'b4j4usmtp',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);

        $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'bajau.smtp@gmail.com', // change it to yours
      'smtp_pass' => 'b4j4usmtp', // change it to yours
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );

            $message = '';
            $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('bajau.smtp@gmail.com'); // change it to yours
          $this->email->to('mailreko@gmail.com');// change it to yours
          $this->email->subject('Resume from JobsBuddy for your Job posting');
          $this->email->message($message);
          if($this->email->send())
         {
          echo 'Email sent.';
         }
         else
        {
         show_error($this->email->print_debugger());
        }

    }
    function get_all_carf_request($id='') {
        $this->db->where('user_add', $id);
        $this->db->where('approval !=', 0);
        $this->db->where('approval !=', 4);
        $this->db->where('approval !=', 99);
        $this->db->where('approval !=', 11);
        $this->db->order_by('updated_at desc');
        $result = $this->db->get('carf')
                ->result_array();
            return $result;
    }
    function get_all_carf() {
//        $this->db->where('user_add', $id);
        $this->db->where('approval !=', 0);
//        $this->db->where('approval !=', 4);
        $this->db->where('approval !=', 99);
//        $this->db->where('approval !=', 11);
        $this->db->order_by('updated_at desc');
        $result = $this->db->get('carf')
                ->result_array();
            return $result;
    }
    function get_all_cvp() {
//        $this->db->where('user_add', $id);
        $this->db->where('approval !=', 0)->where('approval !=', 1)->where('approval !=', 2)->where('approval !=', 3)
                ->where('approval !=', 4)->where('approval !=', 21)->where('approval !=', 31)->where('approval !=', 11);
        $this->db->where('approval !=', 99);
        $result = $this->db->get('carf')
                ->result_array();
            return $result;
    }
    function get_all_req() {
//        $this->db->where('id', $id);
//        $this->db->where('action !=', 0);
//        $this->db->where('action !=', 4);
//        $this->db->where('action !=', 99);
//        $this->db->where('action !=', 11);
        $result = $this->db->get('carf')
                ->result_array();
            return $result;
    }
    function get_comment($id='',$code='') {
        $sql = $this->db->query("SELECT * FROM m_msg WHERE code = '".$code."' AND dest_id = ".$id." ORDER BY id DESC limit 1");      
        return $sql->result();
    }
    function get_info_user($id='') {
        $sql = $this->db->query("SELECT * FROM ion_users WHERE id = '".$id."' ORDER BY id DESC limit 1");      
        return $sql->result();
    }
    public function delete_carf($id) {
        $data= array( 'approval' => 99);
        $this->db->where('id',$id);
        $this->db->update('carf',$data);
    }
    public function request_num($id,$tgl) {
        $data= array( 'request_num' => $tgl.$id);
        $this->db->where('id',$id);
        $this->db->update('carf',$data);
    }
}
