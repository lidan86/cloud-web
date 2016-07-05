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
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));

$json = file_get_contents($api.'CapmanApi/Soar?data=TABLE&weeks='.$data.'&years='.$datax ,false,$context);

$datay = json_decode($json,true);

?>
<div class="row" >
    <div class="col-md-12" >
        <div class="block block-fill-white">
            <div class="content">
        <table  class="table table-bordered" id="entrydata">
            <thead>
            <tr>
                <th style="text-align: center">CKF</th>
                <th style="text-align: center">Expected Peak</th>
                <th style="text-align: center">Actual Peak</th>
                <th style="text-align: center">% Utilization</th>
                <th style="text-align: center">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach($datay as $row) {

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['ne_name']."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['expected'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['gte70'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['gte70']/$row['expected'])*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['gte70']/$row['expected'])*100 ."'></meter></td>");
                echo("</tr>");
            }

            ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>


</div>

<?php

    $json4 = file_get_contents($api.'CapmanApi/Soar?data=CPU&weeks='.$data.'&years='.$datax.'' ,false, $context);

    $data3 = json_decode($json4,true);


        ?>

        <div class="row" >
            <div class="col-md-12">

                <div id="container" style="min-width: 510px; max-width: 1000px; height: 1200px; margin: 0 auto"></div>

            </div>
        </div>

        <?php


        echo("<table id='datatablex' class='default' style='display: none'>");
        echo("<tr bgcolor='#E0E0E0'>");
        echo("<td nowrap='nowrap'>Services Type</td>");

        echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
        echo("</tr>");
        if(!empty($data3)) {
            foreach ($data3 as $row) {
                echo("<tr>");
                echo("<td>" . $row['Server'] . "</td>");
                echo("<td>" . $row['max'] . "</td>");

                echo("</tr>");
            }
        }
        echo("</table>");


?>

<?php

$json2 = file_get_contents($api.'CapmanApi/Soar?data=MEMORY&weeks='.$data.'&years='.$datax.'',false,$context);
//$json4 = file_get_contents('http://192.168.50.93:8080/CapmanApi/Home?home=home3&weeks=49&years=2014&ne_name=RNC');

$data2 = json_decode($json2,true);


?>

    <div class="row" >
        <div class="col-md-12">

            <div id="container2" style="min-width: 510px; max-width: 1000px; height: 1200px; margin: 0 auto"></div>

        </div>
    </div>

<?php


echo("<table id='datatable' class='default' style='display: none'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");

echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
echo("</tr>");
if(!empty($data2)) {
    foreach ($data2 as $row) {
        echo("<tr>");
        echo("<td>" . $row['Server'] . "</td>");
        echo("<td>" . $row['max'] . "</td>");

        echo("</tr>");
    }
}
echo("</table>");


?>