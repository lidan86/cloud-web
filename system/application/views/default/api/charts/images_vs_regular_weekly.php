<?php $rand = rand();?>
var chart<?php echo $rand?> = new FusionCharts("<?php echo $base_url?>flash/charts/StackedColumn3D.swf", "ChartId", "<?php echo $height?>", "<?php echo $width?>", "0", "0"); chart<?php echo $rand?>.setDataXML("<chart palette='1' caption='New Uploads >> Files vs Images >> Weekly' shownames='1' showvalues='0'  numberPrefix='' showSum='1' decimals='0' overlapColumns='0'><categories><category label='<?php $d='-6'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php $d='-5'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php $d='-4'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php $d='-3'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php $d='-2'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php $d='-1'; echo date('D', strtotime($d.' days'))?>' /><category label='<?php echo date('D', strtotime('today'))?>' /></categories><dataset seriesName='Regular' showValues='0'><set <?php $d='-6';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set <?php $d='-5';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set <?php $d='-4';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set <?php $d='-3';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set <?php $d='-2';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set <?php $d='-1';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/><set value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime('today 12:00 AM'), 'time <' => strtotime('today 11:59:59 PM'), 'is_image' => 1))->num_rows()?>'/></dataset><dataset seriesName='Image' showValues='0'><set <?php $d='-6';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set <?php $d='-5';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set <?php $d='-4';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set <?php $d='-3';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set <?php $d='-2';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set <?php $d='-1';?> value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime($d.' days 12:00 AM'), 'time <' => strtotime($d.' days 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/><set value='<?php echo $this->db->get_where('refrence', array('time >' => strtotime('today 12:00 AM'), 'time <' => strtotime('today 11:59:59 PM'), 'is_image' => 0))->num_rows()?>'/></dataset></chart>");chart<?php echo $rand?>.render("chart_data");