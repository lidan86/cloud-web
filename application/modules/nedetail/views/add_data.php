<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/MasterNeunits?status=list',false,$context);
$result = json_decode($json,true);
$json2 = file_get_contents($api.'CapmanApi/JenisNE',false,$context);
$resul = json_decode($json2,true);

?>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/nedetail/do_insert'; ?> ">

                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Unit Name</div>
                        <div class=col-md-9>
                            <select class="form-control" id="ne_id" name="ne_id">
                                <?php
                                    foreach($resul as $row){

                                            echo("<option value='" . $row['id'] . "'>" . $row['ne_name'] . "</option>");

                                    }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Years</div>
                        <div class=col-md-9><input type=text class="form-control" name="years" placeholder="years "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Low Range</div>
                        <div class=col-md-9><input type=text class="form-control" name="low_range" placeholder="low range"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Middle Range</div>
                        <div class=col-md-9><input type=text class="form-control" name="middle_range" placeholder="middle range "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >High Range</div>
                        <div class=col-md-9><input type=text class="form-control" name="high_range" placeholder="high range"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Initial Value</div>
                        <div class=col-md-9><input type=text class="form-control" name="initial_value" placeholder="initial value "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Initial Master Ne Unit Id</div>
                        <div class=col-md-9>
                            <select class="form-control" id="initial_master_ne_unit_id" name="initial_master_ne_unit_id">
                                <?php
                                foreach($result as $row){

                                    echo("<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>");

                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Cost Value</div>
                        <div class=col-md-9><input type=text class="form-control" name="cost_value" placeholder="cost value"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Cost Master Ne Unit Id</div>
                        <div class=col-md-9>
                            <select class="form-control" id="cost_master_ne_unit_id" name="cost_master_ne_unit_id">
                                <?php
                                foreach($result as $row){

                                    echo("<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>");

                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Remark</div>
                        <div class=col-md-9><input type=text class="form-control" name="remark" placeholder="remark"/></div>
                    </div>
                    <br>
                    <div class="footer">
                        <div class="side pull-right">
                            <div class="btn-group">
                                <br>
                                <button class="btn btn-primary" type="submit" > Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
