<?php
class Neunit extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
                $this->load->model('modulereza');
        }
    function index(){
//        $data = $this->modulereza->getTest();
//
            $this->template->build('v_index');
    }
    public function add(){

    }
    
    public function add_data(){
        $this->template->build('add_data');
        
        
    }
    
    public function do_insert(){
        $unit_name = $_POST['unit_name'];
        $remark = $_POST['remark'];

        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $url = $api.'CapmanApi/MasterNeunits';

        $fields = array(
            'status' => urlencode("insert"),
            'unit_name' => urlencode($unit_name),
            'remark' => urlencode($remark)

        );


//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST ,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));

//execute post
        $result = curl_exec($ch);

//close connection
        curl_close($ch);

            redirect('neunit');

    }
    
    public function editData($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNeunits?status=getid&id='.$id,false,$context);
        $row = json_decode($json,true);
        $data = array(
            'id' => $row[0]['id'],
            'unit_name' => $row[0]['unit_name'],
            'remark' => $row[0]['remark']
        );
        $this->template->build('edit_data',$data);
    }
    
    public function do_update() {
        $unit_name = $_POST['unit_name'];
        $remark = $_POST['remark'];
        $id = $_POST['id'];
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNeunits?status=update&unit_name='.urlencode($unit_name).'&remark='.urlencode($remark).'&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('neunit');
    }
    
    public function do_delete($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNeunits?status=delete&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('neunit');
    }
}