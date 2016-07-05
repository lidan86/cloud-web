<?php
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
$user = $this->session->userdata('username');
$query = $this->db->query("select week,years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->week;
    $years = $row->years;

}

$id = str_replace('%20', ' ', $this->uri->segment(3));
$service_type = str_replace('%20', ' ', $this->uri->segment(4));
$dated = str_replace('%20', ' ', $this->uri->segment(5));

?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Log Path Date <?php echo $dated;?></h4>
    </div>

</div>

<div class="row">
    <div class="side pull-right">
        <div class="btn-group">
            <a class="btn btn-info" href="<?php echo base_url()?>logpath">Back</a>

        </div>
    </div>
</div>
<?php

if(!empty($id)) {

    echo ("<div class='row' style=' padding-bottom: 15px; overflow: scroll;'>");

    echo("<div class='col-md-12'>");
    echo("<h4>Service Path ".$service_type." :</h4>");
    echo("<table>");
    echo("<tr style='text-align: center'>");
    $colum = pg_query($conn, "SELECT * FROM public.history_service_path where master_service_type_id = ".$id." and history_date ='".$dated."' order by id desc ")
    or die ("Query error!");
    while ($row = pg_fetch_array($colum)) {
        $spa = $row['column_number'];
    }
    $last = $spa+1;
    for($x = 1; $x <= $spa; $x++) {

        echo("<td><table>");
        $respath = pg_query($conn, "SELECT * FROM public.history_service_path where master_service_type_id = ".$id." and history_date ='".$dated."' and column_number = ".$x)
        or die ("Query error!");
        while ($row = pg_fetch_array($respath)) {

            echo("<tr style='text-align: center'><td class='btn btn-info' style='margin-bottom: 5px'><a style='color: white;' href='#'>" . $row['ne_name'] . "</a></td></tr> ");
        }

        echo("</table></td>");
        if($x != $spa){
            echo("<td style='padding :0px; 'nowrap='nowrap'><i class='icon-long-arrow-right'></i></td>");
        }else{

        }
    }
    echo("</tr>");

    echo("</table>");
}
echo("</div><br><br/></div>");
?>
