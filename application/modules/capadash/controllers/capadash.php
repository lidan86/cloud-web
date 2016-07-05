<?php
class Capadash extends MX_Controller {

	public function __construct() {

		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
		$this->load->model('capadash_m');
	}

	/**
	 *
     */
	public function index(){
		$id = $this->uri->segment(3);

		if( $this->session->userdata['group_id'] == '9'){//administrator


			$user = $this->session->userdata('username');
			$query = $this->db->query("select * from filter where username ='".$user."'");
			$sql = $query->result();
			foreach($sql as $row){
				$weeks = $row->set1;
				$years = $row->years;
				$from = $row->set1;
				$too = $row->set2;
				$cat_type = $row->cat_type;


			}

			$queryx = $this->db->query("select * from api LIMIT 1");
			$sqlx = $queryx->result();
			foreach($sqlx as  $row){
				$api = $row->api;
				$ip_post = $row->ip_post;
				$port_post = $row->port_post;
				$db_post = $row->db_post;
				$user_post = $row->user_post;
				$pass_post = $row->pass_post;
			}
			$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
			$conn = pg_connect($conn_string)
			or die("Connection failed!");
			$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','protocol_version' => '1.0','method' => 'GET')));
			if($id == 1){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("BSS 2G BSC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "2G BSC";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 2){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("BSS 3G RNC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "3G RNC";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 3){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Radio Access Network").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "2G BSC";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 4){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Core Network (PS & CS Core)").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "Data Core";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 5){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Data Services").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "IT DS Core";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 6){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("UPSTREAM").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "Upstream";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 7){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=1&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "VAS";
				$this->template->build('v_index',  array('resbss' => $resbss,'judul' => $judul));
			}elseif($id == 8){
				$json = file_get_contents($api.'CapmanApi/Capdash?status=1&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
				$resbss = json_decode($json,true);
				$judul = "SMS";
				$this->template->build('v_smsc_1',  array('resbss' => $resbss,'judul' => $judul));
			}
			else {
				$this->template->build('v_index');
			}

		}else{
			redirect("capadash/view");
		}


	}
	public function view(){
		$id = $this->uri->segment(3);
		$user = $this->session->userdata('username');
		$query = $this->db->query("select * from filter where username ='".$user."'");
		$sql = $query->result();
		foreach($sql as $row){
			$weeks = $row->set1;
			$years = $row->years;
			$from = $row->set1;
			$too = $row->set2;
			$cat_type = $row->cat_type;


		}

		$queryx = $this->db->query("select * from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$api = $row->api;
			$ip_post = $row->ip_post;
			$port_post = $row->port_post;
			$db_post = $row->db_post;
			$user_post = $row->user_post;
			$pass_post = $row->pass_post;
		}
		$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
		$conn = pg_connect($conn_string)
		or die("Connection failed!");
		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','protocol_version' => '1.0','method' => 'GET')));
		if($id == 1){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("BSS 2G BSC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "2G BSC";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 2){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("BSS 3G RNC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "3G RNC";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 3){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Radio Access Network").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "2G BSC";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 4){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Core Network (PS & CS Core)").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "Data Core";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 5){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("Data Services").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "IT DS Core";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 6){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=0&ne_group='. urlencode("UPSTREAM").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "Upstream";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 7){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=1&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "VAS";
			$this->template->build('v_result',  array('resbss' => $resbss,'judul' => $judul));
		}elseif($id == 8){
			$json = file_get_contents($api.'CapmanApi/Capdash?status=1&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
			$resbss = json_decode($json,true);
			$judul = "SMS";
			$this->template->build('v_smsc',  array('resbss' => $resbss,'judul' => $judul));
		}
		else {
			$this->template->build('v_result');
		}

	}
	public function drill(){

		$this->template->build('v_drill');
	}
	public function service(){




		$this->template->build('v_report');
	}
	public function do_insert(){

		$button = $_POST['savedata'];
		$ne_id = $_POST['ne_id'];
		$ne_name = $_POST['ne_name'];
		$weeks = $_POST['weeks'];
		$years = $_POST['years'];

		$uc = $_POST['utilComment'];
		$bc = $_POST['businessComment'];
		$nc = $_POST['networkComment'];

		$uci = "green";
		$bci = $_POST['business_img'];
		$nci = $_POST['network_img'];
		$queryx = $this->db->query("select api from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$api = $row->api;
		}
		echo ">>>> ".$button." <<<<";

		if($button=="Save") {
			$url = $api.'CapmanApi/Command';
			$fields = array(
				'status' => urlencode("insert"),
				'ne_id' => urlencode($ne_id),
				'ne_name' => urlencode($ne_name),
				'weeks' => urlencode($weeks),
				'years' => urlencode($years),
				'util_comments' => urlencode($uc),
				'business_comments' => urlencode($bc),
				'network_comments' => urlencode($nc),
				'util_img' => urlencode($uci),
				'business_img' => urlencode($bci),
				'network_img' => urlencode($nci)
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
			//$cek = json_encode($jsoni,true);
		} else {
			$url = $api.'CapmanApi/Command';
			$fields = array(
				'status' => urlencode("update"),
				'ne_id' => urlencode($ne_id),
				'ne_name' => urlencode($ne_name),
				'weeks' => urlencode($weeks),
				'years' => urlencode($years),
				'util_comments' => urlencode($uc),
				'business_comments' => urlencode($bc),
				'network_comments' => urlencode($nc),
				'util_img' => urlencode($uci),
				'business_img' => urlencode($bci),
				'network_img' => urlencode($nci)
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

		}
		redirect("capadash");
	}


	public function change($lang = "english", $class, $method='', $param=""){
		/* $this->config->set_item('lang', $lang); */
		$this->session->set_userdata('lang',$lang);
		$this->lang->is_loaded = array();
		$this->lang->language = array();
		/* $this->lang->load('form_validation', $type);
		$this->lang->load('message', $type); */

		if(empty($method)) $method = 'index';
			redirect("/".$class."/".$method."/".$param);
	}
}
