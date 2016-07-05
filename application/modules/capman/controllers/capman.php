<?php
class Capman extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
               
        }
    function index(){
      
            
            $this->template->build('v_freequery');
    }
    
    public function result(){
        $id = $this->uri->segment(3);
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
        $conn = pg_pconnect($conn_string)
        or die("Connection failed!");

        $result = pg_query($conn, " SELECT *
  FROM raw_sources.capman_reserved where service_id =".$id)
        or die ("Query error!");
        $data = pg_fetch_array($result);

        if(empty($data)){
            $list = pg_query($conn, " SELECT  master_jenis_ne_id, ne_name
  FROM master_data.new_master_service_path where master_service_type_id =".$id)
            or die ("Query error!");
            while ($row = pg_fetch_array($list)) {
                $neid = $row['master_jenis_ne_id'];
                $nename = $row['ne_name'];
                $dated = date("Y-m-d");
                $insert = pg_query($conn, "INSERT INTO raw_sources.capman_reserved(
            service_id, ne_id, ne_name,
            createdate)
    VALUES (".$id.", ".$neid.", '".$nename."', '".$dated."')")
                or die ("Query error!");
            }

        }

        $this->template->build('v_result',  array('id' => $id));
        
        
    }
    
    public function do_insert(){
        $id = $_POST['id'];
        $count = $_POST['count'];
        $poc = $_POST['pocc'];

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
        $conn = pg_pconnect($conn_string)
        or die("Connection failed!");

        for($i = 0; $i <= $count;$i++){
            $nename = $_POST['ne_name_'.$i];

            $weight = $_POST['weight_'.$i];
            if(empty($weight)){
                $weight = 0;
            }
            $reserved = $_POST['reserved_'.$i];
            if(empty($reserved)){
                $reserved = 0;
            }
            $insert = pg_query($conn, "UPDATE raw_sources.capman_reserved
   SET  site_name='".$poc."',  weight=".$weight.",
       reserved_value=".$reserved.",  modifieddate='".date("Y-m-d")."'
 WHERE id =".$nename)
            or die ("Query error!");

        }
        redirect("capman/result/".$id);
    }
    public function delete($id){
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
        $conn = pg_pconnect($conn_string)
        or die("Connection failed!");
        $insert = pg_query($conn, "DELETE FROM public.dashboard_free_query WHERE id =".$id)
        or die ("Query error!");
        redirect("freequery");

    }
    

}
