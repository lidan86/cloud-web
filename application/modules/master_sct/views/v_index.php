<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Master_sct?status=list',false,$context);
$result = json_decode($json,true);

?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">Specific Capacity Threshold</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
           <a class="btn btn-info" href="<?php echo base_url();?>master_sct/add_data">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo("<table id='datatable2' class='table table-bordered'>");
            echo("<thead  bgcolor='#E0E0E0'>");
            echo("<th nowrap='nowrap' align='center'>Ne Name</th>");
            echo("<th nowrap='nowrap' align='center'>Minimum Fill Capacity</th>");
            echo("<th nowrap='nowrap' align='center'>Alert Threshold Capacity</th>");
            echo("<th nowrap='nowrap' align='center'>Max Capacity Threshold</th>");
            echo("<th nowrap='nowrap' align='center'>Edit</th>");
            echo("<th nowrap='nowrap' align='center'>Delete</th>");
            echo("</thead>");
            echo("<tbody>");
            foreach($result as $row) {

                echo("<tr>");
                echo("<td nowrap='nowrap' align='center'>".$row['jenis_ne_name']."</td>");

                echo("<td nowrap='nowrap' align='center'>".$row['minimum_fill_capacity']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['alert_threshold_capacity']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['max_capacity_threshold']."</td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."master_sct/editData/".$row['id']."'>Edit</a></td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."master_sct/do_delete/".$row['id']."'>Delete</a></td>");
                echo("</tr>");
            }
            echo("</tbody>");
            echo("</table>");
            ?>
        </div>
    </div>