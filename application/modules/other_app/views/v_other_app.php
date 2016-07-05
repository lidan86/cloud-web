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
    $years = $row->years;

}
$result = pg_query($conn, "SELECT ne_name, max(trans) as trans, max(peak) as peak FROM public.view_other_apps where weeks = ".$weeks." and years = ".$years." group by ne_name")
or die ("Query error!");

?>
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

                echo("<tr>");
                echo('<td>'.$row['ne_name'].'</td>');
                echo('<td>'.number_format($row['trans']).'</td>');
                echo('<td>'.number_format($row['peak']).'</td>');
                echo('<td>'. number_format(($row['peak']/$row['trans'])*100,2).' </td>');
                echo('<td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="'.number_format(($row['peak']/$row['trans'])*100,2).'"></td>');
                echo("</tr>");

        }
        echo("</tbody></table>");?>

    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <table class="table table-bordered">
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="100"></td>
                <td>Warning</td>
                <td>>75%</td>
            </tr>
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="51"></td>
                <td>Alert</td>
                <td>50%-75%</td>
            </tr>
            <tr>
                <td class="styled"><meter min="0" max="100" low="50" high="75" optimum="100" value="20"></td>
                <td>Save</td>
                <td><50%</td>
            </tr>
        </table>
    </div>
</div>

