<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/MasterNedetail?status=list',false,$context);
$result = json_decode($json,true);

$id = str_replace('%20', ' ', $this->uri->segment(2));
$service_type = str_replace('%20', ' ', $this->uri->segment(3));
$ne_name = str_replace('%20', ' ', $this->uri->segment(4));

?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">NE Detail</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
           <a class="btn btn-info" href="<?php echo base_url();?>nedetail/add_data">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo("<table id='datatable2' class='table table-bordered'>");
            echo("<thead  bgcolor='#E0E0E0'>");
            echo("<th nowrap='nowrap' align='center'>NE</th>");
            echo("<th nowrap='nowrap' align='center'>Year</th>");
            echo("<th nowrap='nowrap' align='center'>Low Range</th>");
            echo("<th nowrap='nowrap' align='center'>Midle Range</th>");
            echo("<th nowrap='nowrap' align='center'>High Range</th>");
            echo("<th nowrap='nowrap' align='center'>Edit</th>");
            echo("<th nowrap='nowrap' align='center'>Delete</th>");
            echo("</thead>");
            echo("<tbody>");
            foreach($result as $row) {

                echo("<tr>");
                echo("<td nowrap='nowrap' align='center'>".$row['ne_name']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['years']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['low_range']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['middle_range']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['high_range']."</td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."nedetail/editData/".$row['id']."'>Edit</a></td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-danger' href='".base_url()."nedetail/do_delete/".$row['id']."'>Delete</a></td>");
                echo("</tr>");
            }
            echo("</tbody>");
            echo("</table>");
            ?>
        </div>
    </div>