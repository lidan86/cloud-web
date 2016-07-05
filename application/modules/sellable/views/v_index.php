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


$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
	$api = $row->api;
}

$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Selleble?status=poc',false,$context);
$datay = json_decode($json,true);
//$rows=array();

$poc_name = str_replace('%20', ' ', $this->uri->segment(3));
$method = str_replace('%20', ' ', $this->uri->segment(4));
$years = str_replace('%20', ' ', $this->uri->segment(5));
$weeks = str_replace('%20', ' ', $this->uri->segment(6));
//  Scan through outer loop
//foreach ($datay as $innerArray) {
//  //  Check type
//
//    //  Scan through inner loop
//    foreach($innerArray as $key=>$val)
//    {
//      $rows[$key][]=$val;
//    }
//
//}
//$i = 0;
//foreach($rows as $header=>$row) // Grab the header names from each column
//{
// $z[$i] = $header;
//  $i++;
//}
//    echo("<table id='datatable' class='default'>");
//
//
//$i = 0;
//foreach($rows as $row)
//{
//  echo '<tr> ';
//  echo "<td>".$z[$i]."</td>";
//  foreach($row as $cell)
//  {
//    echo "<td>".$cell."</td>";
//  }
//  $i++;
//  echo '</tr>';
//}
//echo("</table>");

?>
<div class="row">
  <div class="col-md-9">
    <h4 class="page-header">Sellable Capacity</h4>
  </div>

