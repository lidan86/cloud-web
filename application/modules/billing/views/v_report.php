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
        <h4 class="page-header">Billing Week <?php echo $weeks;?> - <?php echo $weeksto;?> <?php echo $years;?> </h4>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <table id="table-sparkline" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">System</th>
                <th style="text-align: center">Installed THP</th>
                <th style="text-align: center">Peak THP</th>
                <th style="text-align: center">%Capacity Utilization at Peak Hour</th>
                <th style="text-align: center">Status</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <?php
            $colum = pg_query($conn, "SELECT avg(billing_subscribers) as billing_subscribers,
       avg(billing_tps) as billing_tps, avg(performance_indicator) as performance_indicator
  FROM raw_sources.it_reporting where (weeks >= ".$weeks." and weeks <= ".$weeksto.")and years =".$years." group by years")
            or die ("Query error!");
            while ($row = pg_fetch_array($colum)) {

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>BILLING SUBSCRIBERS</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(83000000,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['billing_subscribers'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['billing_subscribers']/83000000)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['billing_subscribers']/83000000)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>BILLING TPS</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(170000,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['billing_tps'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['billing_tps']/170000)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['billing_tps']/170000)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>PI (PERFORMANCE INDICATOR)</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(20,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['performance_indicator'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['performance_indicator']/20)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['performance_indicator']/20)*100 ."'></meter></td>");
                echo("</tr>");
            }


            ?>


            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="table-sparkline" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">System</th>
                <th style="text-align: center">Installed THP</th>
                <th style="text-align: center">Peak THP</th>
                <th style="text-align: center">%Capacity Utilization at Peak Hour</th>
                <th style="text-align: center">Status</th>
            </tr>
            </thead>
            <tbody id="tbody-sparkline">
            <?php
            $columc = pg_query($conn, "SELECT avg(crm) as crm, avg(cm) as cm, avg(aam) as aam, avg(rpl) as rpl, avg(es) as es, avg(aprm) as aprm
  FROM raw_sources.it_reporting where (weeks >= ".$weeks." and weeks <= ".$weeksto.")and years =".$years." group by years")
            or die ("Query error!");
            while ($row = pg_fetch_array($columc)) {

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>CRM</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(5000,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['crm'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['crm']/5000)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['crm']/5000)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>CM</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(1900700,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['cm'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['cm']/1900700)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['cm']/1900700)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>AAM</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(479354,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['aam'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['aam']/479354)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['aam']/479354)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>RPL</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(1659256,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['rpl'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['rpl']/1659256)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['rpl']/1659256)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>ES</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(612000000,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['es'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['es']/612000000)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['es']/612000000)*100 ."'></meter></td>");
                echo("</tr>");

                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>APRM</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(125000000,2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['aprm'],2)."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format(($row['aprm']/125000000)*100,2)."</td>");
                echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='".($row['aprm']/125000000)*100 ."'></meter></td>");
                echo("</tr>");
            }


            ?>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table-bordered">
            <tr>
                <td style="background-color: red"></td>
                <td>Warning</td>
                <td>>75%</td>
            </tr>
            <tr>
                <td style="background-color: #ffff00"></td>
                <td>Alert</td>
                <td>50%-75%</td>
            </tr>
            <tr>
                <td style="background-color: green"></td>
                <td>Save</td>
                <td><50%</td>
            </tr>
        </table>
    </div>
</div>
