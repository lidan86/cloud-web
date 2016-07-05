<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modifyservicep extends AdminController {

    public function __construct() {
        parent::__construct();
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
    }
	
	public function index(){
		$this->template->build('v_index');
	}
	public function add(){
		$this->template->build('v_add');
	}
	public function edit(){
		$this->template->build('v_edit');
	}
	public function replace(){
		$this->template->build('v_replace');
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


		}

		$user = $this->session->userdata('username');
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");

		$ne_id = $_POST['jenis_ne'];
		$dated = date("Y-m-d");
		$result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne  where id = ".$ne_id." limit 1 ")
		or die ("Query error!");
		while ($row = pg_fetch_array($result)) {
			$ne_name = $row['ne_name'];
		}
		$type_path = $_POST['type'];
		$service_type = $_POST['service_type'];
		$column_number = $_POST['column_number'];
		$insert = pg_query($conn, "INSERT INTO master_data.new_master_service_path(
             master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, type_path)VALUES ($service_type, $ne_id, '".$ne_name."', '', $column_number,'".$type_path."')")
		or die ("Query error!");
		$select = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path FROM master_data.new_master_service_path where master_service_type_id =".$service_type)
		or die ("Query error!");
		while ($row = pg_fetch_array($select)) {
			$d = $row['master_service_type_id'];
			$e = $row['master_jenis_ne_id'];
			$f = $row['ne_name'];
			$g = $row['remark'];
			$h = $row['column_number'];
			$j = $row['type_path'];
			$insertx = pg_query($conn, "INSERT INTO public.history_service_path(
            master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, history_date,type_path,username)
    VALUES ($d, $e, '".$f."', 'ADD NE ".$ne_name."', $h,'".$dated."','".$j."','".$user."')")
			or die ("Query error!");
		}
		redirect("modifyservicep");

	}
	public function do_replace() {
		$queryx = $this->db->query("select * from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$ip_post = $row->ip_post;
			$port_post = $row->port_post;
			$db_post = $row->db_post;
			$user_post = $row->user_post;
			$pass_post = $row->pass_post;


		}
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");

		$user = $this->session->userdata('username');
		$ne_id = $_POST['jenis_ne'];
		$dated = date("Y-m-d h:i:s");
		$result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne  where id = ".$ne_id." limit 1 ")
		or die ("Query error!");
		while ($row = pg_fetch_array($result)) {
			$ne_name = $row['ne_name'];
		}
		$service_type = $_POST['service_type'];
		$type_path = $_POST['type'];
		$id = $_POST['id'];
		$insert = pg_query($conn, "UPDATE master_data.new_master_service_path
   SET master_service_type_id=".$service_type.", master_jenis_ne_id=".$ne_id.", ne_name='".$ne_name."', type_path='".$type_path."' WHERE id=".$id)
		or die ("Query error!");
		$select = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path FROM master_data.new_master_service_path where master_service_type_id =".$service_type)
		or die ("Query error!");
		while ($row = pg_fetch_array($select)) {
			$d = $row['master_service_type_id'];
			$e = $row['master_jenis_ne_id'];
			$f = $row['ne_name'];
			$g = $row['remark'];
			$h = $row['column_number'];
			$j = $row['type_path'];
			$insertx = pg_query($conn, "INSERT INTO public.history_service_path(
            master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, history_date,type_path,username)
    VALUES ($d, $e, '".$f."', 'EDIT NE ".$ne_name."', $h,'".$dated."','".$j."','".$user."')")
			or die ("Query error!");
		}
		redirect("modifyservicep");

	}

	public function do_insert() {
		$queryx = $this->db->query("select * from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$ip_post = $row->ip_post;
			$port_post = $row->port_post;
			$db_post = $row->db_post;
			$user_post = $row->user_post;
			$pass_post = $row->pass_post;


		}
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");

		$user = $this->session->userdata('username');
		$dated = date("Y-m-d h:i:s");
		$ne_id = $_POST['jenis_ne'];
		$result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne  where id = ".$ne_id." limit 1 ")
		or die ("Query error!");
		while ($row = pg_fetch_array($result)) {
			$ne_name = $row['ne_name'];
		}
		$service_type = $_POST['service_type'];
		$column_number = $_POST['column_number'];
		$last_column = $_POST['last_column'];
		$type_path = $_POST['type'];
		$y = $last_column+1;
		for($x =$last_column; $x >= $column_number;$x--){

			$updated = pg_query($conn, "UPDATE master_data.new_master_service_path
		   SET  column_number=".$y." WHERE column_number=".$x." AND master_service_type_id =".$service_type)
		or die ("Query error!");
			$y--;

		}

		$insert = pg_query($conn, "INSERT INTO master_data.new_master_service_path(
             master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number,type_path)VALUES ($service_type, $ne_id, '".$ne_name."', '', $column_number,'".$type_path."')")
		or die ("Query error!");
		$select = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path FROM master_data.new_master_service_path where master_service_type_id =".$service_type)
		or die ("Query error!");
		while ($row = pg_fetch_array($select)) {
			$d = $row['master_service_type_id'];
			$e = $row['master_jenis_ne_id'];
			$f = $row['ne_name'];
			$g = $row['remark'];
			$h = $row['column_number'];
			$j = $row['type_path'];
			$insertx = pg_query($conn, "INSERT INTO public.history_service_path(
            master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, history_date,type_path,username)
    VALUES ($d, $e, '".$f."', 'ADD NE ".$ne_name."', $h,'".$dated."','".$j."','".$user."')")
			or die ("Query error!");
		}
		redirect("modifyservicep");


	}
	public function delete(){
		$i = str_replace('%20', ' ', $this->uri->segment(3));
		$queryx = $this->db->query("select * from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$ip_post = $row->ip_post;
			$port_post = $row->port_post;
			$db_post = $row->db_post;
			$user_post = $row->user_post;
			$pass_post = $row->pass_post;


		}
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");
		$selectj = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where id =".$i)
		or die ("Query error!");
		while ($row = pg_fetch_array($selectj)) {

			$j = $row['type_path'];
			$service_type = $row['master_service_type_id'];
			$column_number = $row['column_number'];
			$ne_name = $row['ne_name'];
		}
		if($j == 2){
			$delete = pg_query($conn, "DELETE FROM master_data.new_master_service_path WHERE id =".$i)
			or die ("Query error!");
		}else{
			$deletex = pg_query($conn, "DELETE FROM master_data.new_master_service_path WHERE master_service_type_id =".$service_type." And column_number=".$column_number)
			or die ("Query error!");
			$selec = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path FROM master_data.new_master_service_path where master_service_type_id =".$service_type." order by column_number desc limit 1")
			or die ("Query error!");
			while ($row = pg_fetch_array($selec)) {
				$o = $row['column_number'];
			}
				$y = $column_number +1;
			for($x =$column_number; $x <= $o;$x++){

				$updated = pg_query($conn, "UPDATE master_data.new_master_service_path
		   SET  column_number=".$x." WHERE column_number=".$y." AND master_service_type_id =".$service_type)
				or die ("Query error!");
			$y++;

			}
		}
		$dated = date("Y-m-d h:i:s");

		$user = $this->session->userdata('username');
		$select = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name, remark,
       column_number,type_path FROM master_data.new_master_service_path where master_service_type_id =".$service_type)
		or die ("Query error!");
		while ($row = pg_fetch_array($select)) {
			$d = $row['master_service_type_id'];
			$e = $row['master_jenis_ne_id'];
			$f = $row['ne_name'];
			$g = $row['remark'];
			$h = $row['column_number'];
			$j = $row['type_path'];
			$insertx = pg_query($conn, "INSERT INTO public.history_service_path(
            master_service_type_id, master_jenis_ne_id, ne_name, remark,
            column_number, history_date,type_path,username)
    VALUES ($d, $e, '".$f."', 'DELETE NE ".$ne_name."', $h,'".$dated."','".$j."','".$user."')")
			or die ("Query error!");
		}
		redirect("modifyservicep");
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */