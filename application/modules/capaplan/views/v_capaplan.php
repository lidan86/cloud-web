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
$conn = pg_pconnect($conn_string)
or die("Connection failed!");


$user = $this->session->userdata('username');
$query = $this->db->query("select week, years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $data = $row->week;
    $datax = $row->years;

}
?>

<?php
$res = pg_query($conn, "select avg(m1) as m1,avg(m2) as m2,avg(m3) as m3,avg(m4) as m4,avg(m5) as m5,avg(m6) as m6,avg(m7) as m7,avg(m8) as m8,avg(m9) as m9,avg(m10) as m10,avg(m11) as m11,avg(m12) as m12  from public.view_target_traffics where service_name like '%Voice Peak%' and years =" . $datax )
or die ("Query error!");


while ($row = pg_fetch_array($res)) {
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

$cob = pg_query($conn, "select max(avg_traffic) as max from view_actual_traffic where years = ".$datax." group by months ")
or die ("Query error!");
$i =0;

while ($row = pg_fetch_array($cob)) {
    $x[$i] = floatval($row['max']);
    $i++;
}
$l = $x[0];
$c = $i -1;
$x1 = $x;
$initial = array_shift($x1);
$da = number_format($x[$c] - $x[$c-1],2) ;
$da = abs($da);
for($y = 0; $y<=11;$y++) {
    if ($y == $c) {
        $b = $b;

        $z[$y] = number_format($b, 2);
    } elseif ($y > $c) {
        $b = $b + $da;

        $z[$y] = number_format($b, 2);
    } else {
        $z[$y] = null;
        $b = $x[$i - 1];
    }
}
$coba = pg_query($conn, "select months, sum(total_voice) as total_voice
from carf_projections where years = ".$datax."
group by months,priority
order by months")
or die ("Query error!");
$k = 0;
while ($row = pg_fetch_array($coba)) {
    $w[$k] = floatval($row['total_voice']);

    $k++;
}
$k1 = $k -1;
for($w2 = 0;$w2 <= 11; $w2++){

    if($w2 <= $k1){

        $w3[$w2] = $w[$w2];
    }
    else{
        $w3[$w2] = null;

    }

}

?>
<input type="hidden" id="min" value="<?php echo $l;?>">
<pre id="plan" style="display: none;">
    <?php echo json_encode($m, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="actual" style="display: none;">
          <?php echo json_encode($x, JSON_NUMERIC_CHECK);?>
     </pre>
<pre id="linearx" style="display: none;">
    <?php echo json_encode($z, JSON_NUMERIC_CHECK);?>
</pre>

<div class="row">
    <div class="col-md-12">
        <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>

