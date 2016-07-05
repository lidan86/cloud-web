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
$query = $this->db->query("select week,years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
  $weeks = $row->week;
  $years = $row->years;

}
$result = pg_query($conn, "select ne_name from utilgte80 where years=".$years." group by ne_name ")
or die ("Query error!");
$id = str_replace('%20', ' ', $this->uri->segment(3));

?>
<div class="row" style="padding-bottom: 10px;">
  <div class="col-md-6">
    <h4>Ne Name:</h4>
    <select name='type' size='5'>
      <?php
      while ($row = pg_fetch_array($result)) {
        echo('<option value="'.$row['ne_name'].'" onclick="javascript:location.replace(\''. base_url().'capbreaches/index/'.$row['ne_name'].'\')">'.$row['ne_name'].'</option>');
      } ?>
    </select>

  </div>
</div>
<?php
if(!empty($id)){
  $resckf = pg_query($conn, "select weeks, ne_name,max(utilization) as utilization from utilgte80 where years=".$years." and ne_name='".$id."'
group by ne_name, weeks order by weeks")
  or die ("Query error!");
  echo("<table id='datatable' style='display: none;' class='table table-bordered'>");
  echo("<thead>");
  echo("<tr bgcolor='#E0E0E0'>");
  echo("<td nowrap='nowrap'>Weeks</td>");
  echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
  echo("</tr>");
  echo("</thead><tbody>");
  while ($row = pg_fetch_array($resckf)) {
    echo("<tr>");
    echo("<td>".strval($row['weeks'])."</td>");
    echo("<td>".number_format($row['utilization'],2)."</td>");
    echo("</tr>");
  }
  echo("</tbody></table>");
  ?>
  <div class="row" >
    <div class="col-md-12">

      <input type="hidden" id="ne" value="<?php echo $id;?>">
      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
  </div>
<?php
}
?>