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
    <div class="col-md-12">
        <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>
<?php
$result = pg_query($conn, "select
act.months::character varying,
act.service_type::character varying,
avg(act.avg_traffic)/(select max(swe_voice/1000000) from raw_sources.swe where date_part('month',dated)=act.months)::double precision as subscriber_profile,
(select max(total_voice_tb) from view_carf_projections where months=act.months and years=act.years)::double precision as projection_tb
from view_actual_traffic act
where years=".$years." and (months>=".$weeks." and months<=".$weeksto.") and service_type like '%".$cat_type."%'
group by act.years,act.months,act.service_type
order by act.years,act.months,act.service_type")
or die ("Query error!");
echo("<table id='datatable' class='default' style='display: none;'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");
echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Subscriber Profile</td>");
echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>Projections</td>");

echo("</tr>");
while ($row = pg_fetch_array($result)) {

    echo("<tr>");
    echo("<td>" . $row['service_type'] . " <br>(M-".$row['months'].")</td>");
    echo("<td>" .$row['subscriber_profile']. "</td>");
    echo("<td>" .$row['projection_tb']. "</td>");


    echo("</tr>");
}
echo("</table>");

?>
<div class="row">
    <div class="col-md-12">
        <table id="datatable1" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">Date</th>
                <th style="text-align: center">Service Type</th>

                <th style="text-align: center">Actual Traffic</th>
                <th style="text-align: center">SWE <?php echo $cat_type;?></th>
                <th style="text-align: center">Subscriber Profile</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <?php
            $colum = pg_query($conn, "select * from subscriber1(".$weeks.",".$weeksto.",".$years.",'".$cat_type."') order by dated,service_type")
            or die ("Query error!");
            while ($row = pg_fetch_array($colum)) {

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['dated']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['service_type']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['act']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['swe_tb']."</td>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['subscriber_profile']."</td>");

                echo("</tr>");


            }


            ?>


            </tbody>
        </table>
    </div>
</div>

