<?php
error_reporting(0);
ini_set('displays_errors',0);
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
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $weeksto = $row->set2;
    $years = $row->years;

}

if($cat_type ==1){
    $cat_type = 'SMS';

}elseif($cat_type == 2){
    $cat_type = 'Internet';

}else{
    $cat_type = 'Voice';
}

?>

<div class="row">
    <div class="col-md-6">
       <h4 class="page-header">System Profile</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="datatable1" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">IT System</th>
                <th style="text-align: center">Aplication</th>

                <th style="text-align: center">Year</th>
                <th style="text-align: center">Week</th>
                <th style="text-align: center">Total</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <?php
            $colum = pg_query($conn, "select
it_system,application,years,weeks,sum(_value) as total_value
from raw_sources.it_systems
where (weeks>=".$weeks." and weeks<=".$weeksto.") and years=".$years."
group by years,weeks,it_system,application
order by years,weeks,it_system,application")
            or die ("Query error!");
            while ($row = pg_fetch_array($colum)) {

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['it_system']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['application']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['years']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['weeks']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".number_format($row['total_value'])."</td>");

                echo("</tr>");


            }


            ?>


            </tbody>
        </table>
    </div>
</div>

