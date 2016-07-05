<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networkservice extends MX_Controller {

    public function __construct() {
        parent::__construct();
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
    }
	
	public function index(){
		$this->template->build('v_index');
	}
	function data(){
//        $data = $this->modulereza->getTest();
//
		$this->template->build('v_data');
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


		}

		$user = $this->session->userdata('username');
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");

		$weight = $_POST['weight'];
		$dated = date("Y-m-d");
		$ne_name = $_POST['ne_name'];
		$service_type = $_POST['service_type'];
		$insert = pg_query($conn, "UPDATE master_data.new_master_service_path
   SET  weight_impact=".$weight."
 WHERE master_service_type_id=".$service_type." AND ne_name='".$ne_name."'")
		or die ("Query error!");
		$select = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path,weight_impact FROM master_data.new_master_service_path where master_service_type_id =".$service_type)
		or die ("Query error!");
		while ($row = pg_fetch_array($select)) {
			$d = $row['master_service_type_id'];
			$e = $row['master_jenis_ne_id'];
			$f = $row['ne_name'];
			$g = $row['remark'];
			$h = $row['column_number'];
			$j = $row['type_path'];
			$l = $row['weight_impact'];
			$insertx = pg_query($conn, "INSERT INTO public.history_service_path(
            master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, history_date,type_path,username, weight_impact)
    VALUES ($d, $e, '".$f."', 'ADD Weight Impact NE ".$ne_name."', $h,'".$dated."','".$j."','".$user."',".$l.")")
			or die ("Query error!");
		}
		redirect("networkservice");

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */