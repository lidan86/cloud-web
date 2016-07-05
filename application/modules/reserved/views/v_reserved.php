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

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row) {
    $from = $row->set1;
    $too = $row->set2;
    $years = $row->years;
    $cat_type = $row->cat_type;
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
$result = pg_query($conn, "select * from reserved1(".$from.",".$too.",".$years.",'".$cat_type."')")
or die ("Query error!");
echo("<table id='datatable' class='default' style='display: none;'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");
echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Projections</td>");
echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>Traffic</td>");

echo("</tr>");
while ($row = pg_fetch_array($result)) {
    $total = $row['act'] - $row['projection_tb'];
    echo("<tr>");
    echo("<td>" . $row['service_type'] . " <br>(M-".$row['months'].")</td>");
    echo("<td>" .$row['projection_tb']. "</td>");
   echo("<td>" .$total. "</td>");


    echo("</tr>");
}
echo("</table>");

?>
<div class="row">
    <div class="col-md-12">
        <div id="containerx" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>
<?php
$result = pg_query($conn, "select * from reserved1(".$from.",".$too.",".$years.",'".$cat_type."')")
or die ("Query error!");
echo("<table id='datatablex' class='default' style='display: none;'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");
echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Projections</td>");
echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>Trafiic</td>");

echo("</tr>");
while ($row = pg_fetch_array($result)) {
    $total = (($row['act']/$row['act'])*100) - $row['projection_percent'];
    echo("<tr>");
    echo("<td>" . $row['service_type'] . " <br>(M-".$row['months'].")</td>");
    echo("<td>" .$row['projection_percent']. "</td>");
    echo("<td>" .$total. "</td>");


    echo("</tr>");
}
echo("</table>");

?>
