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
$json = file_get_contents($api.'CapmanApi/ITService?id=group1&id_service_group=17',false,$context);
$result = json_decode($json,true);

$id = str_replace('%20', ' ', $this->uri->segment(3));
$service_type = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));

?>
    <input type="hidden" name="week" id="week" value="<?php echo $ne_name;?>">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">IT Service</h3>

        </div>
    </div>
    <div class="row" style="">
        <div class="col-md-6">
            <h4>Service Type :</h4>
            <select name='type' size='5'>
                <?php
                foreach($result as $row) {
                    echo('<option value="'.$row['id'].'"  onclick="javascript:location.replace(\''. base_url().'itservice/index/'.$row['id'].'/'.$row['service_type_name'].'\')">'.$row['service_type_name'].'</option>');
                } ?>
            </select>

        </div>
    </div>
    <br/>

<?php

if(!empty($id)) {

    echo ("<div class='row' style=''>");

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
                echo('<tr style="text-align: center"><td style="margin-bottom: 5px" class="btn btn-warning" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'itservice/index/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" >'.$row['ne_name'].'</a></td><td style="margin-bottom: 5px; margin-left: 5px;" class="'.$bg.'" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'itservice/data/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" ><i class="icon-edit"></i> '.$title.'</a></td></tr>');
            }else{
                echo('<tr style="text-align: center"><td style="margin-bottom: 5px" class="btn btn-info" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'itservice/index/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" >'.$row['ne_name'].'</a></td><td style="margin-bottom: 5px;  margin-left: 5px;" class="'.$bg.'" nowrap="nowrap"><a style="color: #ffffff;" href="#" onclick="javascript:location.replace(\''. base_url().'itservice/data/'.$id.'/'.$service_type.'/'.$row['ne_name'].'\')" ><i class="icon-edit"></i> '.$title.'</a></td></tr>');

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
    $respath = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where master_service_type_id=" . $id." and ne_name ='".$ne_name."'")
    or die ("Query error!");
    while ($row = pg_fetch_array($respath)) {
        $weight = $row['weight_impact'];
    }
    if(empty($weight)){ $weight = 0;}
    ?>

    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="header">
                    <h4 class="page-header">Add or Edit Data</h4>
                </div>
                <div class="content controls">
                    <form method="post" action="<?php echo base_url().'index.php/itservice/do_insert'; ?> ">

                        <div class="form-row">
                            <div class="col-md-3"  class="form-control" >Weight</div>
                            <div class=col-md-8><input type=text class="form-control" name="weight" placeholder="weight" value="<?php echo $weight;?>"/></div>
                            <div class="col-md-1">%</div>
                        </div>
                        <input type="hidden" name="ne_name" value="<?php echo $ne_name;?>">
                        <input type="hidden" name="service_type" value="<?php echo $id; ?>"
                        <br>
                        <div class="footer">
                            <div class="side pull-right">
                                <div class="btn-group">
                                    <br>
                                    <button class="btn btn-primary" type="submit" > Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>