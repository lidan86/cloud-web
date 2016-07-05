<?php
//
//error_reporting(0);
//ini_set('displays_errors',0);
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
$conn = pg_pconnect($conn_string)
or die("Connection failed!");

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row) {
    $from = $row->set1;
    $too = $row->set2;
    $years = $row->years;
    $cat_type = $row->cat_type;
}
if($cat_type ==1){
    $cat_type = 'SMS';

}elseif($cat_type == 2){
    $cat_type = 'Internet';

}else{
    $cat_type = 'Voice';
}

?>

<?php

$func = str_replace('%20', ' ', $this->uri->segment(2));
$ne_name = str_replace('%20', ' ', $this->uri->segment(3));
if($func == 'instal'){
    $coba = pg_query($conn, "SELECT  ne_name,weeks, max(maxutil) as maxutil
  FROM public.view_weekly_installed_util where years= ".$years." and service_type like '%".$cat_type."%' and ne_name ='".$ne_name."' group by years,weeks,ne_name order by years,weeks,ne_name
")
    or die ("Query error!");
    $bg = "Instaled Capacity By ".$ne_name;
}elseif($func == 'util'){
    $coba = pg_query($conn, "SELECT years,weeks,  ne_name, avg(avgutil) as avgutil
  FROM public.view_weekly_utilization where years= ".$years." and
  service_type like '%".$cat_type."%' and ne_name ='".$ne_name."' group by years,weeks,ne_name order by years,weeks,ne_name
")
    or die ("Query error!");
    $bg = "Current Utilization By ".$ne_name;
}else{
    $coba = pg_query($conn, "SELECT years,weeks,  ne_name, avg(avgutil) as avgutil
  FROM public.view_weekly_traffic where years= ".$years." and
  service_type like '%".$cat_type."%' and ne_name ='".$ne_name."' group by years,weeks,ne_name order by years,weeks,ne_name
")
    or die ("Query error!");
    $bg = "Capacity Used By ".$ne_name;

}



     ?>
<?php
echo("<table id='datatable3' class='table table-bordered' style='display: none;'>");
echo("<thead>");
echo("<tr >");
echo("<td nowrap='nowrap'>Ne Name</td>");
echo("<td nowrap='nowrap'>Utilization</td>");
echo("</tr>");
echo("</thead><tbody>");
while($row = pg_fetch_array($coba)){
    echo("<tr>");
    echo('<td nowrap="nowrap">Weeks -'.$row['weeks'].'</td>');
    echo('<td nowrap="nowrap">'.$row['maxutil'].'</td>');
    echo("</tr>");
}
echo("</tbody></table>");?>

<input type="hidden" id="type" value="<?php echo $cat_type;?>">
<input type="hidden" id="title" value="<?php echo $bg;?>">
    <div class="row">
         <div class="col-md-12">
             <div id="container2" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

         </div>

     </div>
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-info" href="<?php echo base_url();?>instaled"> Back</a>
        </div>
    </div>