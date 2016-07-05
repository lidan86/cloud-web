<?php

$user = $this->session->userdata('username');
$query = $this->db->query("select week, years from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
	$data = $row->week;
	$datax = $row->years;

}
//sgid=5&sgname=SMS Services&typeid=15&nename=SOA
$sgid = str_replace('%20', ' ', $this->uri->segment(2));
$sgname = str_replace('%20', ' ', $this->uri->segment(3));
$typeid = str_replace('%20', ' ', $this->uri->segment(4));
$service_group = str_replace('%20', ' ', $this->uri->segment(5));
$nename = str_replace('%20', ' ', $this->uri->segment(6));

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
	$api = $row->api;
}

$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Home?home=home1&weeks='.$data.'&years='.$datax,false,$context);

$datay = json_decode($json,true);
//echo "<pre>";
//print_r($datay);
//die();
?>


<div id="convertPdf">
<div class="row">

	<div class="col-md-8">

		<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
	</div>
	<div class="col-md-4">

		<?php
		echo("<table id='datatable' class='table table-bordered'>");
		echo("<thead>");
		echo("<tr bgcolor='#E0E0E0'>");
		echo("<td nowrap='nowrap'>Services</td>");
		echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>W-1</td>");
		echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
		echo("</tr>");
		echo("</thead><tbody>");
		foreach($datay as $row) {
			switch($row['util']) {
				case ($row['util'] <= 50) : $bg="lightgreen"; break;
				case ($row['util'] > 50.01 && $row['util'] < 75.01) : $bg="yellow"; break;
				case ($row['util'] > 75) : $bg="#FF8888"; break;
			}
			switch($row['last_week']) {
				case ($row['last_week'] <= 50) : $bgx="lightgreen"; break;
				case ($row['last_week'] > 50.01 && $row['last_week'] < 75.01) : $bgx="yellow"; break;
				case ($row['last_week'] > 75) : $bgx="#FF8888"; break;
			}
			echo("<tr>");
			echo('<td bgcolor="#E0E0E0" ><a class="btn-link"  href="javascript:location.replace(\''. base_url().'nation/'.$row['id'].'/'.$row['service_group'].'\')">'.$row['service_group'].'</td>');
			echo("<td nowrap='nowrap' bgcolor=".$bgx." align='center'>".number_format($row['last_week'],2)."</td>");
			echo("<td nowrap='nowrap' bgcolor=".$bg." align='center'>".number_format($row['util'],2)."</td>");
			echo("</tr>");
		}
		echo("</tbody></table>");?>

	</div>
</div>

<?php if(!empty($sgid)) { ?>
	<?php

	$jsonz = file_get_contents($api.'CapmanApi/Home?home=home2&weeks='.$data.'&years='.$datax.'&group='.$sgid,false,$context);

	$dataz = json_decode($jsonz,true);
	?>
	<input type="hidden" id="sgname" value="<?php echo $sgname;?>">


<div class="row">
	<div class="col-md-8">

		<div id="container2" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
	</div>
	<div class="col-md-4">

					<?php

					echo("<table id='datatable2' class='table table-bordered'>");
					echo("<tr bgcolor='#E0E0E0'>");
					echo("<td nowrap='nowrap'>Services Type</td>");
					echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>W-1</td>");
					echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
					echo("</tr>");
					foreach($dataz as $row) {
						switch($row['util']) {
							case ($row['util'] <= 50) : $bg="lightgreen"; break;
							case ($row['util'] > 50.01 && $row['util'] < 75.01) : $bg="yellow"; break;
							case ($row['util'] > 75) : $bg="#FF8888"; break;
						}
						echo("<tr>");
						echo('<td bgcolor="#E0E0E0"><a class="btn-link" href="javascript:location.replace(\''. base_url().'nation/'.$sgid.'/'.$sgname.'/'.$row['id'].'/'.$row['service_group'].'\')">'.$row['service_group'].'</td>');
						echo("<td nowrap='nowrap' bgcolor=".$bg." align='center'>".number_format($row['last_week'],2)."</td>");
						echo("<td nowrap='nowrap' bgcolor=".$bg." align='center'>".number_format($row['util'],2)."</td>");
						echo("</tr>");
					}
					echo("</table>");?>
	</div>
</div>

<?php } ?>
<?php if(!empty($typeid)) {

	$json3 = file_get_contents($api.'CapmanApi/Home?home=home4&id='.$typeid,false,$context);

	$data2 = json_decode($json3,true);
	echo ("<div class='row' >");

	echo("<div class='col-md-8'>");
	echo('<div class="block block-fill-white">');
	echo("<h4 class='header'>Service Path ".$service_group.":</h4>");
	echo("</div></div>");
	echo("</div>");
	echo ("<div class='row' style=' overflow: scroll;'>");

	echo("<div class='col-md-12'>");

	echo("<table>");
	echo("<tr style='text-align: center'>");
	foreach($data2 as $row) {
		echo('<td class="btn btn-info" ><a style="color: white;" href="javascript:location.replace(\''. base_url().'nation/'.$sgid.'/'.$sgname.'/'.$typeid.'/'.$service_group.'/'.$row['ne_name'].'\')">'.$row['ne_name'].'</a></td> <td style="padding :0px;" nowrap="nowrap"><i class="icon-long-arrow-right"></td>');
	}
	echo("</tr>");

	echo("</table>");
	echo("</div></div>");
}  ?>
<?php if(!empty($typeid) && !empty($nename)) {

	$json4 = file_get_contents($api.'CapmanApi/Home?home=home3&weeks='.$data.'&years='.$datax.'&ne_name='.$nename.'',false,$context);
	//$json4 = file_get_contents('http://192.168.50.93:8080/CapmanApi/Home?home=home3&weeks=49&years=2014&ne_name=RNC');

	$data3 = json_decode($json4,true);
	$rocek = $data3;


	if (empty($rocek)) {
		echo("<br> <br>");
		echo("<div class='row' >");
		echo("<div class='col-md-2'>");
		echo('<div class="panel panel-danger">');
		echo('<div class="panel-heading">');
		echo("<h1 class='panel-title'>  Data Not Found</h3>");
		echo("</div></div></div></div>");
	} else {
		?>
		<input type="hidden" id="nename" value="<?php echo $nename; ?>">
		<br>
		<br>

		<div class="row" >
			<div class="col-md-12">


				<div id="containerx" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

			</div>
		</div>

		<?php

		$json5 = file_get_contents($api.'CapmanApi/Home?home=home3&weeks='.$data.'&years='.$datax.'&ne_name='.$nename.'',false,$context);

		$data5 = json_decode($json5,true);
		echo("<table id='datatablex' class='default' style='display:none;'>");
		echo("<tr bgcolor='#E0E0E0'>");
		echo("<td nowrap='nowrap'>Services Type</td>");
		echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>W-1</td>");
		echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
		echo("</tr>");
		foreach($data5 as $row) {
			echo("<tr>");
			echo("<td>" . $row['ckf'] . "</td>");
			echo("<td>" .number_format($row['last_week'],2). "</td>");
			echo("<td>" .number_format($row['avgutil'],2). "</td>");

			echo("</tr>");
		}
		echo("</table>");
	}
}
?>
</div>
