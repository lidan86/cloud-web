<?php
$ne_name = str_replace('%20', ' ', $this->uri->segment(3));
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
$column = pg_query($conn, "SELECT table_name, column_name, ne_column_name
FROM master_data.view_master_formula where ne_name='".$ne_name."'")
or die ("Query error!");
print_r($column);
die();
while ($row = pg_fetch_array($column)) {
    $table_name = $row['table_name'];
    $column_name = $row['column_name'];
    $ne_column_name = $row['ne_column_name'];
}


?>
<input type="hidden" id="nename" value="<?php echo $ne_name; ?>">
<div class="row" style="display: none;">
    <div class="col-md-12">
        <table id="datatablex" class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">Ne Name</th>
                <th style="text-align: center">Utilization</th>

            </tr>
            </thead>
            <tbody >
				 <?php
$colum = pg_query($conn, "SELECT * FROM raw_sources.bowoTEST('".$table_name."','".$column_name."','".$ne_column_name."')
where (weeks >=".$weeks." and weeks <= ".$weeksto.")   and years =".$years)
    or die ("Query error!");
    while ($row = pg_fetch_array($colum)) {
       
                echo("<tr>");
                echo ("<td nowrap='nowrap'  align='center'>".$row['ne_name']."</td>");
                echo("<td nowrap='nowrap' align='center'>".number_format($row['avgutil'],2)."</td>");

               echo("</tr>");
           

            }


            ?>

           
            </tbody>
        </table>
    </div>
</div>
<div class="row" >
    <div class="col-md-12">

        <div id="container" style="min-width: 510px; max-width: 1000px; height: 1200px; margin: 0 auto"></div>

    </div>
</div>