<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$jsonz = file_get_contents($api.'CapmanApi/Master_Cpc?status=list');

$dataz = json_decode($jsonz,true);
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Cost per Capacity</h4>

    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-info" href="<?php echo base_url();?>cost/add_data">Add</a>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
        <?php

        echo("<table id='datatable2' class='table table-bordered'>");
        echo("<thead  bgcolor='#E0E0E0'>");
        echo("<th nowrap='nowrap' align='center'> Year</th>");
        echo("<th nowrap='nowrap' align='center'> Service Group</th>");
        echo("<th nowrap='nowrap' align='center'>Max Costs</th>");
        echo("<th nowrap='nowrap' align='center'>Min Costs</th>");
        echo("<th nowrap='nowrap' align='center'>Cost</th>");
        echo("<th nowrap='nowrap' align='center'>Edit</th>");
        echo("<th nowrap='nowrap' align='center'>Delete</th>"); echo("</thead>");
        echo("<tbody>");
        foreach($dataz as $row) {

            echo("<tr>");
            echo("<td nowrap='nowrap' align='center'>".$row['years']."</td>");
            echo('<td nowrap="nowrap" align="center">'.$row['master_service_group_id'].'</td>');
            echo("<td nowrap='nowrap' align='center'>".$row['max_costs']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['min_costs']."</td>");
            echo("<td nowrap='nowrap' align='center'>".$row['costs']."</td>");
            echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."cost/editData/".$row['id']."'>Edit</a></td>");
            echo("<td nowrap='nowrap' align='center'><a class='btn btn-danger' href='".base_url()."cost/do_delete/".$row['id']."'>Delete</a></td>");

            echo("</tr>");
        }
        echo("</tbody>");
        echo("</table>");?>

	</div>
</div>
