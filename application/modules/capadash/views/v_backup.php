<?php

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $years = $row->years;
    $from = $row->set1;
    $too = $row->set2;
    $cat_type = $row->cat_type;


}

$queryx = $this->db->query("select * from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
    $ip_post = $row->ip_post;
    $port_post = $row->port_post;
    $db_post = $row->db_post;
    $user_post = $row->user_post;
    $pass_post = $row->pass_post;
}
$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
$conn = pg_connect($conn_string)
or die("Connection failed!");
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','protocol_version' => '1.0','method' => 'GET')));
//$json = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("BSS 2G BSC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$resbss = json_decode($json,true);
//
//$json1 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("BSS 3G RNC").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$rnc = json_decode($json1,true);
//
//$json2 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("Radio Access Network").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$voice = json_decode($json2,true);
//
//$json3 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("Core Network (PS & CS Core)").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$datacore = json_decode($json3,true);
//
//$json4 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("Data Services").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$itds = json_decode($json4,true);
//
//$json5 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("VAS Systems").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$vas = json_decode($json5,true);
//
//$json6 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("UPSTREAM").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$upstream = json_decode($json6,true);
//
//$json7 = file_get_contents($api.'CapmanApi/Capdash?ne_group='. urlencode("SMS").'&weeksfrom='.$from.'&weeksto='.$too.'&years='.$years,false,$context);
//$sms = json_decode($json7,true);

?>
<input type="hidden" id="base" value="<?php echo base_url(); ?>">
<div class="row"><!-- Related Projects Row -->
    <div class="col-lg-12">
        <h3 class="page-headerer" id="">Capacity Dashboard </h3>
    </div>
</div>


