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
$conn = pg_connect($conn_string)
or die("Connection failed!");
$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $weeksto = $row->set2;
    $years = $row->years;

}
?>
<div class="row"><!-- Related Projects Row -->
    <div class="col-lg-12">
        <h3 class="page-headerer" id="">Capacity Dashboard </h3>
    </div>
</div>


<div class="row"><!-- Related Projects Row -->
    <div class="col-md-12">
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/1");?>">2G BSC</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/2");?>">3G RNC</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/3");?>">Voice</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/4");?>">Data Core</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/5");?>">IT DS Core</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/6");?>">Upstream</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/7");?>">Vas</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/8");?>">SMS</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."dashboard/");?>">RAN Utilization</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."billing/");?>">Billing</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."soa_r/");?>">SOA/R</a>
        <a class="btn btn-primary" href="<?php echo(base_url()."other_app/");?>">Other APP</a>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h4 class="page-header">SOAR Week <?php echo $weeks;?> - <?php echo $weeksto;?> <?php echo $years;?> </h4>
    </div>

</div>

<div class="row" >
    <div class="col-md-12" >
        <div class="block block-fill-white">
            <div class="content">
                <table  class="table table-bordered" id="entrydata">
                    <thead>
                    <tr>
                        <th style="text-align: center">CKF</th>
                        <th style="text-align: center">Expected Peak</th>
                        <th style="text-align: center">Actual Peak</th>
                        <th style="text-align: center">% Utilization</th>
                        <th style="text-align: center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $colum = pg_query($conn, "SELECT avg(soa_bandung) as soa_bandung  , avg(soar) as soar , avg(soa_bintaro) as soa_bintaro
  FROM raw_sources.it_reporting where (weeks >= ".$weeks." and weeks <= ".$weeksto.")and years =".$years." group by years")
                    or die ("Query error!");
                    while ($row = pg_fetch_array($colum)) {

                        echo("<tr>");
                        echo ("<td nowrap='nowrap'  align='center'>SOA Bandung</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(56000000,2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format($row['soa_bandung'],2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(($row['soa_bandung']/56000000)*100,2)."</td>");
                        echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['soa_bandung']/56000000)*100 ."'></meter></td>");
                        echo("</tr>");

                        echo("<tr>");
                        echo ("<td nowrap='nowrap'  align='center'>SOAR</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(1080000,2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format($row['soar'],2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(($row['soar']/1080000)*100,2)."</td>");
                        echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['soar']/1080000)*100 ."'></meter></td>");
                        echo("</tr>");

                        echo("<tr>");
                        echo ("<td nowrap='nowrap'  align='center'>SOA Bintaro</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(1080000,2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format($row['soa_bintaro'],2)."</td>");
                        echo("<td nowrap='nowrap' align='center'>".number_format(($row['soa_bintaro']/56000000)*100,2)."</td>");
                        echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['soa_bintaro']/56000000)*100 ."'></meter></td>");
                        echo("</tr>");
                    }


                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<?php

$data3   = pg_query($conn, "select server,max(max) as max from raw_sources.view_all_soar
where (weeks >= ".$weeks." and weeks <= ".$weeksto.") and ckf='CPU'
 and years = ".$years." group by weeks,server ")
or die ("Query error!");


?>

<div class="row" >
    <div class="col-md-12">

        <div id="container" style="min-width: 510px; max-width: 1000px; height: 500px; margin: 0 auto"></div>

    </div>
</div>

<?php


echo("<table id='datatablex' class='default' style='display: none'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");

echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
echo("</tr>");
if(!empty($data3)) {
    while ($row = pg_fetch_array($data3)) {
        echo("<tr>");
        echo("<td>" . str_replace('-FullCPUUsage', ' ', $row['server']) . "</td>");
        echo("<td>" . $row['max'] . "</td>");

        echo("</tr>");
    }
}
echo("</table>");


?>

<?php

$data2   = pg_query($conn, " select server,max(max) as max from raw_sources.view_all_soar
where (weeks >= ".$weeks." and weeks <= ".$weeksto.")
 and years = ".$years." and ckf='MEMORY'
 group by weeks,server ")
or die ("Query error!");


?>

<div class="row" >
    <div class="col-md-12">

        <div id="container2" style="min-width: 510px; max-width: 1000px; height: 500px; margin: 0 auto"></div>

    </div>
</div>

<?php


echo("<table id='datatable' class='default' style='display: none'>");
echo("<tr bgcolor='#E0E0E0'>");
echo("<td nowrap='nowrap'>Services Type</td>");

echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
echo("</tr>");
if(!empty($data2)) {
    while ($row = pg_fetch_array($data2)) {
        echo("<tr>");
        echo("<td>" . str_replace('- Memory Usage', ' ', $row['server']) . "</td>");
        echo("<td>" . $row['max'] . "</td>");

        echo("</tr>");
    }
}
echo("</table>");


?>
