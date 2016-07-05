<?php
$user = $this->session->userdata('username');
$query = $this->db->query("select week,years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->week;
    $years = $row->years;

}

$queryx = $this->db->query("select * from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
    $ip_post = $row->ip_post;
    $port_post = $row->port_post;
    $db_post = $row->db_post;
    $user_post = $row->user_post;
    $pass_post = $row->pass_post;
}

$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
$conn = pg_connect($conn_string)
or die("Connection failed!");
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/NeService?id=group1&id_service_group=17',false,$context);
$result = json_decode($json,true);

$id = str_replace('%20', ' ', $this->uri->segment(3));
$service_type = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));

?>
<input type="hidden" name="week" id="week" value="<?php echo $ne_name;?>">
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Network Service</h3>

    </div>
</div>
<div class="row" style="">

    <div class="col-md-6">
        <h4>Service Type :</h4>
        <select name='type' size='5'>
            <?php
            foreach($result as $row) {
            echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'networkservice/index/'.$row['id'].'/'.$row['service_type_name'].'\')">'.$row['service_type_name'].'</option>');
            } ?>
        </select>

    </div>
</div>
<br/>

<?php

if(!empty($id)) {

echo ("<div class='row' style=' overflow: scroll;'>");

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
        echo("<td style='padding :0px; 'nowrap='nowrap'><i class='icon-long-arrow-right'></i></td>");

        echo("<td><table >");
        $respath = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where master_service_type_id=" . $id." and column_number = ".$x." order by type_path asc")
        or die ("Query error!");
        while ($row = pg_fetch_array($respath)) {
            if($row['weight_impact'] > 80 ){
                $bg = 'btn btn-danger';
                $title = 'HIGH';
            }elseif($row['weight_impact'] > 50 &&$row['weight_impact'] <= 80){
                $bg = 'btn btn-warning';
                $title = 'MIDDLE';
            }else{
                $bg = 'btn btn-success';
                $title = 'LOW';
            }
            if($row['type_path'] == 2) {

                echo('<tr style="text-align: center"><td style="margin-bottom: 5px" class="btn btn-warning" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'networkservice/index/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" >'.$row['ne_name'].'</a></td><td style="margin-bottom: 5px; margin-left: 5px;" class="'.$bg.'" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'networkservice/data/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" ><i class="icon-edit"></i> '.$title.'</a></td></tr>');
            }else{
                echo('<tr style="text-align: center"><td style="margin-bottom: 5px" class="btn btn-info" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'networkservice/index/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" >'.$row['ne_name'].'</a></td><td style="margin-bottom: 5px;  margin-left: 5px;" class="'.$bg.'" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'networkservice/data/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" ><i class="icon-edit"></i> '.$title.'</a></td></tr>');

            }
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
<?php

if(!empty($id) && !empty($ne_name)) {
    $json4 = file_get_contents($api.'CapmanApi/NeService?id=group4&ne_name='.urlencode($ne_name).'&week='.$weeks.'&year='.$years,false,$context);
    $resckf = json_decode($json4,true);
    if($resckf == null){

        echo("<div class='row' >");
        echo("<div class='col-md-12'>");
        echo("<h3 style='color: #ff0000'> Data Not Found</h3>");
        echo("</div> </div>");
    }else{
    ?>
    <br>
    <br>
    <div class="row" >
        <div class="col-md-12">
            <h4>NE CKF Utilization</h4>
            <input type="hidden" id="ne" value="<?php echo $ne_name;?>">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        </div>
    </div>

    <?php
        echo("<table id='datatable' style='display: none' class='table table-bordered'>");
   foreach($resckf as $row) {
        echo("<tr>");
        echo("<td>".$row['ckf']."</td>");
        echo("<td>".number_format($row['avgutil'],2)."</td>");
        echo("</tr>");
    }
    echo("</table>");

    ?>
<?php }} ?>