<?php

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
$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $weeksto = $row->set2;
    $years = $row->years;

}
?>
<div class="row">
    <div class="col-md-12">
        <table id="table-sparkline" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">Service Type</th>
                <th style="text-align: center">Central</th>
                <th style="text-align: center">East</th>
                <th style="text-align: center">Jabo</th>
                <th style="text-align: center">North</th>
                <th style="text-align: center">West</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
				 <?php
$colum = pg_query($conn, "select * from get_util_per_service(".$weeks.", ".$weeksto.", ".$years.")")
    or die ("Query error!");
    while ($row = pg_fetch_array($colum)) {
       
                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['service_type']."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['central'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['east'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['jabo'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['north'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['west'],2)."</td>");
               echo("</tr>");
           

            }


            ?>

           
            </tbody>
        </table>
    </div>
</div>
