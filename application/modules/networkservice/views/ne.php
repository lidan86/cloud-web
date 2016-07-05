<?php
include_once("conn.php");

$result = pg_query($conn, "SELECT * FROM master_data.new_master_service_type")
or die ("Query error!");
$id = $this->uri->segment(2);

$ne_name = $this->uri->segment(3);
echo("SERVICES :<br>");
echo("<select name='type' size='5'>");
while ($row = pg_fetch_array($result)) {
    echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'networkservice/'.$row['id'].'\')">'.$row['service_type_name'].'</option>');
}
echo("</select><br><br>");

echo("<fieldset>Service Path");
if(!empty($id)) {
    $respath = pg_query($conn, "SELECT * FROM master_data.new_master_service_path where master_service_type_id=".$id)
    or die ("Query error!");

    echo("<table class='default'>");
    echo("<tr>");
    while ($row = pg_fetch_array($respath)) {
        echo("<td class='box' nowrap='nowrap'><a href='/capman/networkservice/".$id."/".$row['ne_name']."'>".$row['ne_name']."</a></td><td class='nobox' nowrap='nowrap'>------</td>");
    }
    echo("</tr>");
    echo("</table>");
}
echo("</fieldset>");
?>

<?php

if(!empty($id) && !empty($ne_name)) {

    $resckf = pg_query($conn, "SELECT ckf,avg(utilization) as avgutil FROM daily where ne_name='".$ne_name."' group by weeks,ckf")
    or die ("Query error!");

    ?>
    <br><br>
    <fieldset>NE CKF Utilizaion
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        <script>
            $(function () {
                $('#container').highcharts({
                    data: {
                        table: 'datatable'
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo $ne_name;?>'
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Utilization'
                        }
                    },
                    tooltip: {
                        formatter: function () {
                            return '<b>Capacity Key Factor</b><br/>' +
                                this.point.y + ' ' + this.point.name.toLowerCase();
                        }
                    }
                });
            });
        </script>
    </fieldset>

    <?php
    echo("<table id='datatable' class='default'>");
    while ($row = pg_fetch_array($resckf)) {
        echo("<tr>");
        echo("<td>".$row['ckf']."</td>");
        echo("<td>".$row['avgutil']."</td>");
        echo("</tr>");
    }
    echo("</table>");
    ?>
<?php } ?>
<?php include_once('bot.php'); ?>

