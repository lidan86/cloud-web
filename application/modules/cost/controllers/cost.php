<?php
class Cost extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
                $this->load->model('modulereza');
        }
    function index(){

            $this->template->build('v_cost');
    }

    public function add_data(){
        $this->template->build('add_data');


    }

    public function do_insert(){
        $service_group = $_POST['service_group'];
        $years = $_POST['years'];
        $max_costs = $_POST['max_costs'];
        $min_costs = $_POST['min_costs'];
        $costs = $_POST['costs'];
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $url = $api.'CapmanApi/Master_Cpc';

        $fields = array(
            'status' => urlencode("insert"),
            'master_service_group_id' => urlencode($service_group),
            'years' => urlencode($years),
            'max_costs' => urlencode($max_costs),
            'min_costs' => urlencode($min_costs),
            'costs'     => urlencode($costs)

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

        redirect('cost');

    }

    public function editData($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_Cpc?status=getid&id='.$id,false,$context);
        $row = json_decode($json,true);
        $data = array(
            'id' => $row[0]['id'],
            'master_service_group_id' => $row[0]['master_service_group_id'],
            'years' => $row[0]['years'],
            'max_costs' => $row[0]['max_costs'],
            'min_costs' => $row[0]['min_costs'],
            'costs' => $row[0]['costs']
        );
        $this->template->build('edit_data',$data);
    }

    public function do_update() {
        $service_group = $_POST['service_group'];
        $years = $_POST['years'];
        $max_costs = $_POST['max_costs'];
        $min_costs = $_POST['min_costs'];
        $costs = $_POST['costs'];
        $id = $_POST['id'];
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_Cpc?status=update&master_service_group_id='.urlencode($service_group).'&years='.urlencode($years).'&max_costs='.urlencode($max_costs).'&min_costs='.urlencode($min_costs).'&costs='.urlencode($costs).'&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('cost');
    }

    public function do_delete($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_Cpc?status=delete&id='.$id,false,$context);
        $result = json_decode($json,true);

       redirect('cost');
    }
}