</div>
<div class="row" >
  <div class="col-md-3">
    <h4>Poc Name:</h4>
    <select name='type' size='5'>
      <?php
      if($poc_name == 'all_poc'){
        echo('<option selected="selected" value="all_poc" onclick="javascript:location.replace(\''. base_url().'sellable/index/all_poc'.'\')">All POC</option>');

      }else{
        echo('<option  value="all_poc" onclick="javascript:location.replace(\''. base_url().'sellable/index/all_poc'.'\')">All POC</option>');

      }
      foreach($datay as $row) {
        if($poc_name == $row['poc_name']){
          echo('<option selected="selected" value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'sellable/index/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');

        }else{
        echo('<option value="'.$row['poc_name'].'" onclick="javascript:location.replace(\''. base_url().'sellable/index/'.$row['poc_name'].'\')">'.$row['poc_name'].'</option>');
       }
      }?>
    </select>

  </div>

  <?php
  if(!empty($poc_name)){

    ?>
    <div class="col-md-2">
      <h4>Method:</h4>
      <select name='type' size='5'>
        <?php
        if($method =='weekday'){
          echo('<option selected="selected" value="weekday" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekday/.\')">WeekDay</option>');
          echo('<option value="weekend" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekend/.\')">WeekEnd</option>');
          echo('<option value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/fullweeks/.\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/monthly/.\')">Monthly</option>');

        }elseif($method =='weekend' ){
          echo('<option  value="weekday" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekday/.\')">WeekDay</option>');
          echo('<option selected="selected" value="weekend" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekend/.\')">WeekEnd</option>');
          echo('<option value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/fullweeks/.\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/monthly/.\')">Monthly</option>');

        }elseif($method =='fullweeks' ){
          echo('<option  value="weekday" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekday/.\')">WeekDay</option>');
          echo('<option  value="weekend" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekend/.\')">WeekEnd</option>');
          echo('<option selected="selected" value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/fullweeks/.\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/monthly/.\')">Monthly</option>');

        }elseif($method =='monthly' ){
          echo('<option  value="weekday" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekday/.\')">WeekDay</option>');
          echo('<option  value="weekend" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekend/.\')">WeekEnd</option>');
          echo('<option  value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/fullweeks/.\')">Weekly</option>');
          echo('<option selected="selected" value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/monthly/.\')">Monthly</option>');

        }
        else {
          echo('<option value="weekday" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekday/.\')">WeekDay</option>');
          echo('<option value="weekend" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/weekend/.\')">WeekEnd</option>');
          echo('<option value="fullweek" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/fullweeks/.\')">Weekly</option>');
          echo('<option value="monthly" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/monthly/.\')">Monthly</option>');
        }?>
        </s
        ?>
      </select>

    </div>
  <?php }?>
  <?php
  if(!empty($poc_name)&&!empty($method)){

  ?>
  <div class="col-md-2">
    <h4>Year:</h4>
    <select name='type' size='5'>
      <?php
        for($x = 2015;$x<=2015;$x++){
        if($years == $x){
          echo('<option selected="selected" value="' . $x . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/'.$method.'/' . $x . '\')">' . $x . '</option>');

        }else {
          echo('<option value="' . $x . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/'.$method.'/' . $x . '\')">' . $x . '</option>');
        }
      } ?>
    </select>

  </div>
  <?php }?>
  <?php
  if(!empty($poc_name) &&!empty($method)&& !empty($years)){

    ?>
    <div class="col-md-2">

      <h4><?php if($method == 'monthly'){
          echo "Month";
        }else{
          echo "Week";
        }?>:</h4>
      <select name='type' size='5'>
        <?php
        if($method == 'monthly'){
          $json3 = file_get_contents($api.'CapmanApi/Selleble?status=param1',false,$context);
          $datap1 = json_decode($json3,true);
          foreach($datap1 as $row) {
            $z = $row['months'];
            if($weeks == $z) {
              echo('<option selected="selected" value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/' . $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');
            }else{
              echo('<option value="' . $z . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/' . $method . '/' . $years . '/' . $z . '\')">' . $z . '</option>');

            }
          }
        }else{
          $json4 = file_get_contents($api.'CapmanApi/Selleble?status=param2',false,$context);
          $datap2 = json_decode($json4,true);
          foreach($datap2 as $row) {
            $y = $row['weeks'];
            if($weeks == $y) {
              echo('<option selected="selected" value="' . $y . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/' . $method . '/' . $years . '/' . $y . '\')">' . $y . '</option>');
            }else{
              echo('<option value="' . $y . '" onclick="javascript:location.replace(\'' . base_url() . 'sellable/index/' . $poc_name . '/' . $method . '/' . $years . '/' . $y . '\')">' . $y . '</option>');

            }
          }
        }
        ?>
      </select>

    </div>
  <?php }?>
</div>
<?php
if(!empty($poc_name)&&!empty($method)&&!empty($years)&&!empty($weeks)) {
  ?>
    <br>
  <div class="row">
    <div class="col-md-4">
      <a class="btn btn-primary" download="sellable.csv" href="#" onclick="return ExcellentExport.csv(this, 'datatable8');">Export to CSV</a>
    </div>

  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
      if($poc_name == 'all_poc'){
        $sell = 'sellable_all';
      }else{
        $sell = 'sellable';
      }
      if($method == 'monthly'){
        if($poc_name == 'all_poc'){
          $json2 = file_get_contents($api.'CapmanApi/Selleble?status=sellable_all_monthly&id=monthly_all&poc_name='.urlencode($poc_name).'&years='.urlencode($years).'&months='.urlencode($weeks),false,$context);
          $result = json_decode($json2,true);

        }else{
        $json2 = file_get_contents($api.'CapmanApi/Selleble?status=sellable_monthly&id=monthly&poc_name='.urlencode($poc_name).'&years='.urlencode($years).'&months='.urlencode($weeks),false,$context);
        $result = json_decode($json2,true);
        }
      }
      else{
        $json2 = file_get_contents($api.'CapmanApi/Selleble?status='.urlencode($sell).'&id='.urlencode($method).'&poc_name='.urlencode($poc_name).'&years='.urlencode($years).'&weeks='.urlencode($weeks),false,$context);
        $result = json_decode($json2,true);
      }

      echo("<table id='datatable2' class='table table-bordered'>");
      echo("<thead  bgcolor='#E0E0E0'>");
      echo("<th nowrap='nowrap' align='center'>POC</th>");
      echo("<th nowrap='nowrap' align='center'>Full Capacity (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Capacity (80%) (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Current Traffic (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Sellable Capacity (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Sellable Capacity (%)</th>");
      echo("</thead>");
      echo("<tbody>");
      foreach ($result as $row) {

        echo("<tr>");
        echo("<td nowrap='nowrap' align='center'>" . $row['poc_name'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['capacity_100'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['capacity_80'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['current_traffic'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['sellable_capacity_100_TB'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . number_format($row['sellable_capacity_100']*100,2) . " %</td>");
        echo("</tr>");
      }
      echo("</tbody>");
      echo("</table>");
      echo("<table id='datatable8' class='table table-bordered' style='display: none;'>");
      echo("<thead  bgcolor='#E0E0E0'>");
      echo("<th nowrap='nowrap' align='center'>POC</th>");
      echo("<th nowrap='nowrap' align='center'>Full Capacity (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Capacity (80%) (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Current Traffic (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Sellable Capacity (TB)</th>");
      echo("<th nowrap='nowrap' align='center'>Sellable Capacity (%)</th>");
      echo("</thead>");
      echo("<tbody>");
      foreach ($result as $row) {

        echo("<tr>");
        echo("<td nowrap='nowrap' align='center'>" . $row['poc_name'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['capacity_100'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['capacity_80'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['current_traffic'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . $row['sellable_capacity_100_TB'] . "</td>");
        echo("<td nowrap='nowrap' align='center'>" . number_format($row['sellable_capacity_100']*100,2) . " %</td>");
        echo("</tr>");
      }
      echo("</tbody>");
      echo("</table>");
      ?>
    </div>

  </div>
<?php
}
  ?>