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
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/1");?>">2G BSC</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/2");?>">3G RNC</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/3");?>">Voice</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/4");?>">Data Core</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/5");?>">IT DS Core</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/6");?>">Upstream</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/7");?>">Vas</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."capadash/index/8");?>">SMS</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."dashboard/");?>">RAN Utilization</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."billing/");?>">Billing</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."soa_r/");?>">SOA/R</a>
			<a class="btn btn-primary" href="<?php echo(base_url()."other_app/");?>">Other APP</a>
		</div>
	</div>
<?php
if(!empty($resbss)){?>
	<div class="row">
		<div class="col-md-6">
			<h4 class="page-header"><?php echo $judul;?> </h4>
		</div>
	</div>
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
				foreach($resbss as $row ) {
					if ($row['ne_name'] == 'SMSC') {
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


						if (!empty($rescob[$i])) {
							foreach ($rescob[$i] as $rowcom) {
								$rowcom['util_comments'];
								$rowcom['business_comments'];
								$rowcom['network_comments'];
								$rowcom['util_img'];
								$rowcom['bussiness_img'];
								$rowcom['network_img'];
							}
						} else {

							$rowcom['util_comments'] = '';
							$rowcom['business_comments'] = '';
							$rowcom['network_comments'] = '';
							$rowcom['util_img'] = 'green';
							$rowcom['bussiness_img'] = 'green';
							$rowcom['network_img'] = 'triangle';

						}

						$i++;

						?>
						<tr bgcolor="<?php echo($bg); ?>">
							<td style=" width : 25%; text-align: center; vertical-align: middle"><?php echo($row['ne_name']); ?></td>
							<td class="<?php echo $bgi; ?>"
								style=" width : 25%;  text-align: center; vertical-align: middle"><font
									color="<?php echo($fc) ?>"><?php echo("<a  href='" . base_url() . "capadash/drill/" . $row['ne_name'] . "'>" . number_format($row['util'], 2) . "</a>"); ?></font>
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
									if (!empty($rowcom['util_comments']) || !empty($rowcom['business_comments']) || !empty($rowcom['network_comments'])) {
										echo('<input style="height: 30px; padding: 3px; width: 70px;" class="btn btn-info" id="buttoned" type="submit" name="savedata" value="Update">');
									} else {
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
				}

				?>
			</table>
		</div>
	</div>

<?php }?>