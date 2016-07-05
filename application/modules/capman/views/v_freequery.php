<?php
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

$result = pg_query($conn, "SELECT id, service_type_name FROM master_data.new_master_service_type")
or die ("Query error!");
$table_name = str_replace('%20', ' ', $this->uri->segment(3));
$tahun = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));

?>
<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header"> Capacity Managment Reserved</h4>
    </div>

</div>

<div class="row">
    <div class="col-md-2"> Table Name</div>

</div>
<div class="row">
    <div class="col-md-2">
        <select class="form-control" id="ne_id" name="ne_id" >
            <?php
            echo('<option value="---" >----</option>');
            while ($row = pg_fetch_array($result)) {

                if(!empty($table_name) && $table_name == $row['id']){
                    echo('<option selected value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$row['id'].'\')">'.$row['service_type_name'].'</option>');

                }else{
                echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$row['id'].'\')">'.$row['service_type_name'].'</option>');
                }
            }
            ?>

        </select>
    </div>
