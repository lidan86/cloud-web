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
$result = pg_query($conn, "SELECT * FROM master_data.new_master_service_type  ")
or die ("Query error!");
$id = str_replace('%20', ' ', $this->uri->segment(3));
$service_type = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));

?>
    <input type="hidden" name="week" id="week" value="<?php echo $ne_name;?>">
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Modify Service Path</h4>
    </div>

</div>
    <div class="row" style=" padding-bottom: 15px">

        <div class="col-md-6">
            <h4>Service Type :</h4>
            <select name='type' size='5'>
                <?php
                while ($row = pg_fetch_array($result)) {
                    echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'modifyservicep/index/'.$row['id'].'/'.$row['service_type_name'].'\')">'.$row['service_type_name'].'</option>');
                } ?>
            </select>

        </div>
    </div>
    <br/>

<?php

if(!empty($id)) {

    echo ("<div class='row' style=' padding-bottom: 15px; overflow: scroll;'>");

    echo("<div class='col-md-12'>");
    echo("<h4>Service Path ".$service_type." :</h4>");
    echo("<table>");
    echo("<tr style='text-align: center'>");
    $colum = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where master_service_type_id=" . $id."order by column_number desc limit 1")
    or die ("Query error!");
    while ($row = pg_fetch_array($colum)) {
        $spa = $row['column_number'];
    }
    $last = $spa+1;
    for($x = 1; $x <= $spa; $x++) {
        echo("<td style='padding :0px; 'nowrap='nowrap'><a class='widget-icon widget-icon-dark' href='".base_url()."modifyservicep/add/".$id."/".$x."/".$spa."'><i class='icon-plus'></i></a></td>");
        echo("<td style='padding :0px; 'nowrap='nowrap'><i class='icon-long-arrow-right'></i></td>");

        echo("<td><table >");
        $respath = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where master_service_type_id=" . $id." and column_number = ".$x." order by type_path asc")
        or die ("Query error!");
        while ($row = pg_fetch_array($respath)) {
            if($row['type_path'] == 2) {
                echo("<tr style='text-align: center'><td style='margin-bottom: 5px;' class='btn btn-warning'  nowrap='nowrap'><a style='color: white;' href='" . base_url() . "modifyservicep/replace/" . $id . "/" . $row['id'] . "/" . $row['master_jenis_ne_id'] . "' ><i class='icon-edit'></i> " . $row['ne_name'] . "</a></td></tr> ");
            }else{
                echo("<tr style='text-align: center'><td style='margin-bottom: 5px;' class='btn btn-info'  nowrap='nowrap'><a style='color: white;' href='" . base_url() . "modifyservicep/replace/" . $id . "/" . $row['id'] . "/" . $row['master_jenis_ne_id'] . "' ><i class='icon-edit'></i> " . $row['ne_name'] . "</a></td></tr> ");

            }
        }
        echo("<tr>");
        echo("<td ><a class='btn btn-danger' href='".base_url()."modifyservicep/edit/".$id."/".$x."'><i class='icon-plus'></i></a></td>");
        echo("</tr>");
        echo("</table></td>");
        if($x != $spa){
        echo("<td style='padding :0px; 'nowrap='nowrap'><i class='icon-long-arrow-right'></i></td>");
        }else{
            echo("<td style='padding :0px; 'nowrap='nowrap'><i class='icon-long-arrow-right'></i></td>");
            echo("<td style='padding :0px; 'nowrap='nowrap'><a class='widget-icon widget-icon-dark' href='".base_url()."modifyservicep/edit/".$id."/".$last."'><i class='icon-plus'></i></a></td>");

        }
    }
    echo("</tr>");

    echo("</table>");
}
echo("</div><br><br/></div>");
?>
