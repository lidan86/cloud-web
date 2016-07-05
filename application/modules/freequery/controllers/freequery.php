<?php
class Freequery extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
               
        }
    function index(){
      
            
            $this->template->build('v_freequery');
    }
    
    public function result(){
        $this->template->build('v_result');
        
        
    }
    
    public function do_insert(){
        $dashboard = $_POST['dashboard'];
        $ne_id = $_POST['ne_id'];
        $column_name = $_POST['column_name'];
        $agregatio = $_POST['agregatio'];
        $chart_type = $_POST['chart_type'];
        $wee = $_POST['wee'];
        $yee = $_POST['yee'];

        $a = '';
        $i = 0;
        foreach($column_name as $names){
            $i++;
            $a .= $agregatio.'('.$names.') as q'.$i.' ,';

        }

        $b = substr($a,0,strlen($a)-1);
        $sql = 'select date(dated) as dated, '.$b.' from raw_sources.'.$ne_id.' where extract(week from dated) = '.$wee.' and
                extract(year from dated) = '.$yee.' group by date(dated), extract(week from dated), extract(year from dated)
                order by dated ';

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
        if(!empty($dashboard) && !empty($chart_type)){
            $insert = pg_query($conn, "INSERT INTO public.dashboard_free_query(
             dashboard_name, free_query,  column_length, chart_type, weeks, years)
    VALUES ( '".$dashboard."', '".$sql."', $i, '".$chart_type."','".$wee."','".$yee."')")
            or die ("Query error!");
        }


        redirect("freequery");

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
