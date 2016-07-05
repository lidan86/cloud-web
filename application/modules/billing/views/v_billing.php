<?php

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $years = $row->years;

}

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Expected_peak_thp',false,$context);
$result = json_decode($json,true);

?>
<div class="row">
    <div class="col-md-12">
        <table id="table-sparkline" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">System</th>
                <th style="text-align: center">Installed THP</th>
                <th style="text-align: center">Peak THP</th>
                <th style="text-align: center">%Capacity Utilization at Peak Hour</th>
                <th style="text-align: center">Status</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <tr>
                <th style="text-align: center" >BILLING SUBSCRIBERS</th>
                <td style="text-align: center">83.300.000</td>
                <td style="text-align: center">63.217.979</td>
                <td style="text-align: center">76%</td>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="76"></td>
            </tr>
            <tr>
                <th style="text-align: center" >BILLING TPS</th>
                <td style="text-align: center">170.000</td>
                <td style="text-align: center">63.232</td>
                <td style="text-align: center">37%</td>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="37"></td>
            </tr>
            <tr>
                <th style="text-align: center" >PI (PERFORMANCE INDICATOR)</th>
                <td style="text-align: center">20</td>
                <td style="text-align: center">15</td>
                <td style="text-align: center">75%</td>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="75"></td>
            </tr>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="table-sparkline" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">System</th>
                <th style="text-align: center">Installed THP</th>
                <th style="text-align: center">Peak THP</th>
                <th style="text-align: center">%Capacity Utilization at Peak Hour</th>
                <th style="text-align: center">Status</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <?php
            foreach($result as $row){
                echo("<tr>");
                echo(' <th style="text-align: center" >'.$row['ne_name'].'</th>');
                echo(' <td style="text-align: center">'.$row['expected_peak'].'</td>');
                echo('  <td style="text-align: center">'.$row['peak'].'</td>');
                echo(' <td style="text-align: center">'.$row['utlization_peak_hour'].'</td>');
                echo('<td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="'.$row['utlization_peak_hour'].'"></td>');
                echo("</tr>");

            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table-bordered">
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="76"></td>
                <td>Warning</td>
                <td>>75%</td>
            </tr>
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="51"></td>
                <td>Alert</td>
                <td>50%-75%</td>
            </tr>
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="40"></td>
                <td>Save</td>
                <td><50%</td>
            </tr>
        </table>
    </div>
</div>
