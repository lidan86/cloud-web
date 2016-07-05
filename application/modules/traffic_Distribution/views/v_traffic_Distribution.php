<?php
error_reporting(0);
ini_set('displays_errors',0);
$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->week;
    $years = $row->years;
    $from = $row->set1;
    $too = $row->set2;
    $cat_type = $row->cat_type;

}

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$w1 = $from -1;
// get data JSON
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));

$json3 = file_get_contents($api.'CapmanApi/RbiController?id=2GDATA&week='.$too.'&year='.$years ,false,$context);

$data3 = json_decode($json3,true);

$json = file_get_contents($api.'CapmanApi/RbiController?id=2GVOICE&week='.$too.'&year='.$years ,false,$context);

$data = json_decode($json,true);

$json2 = file_get_contents($api.'CapmanApi/RbiController?id=3GDATA&week='.$too.'&year='.$years ,false,$context);

$data2 = json_decode($json2,true);

$json4 = file_get_contents($api.'CapmanApi/RbiController?id=3GVOICE&week='.$too.'&year='.$years ,false,$context);

$data4 = json_decode($json4,true);

$json31 = file_get_contents($api.'CapmanApi/RbiController?id=2GDATA&week='.$from.'&year='.$years ,false,$context);

$data31 = json_decode($json31,true);

$json1 = file_get_contents($api.'CapmanApi/RbiController?id=2GVOICE&week='.$from.'&year='.$years ,false,$context);

$data1 = json_decode($json1,true);

$json21 = file_get_contents($api.'CapmanApi/RbiController?id=3GDATA&week='.$from.'&year='.$years ,false,$context);

$data21 = json_decode($json21,true);

$json41 = file_get_contents($api.'CapmanApi/RbiController?id=3GVOICE&week='.$from.'&year='.$years ,false,$context);

$data41 = json_decode($json41,true);

