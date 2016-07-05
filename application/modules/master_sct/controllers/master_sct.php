<?php
class Master_sct extends MX_Controller {

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
        $queryx = $this->db->query("select * from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $ip_post = $row->ip_post;
            $port_post = $row->port_post;
            $db_post = $row->db_post;
            $user_post = $row->user_post;
            $pass_post = $row->pass_post;

            $api = $row->api;
        }


        $conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
        $conn = pg_connect($conn_string)
        or die("Connection failed!");
        $ne_id = $_POST['jenis_ne'];
        $result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne  where id = ".$ne_id." limit 1 ")
        or die ("Query error!");
        while ($row = pg_fetch_array($result)) {
            $ne_name = $row['ne_name'];
        }
        $minimum_fill_capacity = $_POST['minimum_fill_capacity'];
        $alert_threshold_capacity = $_POST['alert_threshold_capacity'];
        $max_capacity_threshold = $_POST['max_capacity_threshold'];


        $url = $api.'CapmanApi/Master_sct';

        $fields = array(
            'status' => urlencode("insert"),
            'jenis_ne_id'=> urlencode($ne_id),
            'jenis_ne_name' => urlencode($ne_name),
            'minimum_fill_capacity' => urlencode($minimum_fill_capacity),
            'alert_threshold_capacity' => urlencode($alert_threshold_capacity),
            'max_capacity_threshold' => urlencode($max_capacity_threshold)

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

            redirect('master_sct');

    }
    
    public function editData($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_sct?status=getid&id='.$id,false,$context);
        $row = json_decode($json,true);
        $data = array(
            'id' => $row[0]['id'],
            'jenis_ne_id' => $row[0]['jenis_ne_id'],
            'minimum_fill_capacity' => $row[0]['minimum_fill_capacity'],
            'alert_threshold_capacity' => $row[0]['alert_threshold_capacity'],
            'max_capacity_threshold' => $row[0]['max_capacity_threshold']
        );
        $this->template->build('edit_data',$data);
    }
    
    public function do_update() {
        $queryx = $this->db->query("select * from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $ip_post = $row->ip_post;
            $port_post = $row->port_post;
            $db_post = $row->db_post;
            $user_post = $row->user_post;
            $pass_post = $row->pass_post;

            $api = $row->api;
        }


        $conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
        $conn = pg_connect($conn_string)
        or die("Connection failed!");
        $ne_id = $_POST['jenis_ne'];
        $result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne  where id = ".$ne_id." limit 1 ")
        or die ("Query error!");
        while ($row = pg_fetch_array($result)) {
            $ne_name = $row['ne_name'];
        }
        $minimum_fill_capacity = $_POST['minimum_fill_capacity'];
        $alert_threshold_capacity = $_POST['alert_threshold_capacity'];
        $max_capacity_threshold = $_POST['max_capacity_threshold'];
        $id = $_POST['id'];

        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_sct?status=update&jenis_ne_id='.urlencode($ne_id).'&jenis_ne_name='.urlencode($ne_name).'&minimum_fill_capacity='.urlencode($minimum_fill_capacity).'&alert_threshold_capacity='.urlencode($alert_threshold_capacity).'&max_capacity_threshold='.urlencode($max_capacity_threshold).'&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('master_sct');
    }
    
    public function do_delete($id) {
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/Master_sct?status=delete&id='.$id,false,$context);
        $result = json_decode($json,true);

        redirect('master_sct');
    }
}