<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/CarfProjection?status=list&carf_id='.$id,false,$context);
$result = json_decode($json,true);


?>
<div class="row">
    <div class="col-md-12">

        <h4 class="page-header" style="color: #ffffff;">TRAFFIC PROJECTION - <?php foreach($info_carf as $row): ?>
                        <?php echo 'Project Name : '.$row->project_name.' ('.$row->request_num.$row->id.')'; ?>
                    <?php endforeach; ?></h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        echo("<table id='carf2' class='table table-bordered'>");
        echo("<thead  bgcolor='#E0E0E0'>");
        echo("<th nowrap='nowrap' align='center'>Carf Id</th>");
        echo("<th nowrap='nowrap' align='center'>Months</th>");
        echo("<th nowrap='nowrap' align='center'>Year</th>");
        echo("<th nowrap='nowrap' align='center'>Total Voice</th>");
        echo("<th nowrap='nowrap' align='center'>Total SMS</th>");
        echo("<th nowrap='nowrap' align='center'>Total Data Peak Traffic</th>");

        echo("</thead>");
        echo("<tbody bgcolor='#E0E0E0'>");
        foreach($result as $row) {

            echo("<tr>");
            echo("<td nowrap='nowrap' align='center'>".$row['carf_id']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['months']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['years']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['total_voice']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['total_sms']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['total_data_peak_traffic']."</td>");

             echo("</tr>");
        }
        echo("</tbody>");
        echo("</table>");
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-info" href="<?php echo base_url();?>carf/pack_detail/index/edit/<?php echo $id;?>">Next</a>
    </div>
</div>
