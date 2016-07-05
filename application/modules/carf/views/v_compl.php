<?php
$carf =  $this->uri->segment(5);

$queryx = $this->db->query("select * from m_complex WHERE carf_id=".$carf);
$sql = $queryx->result();


?>
<div class="row">
    <div class="col-md-12">

        <h4 class="page-header" style="color: #ffffff;">Complexity Level  - <?php foreach($info_carf as $row): ?>
                        <?php echo 'Project Name : '.$row->project_name.' ('.$row->request_num.$row->id.')'; ?>
                    <?php endforeach; ?></h4>
    </div>
</div>
<?php if(empty($sql)) {?>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-info" href="<?php echo base_url();?>carf/compl_lvl/add_data/edit/<?php echo $id;?>">Add</a>
    </div>
</div>
<?php }?>
<div class="row">

    <div class="col-md-12">
        <?php
        echo("<table id='carf' class='table table-bordered'>");
        echo("<thead  bgcolor='#E0E0E0'>");
        echo("<th nowrap='nowrap' align='center'>Carf Id</th>");
        echo("<th nowrap='nowrap' align='center'>Category</th>");
        echo("<th nowrap='nowrap' align='center'>Product</th>");
        echo("<th nowrap='nowrap' align='center'>Duration Product Concept</th>");
        echo("<th nowrap='nowrap' align='center'>Development Time</th>");
        echo("<th nowrap='nowrap' align='center'>Total RFS</th>");
        echo("<th nowrap='nowrap' align='center'>Edit</th>");
        echo("<th nowrap='nowrap' align='center'>Delete</th>");
        echo("</thead>");
        echo("<tbody bgcolor='#E0E0E0'>");
        if(!empty($sql)) {
            foreach ($sql as $row) {

                echo("<tr>");
                echo("<td nowrap='nowrap' align='center'>" . $row->carf_id . "</td>");
                echo("<td nowrap='nowrap' align='center'>" . $row->category_lvl . "</td>");

                echo("<td nowrap='nowrap' align='center'>" . $row->category_project . "</td>");
                echo("<td nowrap='nowrap' align='center'>" .$row->dcp . "</td>");
                echo("<td nowrap='nowrap' align='center'>" .$row->dt . "</td>");
                echo("<td nowrap='nowrap' align='center'>" .$row->total_rfs . "</td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='" . base_url() . "carf/compl_lvl/editData/edit/" . $row->carf_id . "/" . $row->id. "'>Edit</a></td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-danger' href='" . base_url() . "carf/compl_lvl/do_delete/edit/" . $row->carf_id . "/" . $row->id . "'>Delete</a></td>");
                echo("</tr>");
            }
        }
        echo("</tbody>");
        echo("</table>");
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-info" href="<?php echo base_url();?>carf/recommend/index/edit/<?php echo $id;?>">Next</a>
    </div>
</div>
