<?php
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
$conn = pg_pconnect($conn_string)
or die("Connection failed!");
$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
	$weeks = $row->set1;
	$weeksto = $row->set2;
	$years = $row->years;


}

$table_name = str_replace('%20', ' ', $this->uri->segment(3));
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));

$json = file_get_contents($api.'CapmanApi/Service',false,$context);

$datay = json_decode($json,true);



?>
	<div class="row"><!-- Related Projects Row -->
		<div class="col-lg-12">
			<h3 class="page-headerer" id="">Capacity Dashboard </h3>
		</div>
	</div>


	<div class="row"><!-- Related Projects Row -->
		<div class="col-md-12">
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/1");?>">2G BSC</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/2");?>">3G RNC</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/3");?>">Voice</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/4");?>">Data Core</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/5");?>">IT DS Core</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/6");?>">Upstream</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/7");?>">Vas</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/view/8");?>">SMS</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."dashboard/");?>">RAN Utilization</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."billing/");?>">Billing</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."soa_r/");?>">SOA/R</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."other_app/");?>">Other APP</a>
		</div>
	</div>
<div class="row">
	<div class="col-md-6">
		<h3 class="page-header">RAN Utilization</h3>
	</div>

</div>
	<div class="row"><!-- Portfolio Item Row -->
		<div class="col-md-3">
			<select class="form-control" id="ne_id" name="ne_id" size="4">
				<?php
				foreach($datay as $row){

						echo('<option value="'.$row['service_type'].'" onclick="javascript:location.replace(\''. base_url().'dashboard/index/'.$row['service_type'].'\')">'.$row['service_type'].'</option>');

				}
				?>

			</select>
		</div>
	</div>

<?php if(!empty($table_name)){

?>
<div class="row">
	<div class="col-md-12">
		<table id="datatable1" class="table table-bordered">
			<thead>
			<th style="text-align: center">NE Name</th>
			<th style="text-align: center">Region</th>
			<th style="text-align: center">POC Name</th>
			<th style="text-align: center" colspan="2">Utilization</th>

			</thead>
			<tbody>
			<?php


			$list = pg_query($conn, "select
service_type,ne_name,region_name,poc_name,min(utilization) as minutil, avg(utilization) as avgutil, max(utilization) as maxutil
from view_daily
where service_type = '".$table_name."' and (weeks>=".$weeks." and weeks<=".$weeksto.") and years=".$years." and jenis_data=1 and poc_name <> '0.0' and poc_name <> ''
group by service_type,ne_name,region_name,poc_name
order by region_name,poc_name,ne_name")
			or die ("Query error!");
			while ($row = pg_fetch_array($list)) {
				echo("<tr>");
				echo ("<td nowrap='nowrap'  align='center'>".$row['ne_name']."</td>");
				echo ("<td nowrap='nowrap'  align='center'>".$row['region_name']."</td>");
				echo ("<td nowrap='nowrap'  align='center'>".$row['poc_name']."</td>");
				echo("<td nowrap='nowrap' align='center'>".number_format($row['avgutil'],2)."</td>");
				echo("<td class='styled' ><meter min='0' max='100' low='50' high='75' optimum='100' value='" . $row['avgutil'] . "'></meter></td>");

				echo("</tr>");
			}
			?>

			</tbody>
		</table>
	</div>
</div>
<?php }
?>