<?php
$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}

$user = $this->session->userdata('username');
$query = $this->db->query("select week, years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $data = $row->week;
    $datax = $row->years;

}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));

$json = file_get_contents($api.'CapmanApi/Service',false,$context);

$datay = json_decode($json,true);


?>
<div class="row"><!-- Related Projects Row -->

    <div class="col-lg-12">
        <h4 class="page-headerer" id="headerWeek"> </h4>
    </div>
</div>

<div class="row"><!-- Portfolio Item Row -->
    <div class="col-md-12">
        <div class="block" >
            <div class="accordion" style="background-color: darkgray;">
                <?php
                foreach($datay as $row){
                    echo("<h3 >".$row['service_type']."</h3>");
                    echo("<div>");
                    echo("<table class='table table-bordered'>");
                    echo('<thead> <th>Region</th><th>POC</th><th>Utilization</th><th>Max Utilization</th><th>Percen %</th> </thead><tbody>');

                    $json2 = file_get_contents($api.'CapmanApi/Api?service='.urlencode($row['service_type']).'&weeks='.urlencode($data).'&years='.urlencode($datax),false,$context);

                    $dataz = json_decode($json2,true);
                    foreach($dataz as $value){
                        echo("<tr>");
                        echo("<td>" . $value['region_name'] . "</td>");
                        echo("<td>" . $value['poc_name'] . "</td>");
                        echo("<td style='text-align: center;'>" . number_format($value['min_utilization'],2) . "</td>");
                        echo("<td style='text-align: center;'>" . number_format($value['max_utilization'],2) . "</td>");
                        echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='" . $value['percen'] . "'></meter>" . $value['percen'] . "%</td>");
                        echo("</tr>");

                    }
                    echo("</tbody></table>");
                    echo("</div>");
                }
                ?>
            </div>

        </div>

    </div>
</div>


</div><!-- /.row -->



