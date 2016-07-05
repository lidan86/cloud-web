<?php
$queryx = $this->db->query("select * from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $ip_post = $row->ip_post;
    $port_post = $row->port_post;
    $db_post = $row->db_post;
    $user_post = $row->user_post;
    $pass_post = $row->pass_post;
    $api = $row->api;


}
$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
$conn = pg_pconnect($conn_string)
or die("Connection failed!");

$result = pg_query($conn, "SELECT id, service_type_name FROM master_data.new_master_service_type")
or die ("Query error!");
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Selleble?status=poc',false,$context);
$datay = json_decode($json,true);
//$rows=array();

$poc_name = str_replace('%20', ' ', $this->uri->segment(4));
$table_name = $id;

?>
<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header"> Capacity Managment Reserved</h4>
    </div>

</div>

<div class="row">
    <div class="col-md-2"> Table Name</div>
    <div class="col-md-3"> POC Name</div>

</div>
<div class="row">
    <div class="col-md-2">
        <select class="form-control" id="ne_id" name="ne_id" >
            <?php
            echo('<option value="---" >----</option>');
            while ($row = pg_fetch_array($result)) {

                if(!empty($table_name) && $table_name == $row['id']){
                    echo('<option selected value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$row['id'].'\')">'.$row['service_type_name'].'</option>');

                }else{
                    echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$row['id'].'\')">'.$row['service_type_name'].'</option>');
                }
            }
            ?>

        </select>
    </div>
    <div class="col-md-3">
        <select name='poc' >
            <?php
            echo('<option value="---" >----</option>');
            foreach($datay as $row) {
                if($poc_name == $row['poc_name']){
                    echo('<option selected="selected" value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$id.'/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');

                }else{
                    echo('<option value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'capman/result/'.$id.'/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');
                }
            }?>
        </select>

    </div>

    </div>
<?php
if(!empty($poc_name)){
?>
<form method="post" action="<?php echo base_url().'index.php/capman/do_insert'; ?> ">

    <div class="row" >
        <div class="col-md-12">
            <h4 class="page-header">List Service Path</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="datatable1" class="table table-bordered">
                <thead>
                <th>NE Name</th>
                <th>Weight</th>
                <th>Reserved</th>
                </thead>
                <tbody>
                <?php
                $no = 0;
                $resux = pg_query($conn, " SELECT *
  FROM raw_sources.capman_reserved where service_id =".$id)
                or die ("Query error!");
                while ($row = pg_fetch_array($resux)) {
                    echo("<tr>");

                    echo("<td>".$row['ne_name']."</td>");
                    echo("<td><input type='text' name='weight_".$no."' value='".$row['weight']."'></td>");
                    echo("<td> <input type='text' name='reserved_".$no."' value='".$row['reserved_value']."'><input type='hidden' name='ne_name_".$no."' value='".$row['id']."'></td> ");
                    echo("</tr>");
                    $no++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="pocc" value="<?php echo $poc_name?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="count" value="<?php echo $no-1; ?>">
    <div class="row" >
        <div class="side pull-right" style="margin-right: 10px;">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit" >Save </button>

            </div>
        </div>


    </div>
    </form>
<?php }?>