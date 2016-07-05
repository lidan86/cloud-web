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
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $weeksto = $row->set2;
    $years = $row->years;

}
$result = pg_query($conn, "SELECT * FROM master_data.master_expected where remarks in('umb','xbox','mobile_app','idex','m_ads_lba')")
or die ("Query error!");

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
        <h4 class="page-header">Other APP Week <?php echo $weeks;?> - <?php echo $weeksto;?> <?php echo $years;?> </h4>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <?php
        echo("<table id='datatable' class='table table-bordered'>");
        echo("<thead>");
        echo("<tr>");
        echo("<td>System</td><td>Installed THP</td><td >Peak THP</td><td>%Capacity Utilization at Peak Hour</td><td>Status</td>");

        echo("</tr>");
        echo("</thead><tbody>");

        while ($row = pg_fetch_array($result)) {

            $resultx = pg_query($conn, "SELECT avg(umb) as umb, avg(xbox) as xbox,
       avg (mobile_app) as mobile_app, avg(idex) as idex, avg(m_ads_lba) as m_ads_lba, avg(m_ads_sofialys) as m_ads_sofialys
  FROM raw_sources.it_reporting where (weeks >= ".$weeks." and weeks <= ".$weeksto.")and years =".$years." group by years")
            or die ("Query error!");
            while ($row2 = pg_fetch_array($resultx)) {
                echo("<tr>");
                echo('<td>'.$row['remarks'].'</td>');
                echo('<td>'.number_format($row['expected_peak']).'</td>');
                echo('<td>'.number_format($row2[$row['remarks']]).'</td>');
                echo('<td>'. number_format(($row2[$row['remarks']]/$row['expected_peak'])*100,2).' </td>');
                echo('<td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="'.number_format(($row2[$row['remarks']]/$row['expected_peak'])*100,2).'"></td>');
                echo("</tr>");
            }

        }
        echo("</tbody></table>");?>

    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <table class="table table-bordered">
            <tr>
                <td style="background-color: red"></td>
                <td>Warning</td>
                <td>>75%</td>
            </tr>
            <tr>
                <td style="background-color: #ffff00"><meter min="0" max="100" low="50" high="75" optimum="100" value="51"></td>
                <td>Alert</td>
                <td>50%-75%</td>
            </tr>
            <tr>
                <td style="background-color: green"><meter min="0" max="100" low="50" high="75" optimum="100" value="40"></td>
                <td>Save</td>
                <td><50%</td>
            </tr>
        </table>
    </div>
</div>

