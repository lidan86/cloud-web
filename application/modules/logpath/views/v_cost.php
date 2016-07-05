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
$conn = pg_connect($conn_string)
or die("Connection failed!");


?>

<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header">History Data Log Path</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="datatable1" class="table table-bordered">
            <thead>
            <th>Dated</th>
            <th>Service Type</th>
            <th>Action</th>
            <th>Username</th>
            </thead>
            <tbody>
            <?php
            $list = pg_query($conn, "select hsp.remark,hsp.username, hsp.history_date,(select id from master_data.new_master_service_type where master_data.new_master_service_type.id=hsp.master_service_type_id) as service_type_id,
 (select service_type_name from master_data.new_master_service_type where master_data.new_master_service_type.id=hsp.master_service_type_id) as service_type_name
from history_service_path hsp group by hsp.username, hsp.remark, hsp.master_service_type_id,hsp.history_date ")
            or die ("Query error!");
            while ($row = pg_fetch_array($list)) {
                echo("<tr>");
                echo("<td>".$row['history_date']."</td>");
                echo("<td>".$row['service_type_name']."</td>");
                echo("<td>".$row['remark']."</td>");
                echo("<td>".$row['username']."</td>");
                echo("</tr>");
            }
            ?>

            </tbody>
        </table>
    </div>
</div>