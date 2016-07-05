
<?php if(!empty($typeid)) {

    $json3 = file_get_contents($api . 'CapmanApi/Home?home=home4&id=' . $typeid);

    $data2 = json_decode($json3, true);
    echo("<div class='row' style='padding-bottom: 15px'>");

    echo("<div class='col-md-12'>");
    echo('<div id="tabs">');
    echo("<ul style='text-align: center'>");
    foreach ($data2 as $row) {
        echo('<li><a href="javascript:location.replace(\'' . base_url() . 'home/' . $sgid . '/' . $sgname . '/' . $typeid . '/' . $row['ne_name'] . '\')">' . $row['ne_name'] . '</a></li> ');
    }
    echo("</ul>");

    if (!empty($typeid) && !empty($nename)) {

        $json4 = file_get_contents($api . 'CapmanApi/Home?home=home3&weeks=' . $data . '&years=' . $datax . '&ne_name=' . $nename . '');
        //$json4 = file_get_contents('http://192.168.50.93:8080/CapmanApi/Home?home=home3&weeks=49&years=2014&ne_name=RNC');

        $data3 = json_decode($json4, true);
        $rocek = $data3;
        foreach ($data3 as $row) {
            $cek = $row['ckf'];

        }

        if (empty($cek)) {

            echo("<div class='row' >");
            echo("<div class='col-md-12'>");
            echo("<h3 style='color: #ff0000'> Data Not Found</h3>");
            echo("</div> </div>");
        } else {
            ?>
            <input type="hidden" id="nename" value="<?php echo $nename; ?>">

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right"><a style='color: white;' download="exportCKF_<?php echo $nename;?>_<?php echo $data.'_'.$datax; ?>.xls" href="#" onclick="return ExcellentExport.excel(this, 'datatablex', 'Sheet Name Here');" class="btn btn-info" id="export">Export Excel</a></div>
                    <br><br/>

                    <div id="containerx" style="min-width: 310px; height: 500px; margin: 0 auto"></div>

                </div>
            </div>

            <?php

            $json5 = file_get_contents($api . 'CapmanApi/Home?home=home3&weeks=' . $data . '&years=' . $datax . '&ne_name=' . $nename . '');

            $data5 = json_decode($json5, true);
            echo("<table id='datatablex' class='default' style='display:none;'>");
            echo("<tr bgcolor='#E0E0E0'>");
            echo("<td nowrap='nowrap'>Services Type</td>");
            echo("<td nowrap='nowrap' bgcolor='#7cb5ec'>Last Utilization</td>");
            echo("<td nowrap='nowrap' bgcolor='#f7a35c'>Utilization</td>");
            echo("</tr>");
            foreach ($data5 as $row) {
                echo("<tr>");
                echo("<td>" . $row['ckf'] . "</td>");
                echo("<td>" . number_format($row['last_week'], 2) . "</td>");
                echo("<td>" . number_format($row['avgutil'], 2) . "</td>");

                echo("</tr>");
            }
            echo("</table>");
        }
    }
    echo('</div>');
    echo("</div><br><br/></div>");
}

?>