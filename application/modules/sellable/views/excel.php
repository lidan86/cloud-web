<?php

$user = $this->session->userdata('username');
$query = $this->db->query("select week, years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $data = $row->week;
    $datax = $row->years;

}

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$json = file_get_contents($api.'CapmanApi/Home?home=home1&weeks='.$data.'&years='.$datax);

$datay = json_decode($json,true);


?>

<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo("<table id='datatable' border='1'>");
echo("<thead>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services</td>");
echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>Last Utilization</td>");
echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
echo("</tr>");
echo("</thead><tbody>");
foreach($datay as $row) {
    switch($row['util']) {
        case ($row['util'] <= 50) : $bg="lightgreen"; break;
        case ($row['util'] > 50.01 && $row['util'] < 75.01) : $bg="yellow"; break;
        case ($row['util'] > 75) : $bg="#FF8888"; break;
    }
    echo("<tr>");
    echo('<td nowrap="nowrap"><a href="javascript:location.replace(\''. base_url().'home/'.$row['id'].'/'.$row['service_group'].'\')">'.$row['service_group'].'</td>');
    echo("<td nowrap='nowrap' bgcolor=".$bg." align='center'>".number_format($row['last_week'],2)."</td>");
    echo("<td nowrap='nowrap' bgcolor=".$bg." align='center'>".number_format($row['util'],2)."</td>");
    echo("</tr>");
}
echo("</tbody></table>");?>