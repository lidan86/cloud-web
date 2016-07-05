<?php

error_reporting(0);
ini_set('displays_errors',0);
$user = $this->session->userdata('username');
$query = $this->db->query("select week, years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
	$data = $row->week;
	$datax = $row->years;

}


//$rows=array();
$poc_name = str_replace('%20', ' ', $this->uri->segment(3));
$method = str_replace('%20', ' ', $this->uri->segment(4));
$years = str_replace('%20', ' ', $this->uri->segment(5));
$weeks = str_replace('%20', ' ', $this->uri->segment(6));
$weeksto = str_replace('%20', ' ', $this->uri->segment(7));

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
  $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json8 = file_get_contents($api.'CapmanApi/Selleble?status=poc',false,$context);
$datay = json_decode($json8,true);
if(!empty($weeksto) && $method == 'fullweeks' ){
  $json = file_get_contents($api.'CapmanApi/Selleble?status=periode&id=fullweeks&weeksfrom='.$weeks.'&weeksto='.$weeksto.'&years='.$years.'&poc_name='.$poc_name ,false,$context);
  $data = json_decode($json,true);

  $i = 0;
  foreach($data as $row){
    $a[$i] = $row['capacity_100'];
    $b[$i] = $row['current_traffic'];
    $c[$i] = $row['sellable_capacity_100_TB'];
    $d[$i] = strval($row['weeks']);
    $i++;
  }
}elseif(!empty($weeksto) && $method == 'monthly'){
  $json = file_get_contents($api.'CapmanApi/Selleble?status=periode&id=monthly&monthsfrom='.$weeks.'&monthsto='.$weeksto.'&years='.$years.'&poc_name='.$poc_name ,false,$context);
  $data = json_decode($json,true);

  $i = 0;
  foreach($data as $row){
    $a[$i] = $row['capacity_100'];
    $b[$i] = $row['current_traffic'];
    $c[$i] = $row['sellable_capacity_100_TB'];
    $d[$i] = strval($row['months']);
    $i++;
  }
}



?>
<pre id="time" style="display: none;">
    <?php echo json_encode($d);?>
</pre>
<pre id="capacity" style="display: none;">
    <?php echo json_encode($a, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="current" style="display: none;">
    <?php echo json_encode($b, JSON_NUMERIC_CHECK);?>
</pre>
<pre id="sellable" style="display: none;">
    <?php echo json_encode($c, JSON_NUMERIC_CHECK);?>
</pre>
<div class="row">
  <div class="col-md-9">
    <h4 class="page-header">Sellable Capacity</h4>
  </div>

</div>
<div class="row" >
  <div class="col-md-3">
    <h4>Poc Name:</h4>
    <select name='type' size="4">
      <?php
      echo('<option value="---" >---</option>');

      foreach($datay as $row) {
        if($poc_name == $row['poc_name']){
          echo('<option selected="selected" value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'sellable/trend/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');

        }else{
          echo('<option value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'sellable/trend/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');
        }
      }?>
    </select>

  </div>
  <?php
  if(!empty($poc_name)){
    ?>

    <div class="col-md-2">
      <h4>Method:</h4>
      <select name='type' size="4">
        <?php
        echo('<option value="---" >---</option>');

        if($method =='fullweeks'){
          echo('<option selected="selected" value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/fullweeks\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/monthly\')">Monthly</option>');


        }elseif($method =='monthly' ){
          echo('<option value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/fullweeks\')">Weekly</option>');
          echo('<option selected="selected" value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/monthly\')">Monthly</option>');

        }
        else {
          echo('<option value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/fullweeks\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/'.$poc_name.'/monthly\')">Monthly</option>');
        }?>
      </select>

      </select>

    </div>

  <?php

  }
  if(!empty($method)){

  ?>
  <div class="col-md-2">
    <h4>Year:</h4>
    <select name='type' size="4" >
      <?php
      echo('<option value="---" >---</option>');

      for($x = 2015;$x<=2015;$x++){
        if($years == $x){
          echo('<option selected="selected" value="' . $x . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/' .$method.'/' . $x . '\')">' . $x . '</option>');

        }else {
          echo('<option value="' . $x . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/'.$method.'/' . $x . '\')">' . $x . '</option>');
        }
      } ?>
    </select>

  </div>
  <?php }?>
  <?php
  if(!empty($method)&& !empty($years)){
    if($method == 'monthly'){
    ?>
      <div class="col-md-2">

        <h4>Monthly From:</h4>
        <select name='type' size="4">
          <?php
          echo('<option value="---" >---</option>');

          for($z = 1; $z <= 12;$z++) {

            if($weeks == $z) {
              echo('<option selected="selected" value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/'  . $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');
            }else{
              echo('<option value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/'. $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');

            }
          }?>
        </select>
      </div>
     <?php
      if(!empty($weeks)){?>
        <div class="col-md-2">

          <h4>Monthly To:</h4>
          <select name='type' size="4">
            <?php
            echo('<option value="---" >---</option>');

            for($z = $weeks+1; $z <= 12;$z++) {

              if($weeksto == $z) {
                echo('<option selected="selected" value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/'  . $method . '/' . $years . '/' . $weeks . '/' . $z . '\')">' . $z . '</option>');
              }else{
                echo('<option value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/'. $method . '/' . $years . '/' . $weeks . '/' .$z . '\')">' . $z . '</option>');

              }
            }?>
          </select>
        </div>
     <?php }
    }else {
      ?>
      <div class="col-md-2">

        <h4>Weekly From:</h4>
        <select name='type' size="4">
          <?php
          echo('<option value="---" >---</option>');

          for ($z = 1; $z <= 52; $z++) {

            if ($weeks == $z) {
              echo('<option selected="selected" value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/' . $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');
            } else {
              echo('<option value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/' . $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');

            }
          }?>
        </select>
      </div>
      <?php
      if (!empty($weeks)) {
        ?>
        <div class="col-md-2">

          <h4>Weekly To:</h4>
          <select name='type' size="4">
            <?php
            echo('<option value="---" >---</option>');

            for ($z = $weeks + 1; $z <= 52; $z++) {

              if ($weeksto == $z) {
                echo('<option selected="selected" value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/' . $method . '/' . $years . '/' . $weeks . '/' . $z . '\')">' . $z . '</option>');
              } else {
                echo('<option value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/trend/' .$poc_name.'/' . $method . '/' . $years . '/' . $weeks . '/' . $z . '\')">' . $z . '</option>');

              }
            }?>
          </select>
        </div>
      <?php }
    }
  }?>

</div>
<div class="row">
  <div class="col-md-12">
    <?php
    if(!empty($weeksto)){
      ?>
      <div id="container" style="min-width: 510px; max-width: 1000px; height: 1200px; margin: 0 auto"></div>

    <?php

    }
    ?>
  </div>
</div>