//if(!empty($data3) && !empty($data) && !empty($data2) && !empty($data4) && !empty($data31) && !empty($data1) && !empty($data21) && !empty($data41) ) {

    $a = max(array_map(function($element){return $element['hasil'];}, $data3));
    foreach ($data3 as $cek) {
        if ($cek['hasil'] == $a) {
            $f = $cek['dhour'];
        }
    }
    $b = array_sum(array_map(function($element){return $element['hasil'];}, $data3));
    $c = count($data3);
    $d = $a / ($b / $c);
    $e = number_format($b/$c,2);


    $a1 = max(array_map(function($element){return $element['hasil'];}, $data));
    foreach ($data as $cek) {
        if ($cek['hasil'] == $a1) {
            $f1 = $cek['dhour'];
        }
    }
    $b1 = array_sum(array_map(function($element){return $element['hasil'];}, $data));
    $c1 = count($data);
    $d1 = $a1 / ($b1 / $c1);
    $e1 = number_format($b1/$c1,2);

    $a2 = max(array_map(function($element){return $element['hasil'];}, $data2));
    foreach ($data2 as $cek) {
        if ($cek['hasil'] == $a2) {
            $f2 = $cek['dhour'];
        }
    }
    $b2 = array_sum(array_map(function($element){return $element['hasil'];}, $data2));
    $c2 = count($data2);
    $d2 = $a2 / ($b2 / $c2);
    $e2 = number_format($b2/$c2,2);

    $a4 = max(array_map(function($element){return $element['hasil'];}, $data4));

    foreach ($data4 as $cek) {
        if ($cek['hasil'] == $a4) {
            $f3 = $cek['dhour'];
        }
    }

    $b4 = array_sum(array_map(function($element){return $element['hasil'];}, $data4));
    $c4 = count($data4);
    $d4 = $a4 / ($b4 / $c4);
    $e4 = number_format($b4/$c4,2);
    $ax = max(array_map(function($element){return $element['hasil'];}, $data31));
    foreach ($data31 as $cek) {
        if ($cek['hasil'] == $ax) {
            $fx = $cek['dhour'];
        }
    }
    $bx = array_sum(array_map(function($element){return $element['hasil'];}, $data31));
    $cx = count($data31);
    $dx = $ax / ($bx / $cx);
    $ex = number_format($bx/$cx,2);

    $ax1 = max(array_map(function($element){return $element['hasil'];}, $data1));
    foreach ($data1 as $cek) {
        if ($cek['hasil'] == $ax1) {
            $fx1 = $cek['dhour'];
        }
    }
    $bx1 = array_sum(array_map(function($element){return $element['hasil'];}, $data1));
    $cx1 = count($data1);
    $dx1 = $ax1 / ($bx1 / $cx1);
    $ex1 = number_format($bx1/$cx1,2);

    $ax2 = max(array_map(function($element){return $element['hasil'];}, $data21));
    foreach ($data21 as $cek) {
        if ($cek['hasil'] == $ax2) {
            $fx2 = $cek['dhour'];
        }
    }
    $bx2 = array_sum(array_map(function($element){return $element['hasil'];}, $data21));
    $cx2 = count($data21);
    $dx2 = $ax2 / ($bx2 / $cx2);
    $ex2 = number_format($bx2/$cx2,2);

    $ax4 = max(array_map(function($element){return $element['hasil'];}, $data41));

    foreach ($data41 as $cek) {
        if ($cek['hasil'] == $ax4) {
            $fx3 = $cek['dhour'];
        }
    }

    $bx4 = array_sum(array_map(function($element){return $element['hasil'];}, $data41));
    $cx4 = count($data41);
    $dx4 = $ax4 / ($bx4 / $cx4);
    $ex4 = number_format($bx4/$cx4,2);



    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="block block-fill-white">
                        <h4 class="header">Week - <?php echo $from;?></h4>
                    </div>
                </div>
            </div>
            <?php if($cat_type == 2){ ?>

            <div id="container1" ></div>

        <?php }?>
        </div>

            <div class="col-md-6" >
                <div class="row">
                    <div class="col-sm-12">
                        <div class="block block-fill-white">
                            <h4 class="header">Week - <?php echo $too;?></h4>
                        </div>
                    </div>
                </div>

                <?php if($cat_type == 2){ ?>

                <div id="container" ></div>
                <?php }?>
        </div>
    </div>
    <input type="hidden" id="max" value="<?php echo $f;?>">
    <input type="hidden" id="max1" value="<?php echo $f1;?>">
    <input type="hidden" id="max2" value="<?php echo $f2;?>">
    <input type="hidden" id="max3" value="<?php echo $f3;?>">
    <input type="hidden" id="max4" value="<?php echo $fx;?>">
    <input type="hidden" id="max5" value="<?php echo $fx1;?>">
    <input type="hidden" id="max6" value="<?php echo $fx2;?>">
    <input type="hidden" id="max7" value="<?php echo $fx3;?>">

    <input type="hidden" id="avg" value="<?php echo $e;?>">
    <input type="hidden" id="avg1" value="<?php echo $e1;?>">
    <input type="hidden" id="avg2" value="<?php echo $e2;?>">
    <input type="hidden" id="avg3" value="<?php echo $e4;?>">
    <input type="hidden" id="avg4" value="<?php echo $ex;?>">
    <input type="hidden" id="avg5" value="<?php echo $ex1;?>">
    <input type="hidden" id="avg6" value="<?php echo $ex2;?>">
    <input type="hidden" id="avg7" value="<?php echo $ex4;?>">

    <input type="hidden" id="peak" value="<?php echo number_format($a,2);?>">
    <input type="hidden" id="peak1" value="<?php echo number_format($a1,2);?>">
    <input type="hidden" id="peak2" value="<?php echo number_format($a2,2);?>">
    <input type="hidden" id="peak3" value="<?php echo number_format($a4,2);?>">
    <input type="hidden" id="peak4" value="<?php echo number_format($ax,2);?>">
    <input type="hidden" id="peak5" value="<?php echo number_format($ax1,2);?>">
    <input type="hidden" id="peak6" value="<?php echo number_format($ax2,2);?>">
    <input type="hidden" id="peak7" value="<?php echo number_format($ax4,2 );?>">

    <input type="hidden" id="rbi1" value="<?php echo number_format($d, 2, '.', '');?>">
    <input type="hidden" id="rbi2" value="<?php echo number_format($d1, 2, '.', '');?>">
    <input type="hidden" id="rbi3" value="<?php echo number_format($d2, 2, '.', '');?>">
    <input type="hidden" id="rbi4" value="<?php echo number_format($d4, 2, '.', '');?>">
    <input type="hidden" id="rbi5" value="<?php echo number_format($dx, 2, '.', '');?>">
    <input type="hidden" id="rbi6" value="<?php echo number_format($dx1, 2, '.', '');?>">
    <input type="hidden" id="rbi7" value="<?php echo number_format($dx2, 2, '.', '');?>">
    <input type="hidden" id="rbi8" value="<?php echo number_format($dx4, 2, '.', '');?>">
    <?php


    echo("<table id='datatable' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data3 as $row) {
        echo("<tr>");
        echo("<td>" . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");
    echo("<table id='datatable1' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data31 as $row) {
        echo("<tr>");
        echo("<td>" . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");


    ?>
<?php if($cat_type == 3){ ?>
    <div class="row">
        <div class="col-md-6">


            <div id="containerx1" ></div>


        </div>
        <div class="col-md-6">

            <div id="containerx" ></div>

        </div>
    </div>
<?php }?>
    <?php


    echo("<table id='datatablex' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e1,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");
    echo("<table id='datatablex1' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data1 as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e1,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");


    ?>
<?php if($cat_type == 2) { ?>
    <div class="row">
        <div class="col-md-6">

            <div id="containerz1"></div>


        </div>
        <div class="col-md-6">

            <div id="containerz"></div>

        </div>
    </div>

<?php
}


    echo("<table id='datatablez' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data2 as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e2,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");
    echo("<table id='datatablez1' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data21 as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e2,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");


    ?>
<?php if($cat_type == 3) { ?>
    <div class="row">
        <div class="col-md-6">
            <div id="containery1"></div>


        </div>
        <div class="col-md-6">

            <div id="containery"></div>


        </div>
    </div>

<?php
}

    echo("<table id='datatabley' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data4 as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e2,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");
    echo("<table id='datatabley1' class='default' style='display:none;'>");
    echo("<tr bgcolor='#E0E0E0'>");
    echo("<td nowrap='nowrap'>Time</td>");

    echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Result</td>");
//echo("<td nowrap='nowrap'>Avarage</td>");
    echo("</tr>");
    foreach ($data41 as $row) {
        echo("<tr>");
        echo("<td> " . (string)$row['dhour'] . "</td>");
        echo("<td>" . number_format($row['hasil'], 2, '.', '') . "</td>");
//    echo("<td>" .number_format($e2,2, '.', ''). "</td>");
        echo("</tr>");
    }
    echo("</table>");


//}
?>
