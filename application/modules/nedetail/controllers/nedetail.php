<?php
class Nedetail extends MX_Controller {

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
        $ne_id = $_POST['ne_id'];
        $years = $_POST['years'];
        $low_range = $_POST['low_range'];
        $middle_range = $_POST['middle_range'];
        $high_range = $_POST['high_range'];
        $initial_value = $_POST['initial_value'];
        $initial_master_ne_unit_id = $_POST['initial_master_ne_unit_id'];
        $cost_value = $_POST['cost_value'];
        $cost_master_ne_unit_id = $_POST['cost_master_ne_unit_id'];
        $remark = $_POST['remark'];
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $url = $api.'CapmanApi/MasterNedetail';
        //status=insert&master_jenis_ne_id=10&years=2014&low_range=9&middle_range=899
        //&high_range=9887&initial_value=887&initial_master_ne_unit_id=9&cost_value=7654&
        //cost_master_ne_unit_id=54&remark=testsetsetja
        $fields = array(
            'status' => urlencode("insert"),
            'master_jenis_ne_id' => urlencode($ne_id),
            'years' => urlencode($years),
            'low_range' => urlencode($low_range),
            'middle_range' => urlencode($middle_range),
            'high_range' => urlencode($high_range),
            'initial_value' => urlencode($initial_value),
            'initial_master_ne_unit_id' => urlencode($initial_master_ne_unit_id),
            'cost_value' => urlencode($cost_value),
            'cost_master_ne_unit_id' => urlencode($cost_master_ne_unit_id),
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

            redirect('nedetail');

    }
    
    public function editData($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNedetail?status=getid&id='.$id,false,$context);
        $row = json_decode($json,true);
        //  'master_jenis_ne_id' => urlencode($ne_id),
//        'years' => urlencode($years),
//            'low_range' => urlencode($low_range),
//            'middle_range' => urlencode($middle_range),
//            'high_range' => urlencode($high_range),
//            'initial_value' => urlencode($initial_value),
//            'initial_master_ne_unit_id' => urlencode($initial_master_ne_unit_id),
//            'cost_value' => urlencode($cost_value),
//            'cost_master_ne_unit_id' => urlencode($cost_master_ne_unit_id),
//            'remark' => urlencode($remark)
        $data = array(
            'id' => $row[0]['id'],
            'master_jenis_ne_id' => $row[0]['master_jenis_ne_id'],
            'years' => $row[0]['years'],
            'low_range' => $row[0]['low_range'],
            'middle_range' => $row[0]['middle_range'],
            'high_range' => $row[0]['high_range'],
            'initial_value' => $row[0]['initial_value'],
            'initial_master_ne_unit_id' => $row[0]['initial_master_ne_unit_id'],
            'cost_value' => $row[0]['cost_value'],
            'cost_master_ne_unit_id' => $row[0]['cost_master_ne_unit_id'],
            'remark' => $row[0]['remark']
        );

        $this->template->build('edit_data',$data);
    }
    
    public function do_update() {
        $ne_id = $_POST['ne_id'];
        $years = $_POST['years'];
        $low_range = $_POST['low_range'];
        $middle_range = $_POST['middle_range'];
        $high_range = $_POST['high_range'];
        $initial_value = $_POST['initial_value'];
        $initial_master_ne_unit_id = $_POST['initial_master_ne_unit_id'];
        $cost_value = $_POST['cost_value'];
        $cost_master_ne_unit_id = $_POST['cost_master_ne_unit_id'];
        $remark = $_POST['remark'];
        $id = $_POST['id'];
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNedetail?status=update&master_jenis_ne_id='.urlencode($ne_id).'&id='.urlencode($id).'&years='.urlencode($years).'&low_range='.urlencode($low_range).'&middle_range='.urlencode($middle_range).'&high_range='.urlencode($high_range).'&initial_value='.urlencode($initial_value).'&initial_master_ne_unit_id='.urlencode($initial_master_ne_unit_id).'&cost_value='.urlencode($cost_value).'&cost_master_ne_unit_id='.urlencode($cost_master_ne_unit_id).'&remark='.urlencode($remark),false,$context);
        $result = json_decode($json,true);

        redirect('nedetail');
    }
    
    public function do_delete($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/MasterNedetail?status=delete&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('nedetail');
    }
}