<div class="row"><!-- Related Projects Row -->
    <div class="col-md-12">
        <div class="block" >
            <ul class="nav nav-tabs">
                <li><a class="btn-link" href="#" <?php echo('onclick="javascript:location.replace(\''. base_url().'capadash/service'.'\')"'); ?>>2G BSC</a></li>
                <li><a class="btn-link" href="#tabs-2" data-toggle=tab>3G RNC</a></li>
                <li><a class="btn-link" href="#tabs-3" data-toggle=tab>Voice </a></li>
                <li><a class="btn-link" href="#tabs-4" data-toggle=tab>Data Core </a></li>
                <li><a class="btn-link" href="#tabs-5" data-toggle=tab>IT DS Core </a></li>
                <li><a class="btn-link" href="#tabs-6" data-toggle=tab>Upstream </a></li>
                <li><a class="btn-link" href="#tabs-7" data-toggle=tab>VAS </a></li>
                <li><a class="btn-link" href="#tabs-8" data-toggle=tab>SMS </a></li>

            </ul>
            <div class="content tab-content">
                <div class=tab-pane id="tabs-1">
                    <div class="row" id="table-1">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($resbss as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }

                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }
                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo("<a class='btn btn_link' href='".base_url()."capadash/drill/".$row['ne_name']."'>".$row['ne_name']."</a>"); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>

                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-info" onclick="PrintElem('table-1')">test</button>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-2">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($rnc as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }

                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo("<a class='btn btn_link' href='".base_url()."capadash/drill/".$row['ne_name']."'>".$row['ne_name']."</a>"); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>

                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>

                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-3">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($voice as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }

                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-4">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($datacore as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }
                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-5">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($itds as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }
                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>

                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-6">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($upstream as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }

                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }
                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>

                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-7">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($vas as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }

                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>

                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class=tab-pane id="tabs-8">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="datatable">
                                <tr>
                                    <td style="text-align: center;">NE</td>
                                    <td style="text-align: center;">Utilization</td>
                                    <td style="text-align: center;">Business</td>
                                    <td style="text-align: center;">Network</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach($sms as $row ) {
                                    if (($i % 2) == 0) {
                                        $bg = "#FFF";
                                    } else {
                                        $bg = "#D0D0D0";
                                    }
                                    if ($row['util'] > 0 && $row['util'] < 50.1) {
                                        $bgi = "green";
                                        $fc = "#FFFFFF";
                                    }
                                    if ($row['util'] > 50.1 && $row['util'] < 75.1) {
                                        $bgi = "orange";
                                        $fc = "#000000;";
                                    }
                                    if ($row['util'] > 75.1 && $row['util'] <= 100) {
                                        $bgi = "red";
                                        $fc = "#FFFFFF";
                                    }

                                    $jsonx[$i] = file_get_contents($api . 'CapmanApi/Command?ne_id=' . $row['ne_id'] . '&weeks=' . $weeks . '&years=' . $years, false, $context);

                                    $rescob[$i] = json_decode($jsonx[$i], true);


                                    if(!empty($rescob[$i])){
                                        foreach($rescob[$i] as $rowcom){
                                            $rowcom['util_comments'];
                                            $rowcom['business_comments'];
                                            $rowcom['network_comments'];
                                            $rowcom['util_img'] ;
                                            $rowcom['bussiness_img'] ;
                                            $rowcom['network_img'] ;
                                        }
                                    }else{

                                        $rowcom['util_comments'] ='';
                                        $rowcom['business_comments']='';
                                        $rowcom['network_comments']='';
                                        $rowcom['util_img'] = 'green';
                                        $rowcom['bussiness_img'] = 'green' ;
                                        $rowcom['network_img'] = 'triangle';

                                    }

                                    $i++;

                                    ?>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
                                        <td class="<?php echo $bgi; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"><font
                                                color="<?php echo($fc) ?>"><?php echo(number_format($row['util'], 2)); ?></font>
                                        </td>
                                        <td class="<?php echo $rowcom['bussiness_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                        <td class="<?php echo $rowcom['network_img']; ?>"
                                            style=" width : 25%;  text-align: center; vertical-align: middle"></td>
                                    </tr>
                                    <tr bgcolor="<?php echo($bg); ?>">
                                        <td style=" width : 25%;">Over Utilization</td>
                                        <td class="styled" style=" width : 25%;">
                                            <meter min="0" max="100" low="50" high="75" optimum="100"
                                                   value="<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>"></meter>
                                            &nbsp;<?php echo(number_format($row['util'] / 100 * $row['gte'], 2)); ?>%
                                        </td>
                                        <td style=" width : 25%;"></td>
                                        <td style=" width : 25%;"></td>
                                    </tr>
                                    <form action="<?php echo base_url() . 'index.php/capadash/do_insert'; ?>" method="post">
                                        <tr bgcolor="<?php echo($bg); ?>">
                                            <input type="hidden" name="ne_id" value="<?php echo($row['ne_id']); ?>">
                                            <input type="hidden" name="weeks" value="<?php echo $weeks; ?>">
                                            <input type="hidden" name="years" value="<?php echo $years; ?>">
                                            <input type="hidden" name="ne_name" value="<?php echo($row['ne_name']); ?>">
                                            <td style=" width : 25%;  text-align: center; vertical-align: middle">
                                                Comments<br>
                                                <?php
                                                if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])){
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
                                                }else{
                                                    echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Save">');


                                                }
                                                ?>
                                            </td>


                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="utilComment" cols="25"
                                                              rows="3"><?php echo($rowcom['util_comments']);?></textarea>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="businessComment" cols="25"
                                                              rows="3"><?php echo($rowcom['business_comments']);?></textarea>
                                                <br>
                                                <select name="business_img">
                                                    <option value="green">---</option>
                                                    <option value="green">Green</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="red">Red</option>

                                                </select>
                                            </td>
                                            <td style=" width : 25%; text-align: center; vertical-align: middle">
													<textarea style="background-color:<?php echo($bg);?> !important;"
                                                              name="networkComment" cols="25"
                                                              rows="3"><?php echo($rowcom['network_comments']);?></textarea>
                                                <br>
                                                <select name="network_img">
                                                    <option value="triangle">---</option>
                                                    <option value="triangle">Triangle</option>
                                                    <option value="yellowtriangle">Orange Triangle</option>
                                                    <option value="warningtriangle">Warning Triangle</option>
                                                    <option value="redtriangle">Red Triangle</option>

                                                </select>
                                            </td>

                                        </tr>
                                    </form>
                                    <?php
                                    unset($rowcom);


                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

