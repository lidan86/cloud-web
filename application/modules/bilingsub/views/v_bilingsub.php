<?php
error_reporting(0);
ini_set('displays_errors',0);
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
$result = pg_query($conn, "SELECT *  FROM public.view_target_subs where sources= 'XL' AND years =".$years)
or die ("Query error!");

while ($row = pg_fetch_array($result)) {
    $m['0'] = $row['m1'];
    $m['1'] = $row['m2'];
    $m['2'] = $row['m3'];
    $m['3'] = $row['m4'];
    $m['4'] = $row['m5'];
    $m['5'] = $row['m6'];
    $m['6'] = $row['m7'];
    $m['7'] =$row['m8'];
    $m['8'] = $row['m9'];
    $m['9'] = $row['m10'];
    $m['10'] =$row['m11'];
    $m['11'] = $row['m12'];


}
$res = pg_query($conn, "SELECT *  FROM public.view_target_subs where sources= 'AXIS' AND years =".$years)
or die ("Query error!");

while ($row = pg_fetch_array($res)) {
    $x['0'] = $row['m1'];
    $x['1'] = $row['m2'];
    $x['2'] = $row['m3'];
    $x['3'] = $row['m4'];
    $x['4'] = $row['m5'];
    $x['5'] = $row['m6'];
    $x['6'] = $row['m7'];
    $x['7'] =$row['m8'];
    $x['8'] = $row['m9'];
    $x['9'] = $row['m10'];
    $x['10'] =$row['m11'];
    $x['11'] = $row['m12'];


}
?>
<pre id="xl" style="display: none;">
<?php echo json_encode($m, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="axis" style="display: none;">
          <?php echo json_encode($x, JSON_NUMERIC_CHECK);?>
     </pre>

<div class="row" >
    <div class="col-md-12">


        <div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

    </div>
</div>