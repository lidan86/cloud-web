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

$cob = pg_query($conn, "SELECT  ne_name, max(maxutil) as maxutil
  FROM public.view_weekly_installed_util where years= ".$years." and service_type like '%".$cat_type."%' group by years,ne_name order by years,ne_name
")
or die ("Query error!");
$coba = pg_query($conn, "SELECT years,  ne_name, avg(avgutil) as avgutil
  FROM public.view_weekly_utilization where years= ".$years." and
  service_type like '%".$cat_type."%' group by years, ne_name order by ne_name
")
or die ("Query error!");
$cobax = pg_query($conn, "SELECT years,  ne_name, avg(avgutil) as avgutil
  FROM public.view_weekly_traffic where years= ".$years." and
  service_type like '%".$cat_type."%' group by years, ne_name order by ne_name
")
or die ("Query error!");






     ?>
<input type="hidden" id="type" value="<?php echo $cat_type;?>">
    <div class="row">
         <div class="col-md-8">
             <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

         </div>
        <div class="col-md-4">

            <?php
            echo("<table id='datatable' class='table table-bordered'>");
            echo("<thead>");
            echo("<tr >");
            echo("<td nowrap='nowrap'>Ne Name</td>");
           echo("<td nowrap='nowrap'>Utilization</td>");
            echo("</tr>");
            echo("</thead><tbody>");
            while($row = pg_fetch_array($cob)){
                echo("<tr>");
                echo('<td nowrap="nowrap"><a class="btn-link"  href="javascript:location.replace(\''. base_url().'instaled/instal/'.$row['ne_name'].'\')">'.$row['ne_name'].'</a></td>');
                echo('<td nowrap="nowrap">'.$row['maxutil'].'</td>');
                echo("</tr>");
            }
            echo("</tbody></table>");?>

        </div>
     </div>
<div class="row">
    <div class="col-md-8">
        <div id="containerx" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
    <div class="col-md-4">

        <?php
        echo("<table id='datatable1' class='table table-bordered'>");
        echo("<thead>");
        echo("<tr >");
        echo("<td nowrap='nowrap'>Ne Name</td>");
        echo("<td nowrap='nowrap'>Utilization</td>");
        echo("</tr>");
        echo("</thead><tbody>");
        while($row = pg_fetch_array($coba)){
            echo("<tr>");
            echo('<td nowrap="nowrap"><a class="btn-link"  href="javascript:location.replace(\''. base_url().'instaled/util/'.$row['ne_name'].'\')">'.$row['ne_name'].'</a></td>');
            echo('<td nowrap="nowrap">'.$row['avgutil'].'</td>');
            echo("</tr>");
        }
        echo("</tbody></table>");?>

    </div>
</div>
    <div class="row">
        <div class="col-md-8">
            <div id="containery" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

        </div>
        <div class="col-md-4">

            <?php
            echo("<table id='datatable2' class='table table-bordered'>");
            echo("<thead>");
            echo("<tr >");
            echo("<td nowrap='nowrap'>Ne Name</td>");
            echo("<td nowrap='nowrap'>Traffic</td>");
            echo("</tr>");
            echo("</thead><tbody>");
            while($row = pg_fetch_array($cobax)){
                echo("<tr>");
                echo('<td nowrap="nowrap"><a class="btn-link"  href="javascript:location.replace(\''. base_url().'instaled/traffic/'.$row['ne_name'].'\')">'.$row['ne_name'].'</a></td>');
                echo('<td nowrap="nowrap">'.$row['avgutil'].'</td>');
                echo("</tr>");
            }
            echo("</tbody></table>");?>

        </div>

    </div>

