<?php
class Nearea extends MX_Controller {

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
        $region_code = $_POST['region_code'];
        $region_name = $_POST['region_name'];
        $poi_code = $_POST['poi_code'];
        $poi_name = $_POST['poi_name'];
        $poc_code = $_POST['poc_code'];
        $poc_name = $_POST['poc_name'];
        $site_code = $_POST['site_code'];
        $site_name = $_POST['site_name'];
        $ne_type = $_POST['ne_type'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $kecamatan = $_POST['kecamatan'];
        $kabupaten = $_POST['kabupaten'];
        $provinsi = $_POST['provinsi'];
        $insert = pg_query($conn, "INSERT INTO master_data.master_ne_area(
             region_code, region_name, poc_code, poc_name, poi_code, poi_name,
            site_code, site_name, jenis_ne_id, ne_type, ne_name, longitude,
            latitude, kecamatan, kabupaten, provinsi)
    VALUES ( '".$region_code."', '".$region_name."', '".$poc_code."', '".$poc_name."', '".$poi_code."', '".$poi_name."',
            '".$site_code."', '".$site_name."', ".$ne_id.", '".$ne_type."', '".$ne_name."', '".$longitude."',
            '".$latitude."', '".$kecamatan."', '".$kabupaten."', '".$provinsi."') ")
        or die ("Query error!");


            redirect('nearea');

    }
    
    public function editData($id) {
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

        $data = array(
            'id' => $id

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
        $region_code = $_POST['region_code'];
        $region_name = $_POST['region_name'];
        $poi_code = $_POST['poi_code'];
        $poi_name = $_POST['poi_name'];
        $poc_code = $_POST['poc_code'];
        $poc_name = $_POST['poc_name'];
        $site_code = $_POST['site_code'];
        $site_name = $_POST['site_name'];
        $ne_type = $_POST['ne_type'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $kecamatan = $_POST['kecamatan'];
        $kabupaten = $_POST['kabupaten'];
        $provinsi = $_POST['provinsi'];
        $id = $_POST['id'];

        $update =pg_query($conn, "UPDATE master_data.master_ne_area
   SET region_code='".$region_code."', region_name='".$region_name."', poc_code='".$poc_code."', poc_name='".$poc_name."', poi_code='".$poi_code."',
       poi_name='".$poi_name."', site_code='".$site_code."', site_name='".$site_name."', jenis_ne_id=".$ne_id.", ne_type='".$ne_type."',
       ne_name='".$ne_name."', longitude='".$longitude."', latitude='".$latitude."', kecamatan='".$kecamatan."', kabupaten='".$kabupaten."',
       provinsi='".$provinsi."'
 WHERE id = ".$id)
        or die ("Query error!");
        redirect('nearea');
    }
    
    public function do_delete($id) {
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

        $result = pg_query($conn, "DELETE FROM master_data.master_ne_area
 WHERE id = ".$id)
        or die ("Query error!");
        redirect('nearea');
    }
}