<?php
$idd = str_replace('%20', ' ', $this->uri->segment(3));
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
$conn = pg_connect($conn_string)
or die("Connection failed!");

$heade = pg_query($conn, "SELECT * FROM public.dashboard_free_query WHERE id=".$idd)
or die ("Query error!");
while ($row = pg_fetch_array($heade)) {
    $x = $row['column_length'];
    $query = $row['free_query'];
    $dash = $row['dashboard_name'];
    $chart_type = $row['chart_type'];

}
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Result Query <?php echo $dash;?></h4>
    </div>
</div>
<div class="row">
    <div class="side pull-right">
        <div class="btn-group">
           <a class="btn btn-info" href="<?php echo base_url()?>freequery">Back</a>

        </div>
    </div>

<input type="hidden" id="name_dash" value="<?php echo $dash;?>">
<input type="hidden" id="chart_type" value="<?php echo $chart_type;?>">
<div class="row">
    <div class="col-md-12">
        <table id="datatable1" class="table table-bordered">
            <thead>
            <?php

            for($i = 0; $i <= $x; $i++){
                if($i == 0){
                    echo('<th>dated</th>');
                }else{
                    echo('<th>q'.$i.'</th>');
                }
            }
            ?>
            </thead>
            <tbody>
            <?php
            $isi = pg_query($conn, $query) or die ("Query error!");
            while ($row = pg_fetch_array($isi)) {
                echo("<tr>");
                for($i = 0; $i <= $x; $i++){
                    if($i == 0){
                        echo('<td>'.$row['dated'].'</td>');
                    }else{
                        $dat = 'q'.$i;
                        echo('<td>'.$row[$dat].'</td>');
                    }
                }
                echo("</tr>");

            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Result Chart <?php echo $dash;?></h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>

