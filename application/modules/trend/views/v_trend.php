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
$conn = pg_pconnect($conn_string)
or die("Connection failed!");

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $data = $row->week;
    $years = $row->years;
    $from = $row->set1;
    $too = $row->set2;
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

     $res = pg_query($conn, "select avg(m1) as m1,avg(m2) as m2,avg(m3) as m3,avg(m4) as m4,avg(m5) as m5,avg(m6) as m6,avg(m7) as m7,avg(m8) as m8,avg(m9) as m9,avg(m10) as m10,avg(m11) as m11,avg(m12) as m12  from public.view_target_traffics where service_name like '%".$cat_type."%' and years =" . $years )
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

$cob = pg_query($conn, "SELECT service_type, avg(avgutil) as avgutil FROM public.view_weekly_utilization where years = ".$years." and service_type like '%".$cat_type."%' group by years, months, service_type")
or die ("Query error!");
$i =0;
while ($row = pg_fetch_array($cob)) {
    $x[$i] = floatval($row['avgutil']);
    $i++;
}


$c = $i -1;
$x1 = $x;
if($cat_type == 'Voice'){
    $slop = pg_query($conn, "SELECT service_type, avg(avgutil) as avgutil FROM public.view_weekly_utilization where years = ".$years." and service_type like '%".$cat_type."%' group by years, months, service_type")
    or die ("Query error!");

    while ($row = pg_fetch_array($slop)) {
        $x[] = floatval($row['avgutil']);

    }
    $initial = array_shift($x1);
//$da = number_format(array_reduce($x1, create_function('$op1,$op2','return $op1-=$op2;'), $initial),2);
//$da = abs($da);

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

    for ($w = 0; $w <= 11; $w++) {
        if ($w == $c) {
            $e = $e;

            $f[$w] = floatval($e);
        } elseif ($w > $c) {
            $e = $e * 2;

            $f[$w] = floatval($e);
        } else {
            $f[$w] = null;
            $e = $x[$i - 1];
        }

    }
    for ($g = 0; $g <= 11; $g++) {
        if ($g == $c) {
            $h = $h;

            $j[$g] = round(floatval($h), 2);
        } elseif ($g > $c) {
            $h =3*($h^2)-5*$h+4;

            $j[$g] = round(floatval($h), 2);
        } else {
            $j[$g] = null;
            $h = $x[$i - 1];
        }

    }

}


   


     ?>

<input type="hidden" id="type" value="<?php echo $cat_type;?>">
<pre id="plan" style="display: none;">
    <?php echo json_encode($m, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="actual" style="display: none;">
    <?php echo json_encode($x, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="linearx" style="display: none;">
    <?php echo json_encode($z, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="expo" style="display: none;">
    <?php echo json_encode($f, JSON_NUMERIC_CHECK);?>
</pre>
    <pre id="poly" style="display: none;">
    <?php echo json_encode($j, JSON_NUMERIC_CHECK);?>
</pre>

     <div class="row">
         <div class="col-md-12">
             <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

         </div>
     </div>
<div class="row">
    <div class="col-md-12">
        <div id="containerx" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="containery" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>

