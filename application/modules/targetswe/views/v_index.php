<?php
//error_reporting(0);
//ini_set('displays_errors',0);
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
$json = file_get_contents($api.'CapmanApi/TargetSweApi?years='.$datax,false,$context);
$datay = json_decode($json,true);

  //Scan through outer loop
foreach ($datay as $innerArray) {

  //  Check type

    //  Scan through inner loop
    foreach($innerArray as $key=>$val)
    {
      $rows[$key][]=$val;
    }

}
$i = 0;
foreach($rows as $header=>$row) // Grab the header names from each column
{
 $z[$i] = $header;
  $i++;
}
    echo("<table id='datatable' style='display:none;' class='default'>");


$i = 0;
foreach($rows as $row)
{
  echo '<tr> ';
  echo "<td>".$z[$i]."</td>";
  foreach($row as $cell)
  {
    echo "<td>".$cell."</td>";
  }
  $i++;
  echo '</tr>';
}
echo("</table>");

?>


<div class="row" >
    <div class="col-md-12">


        <div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

    </div>
</div>