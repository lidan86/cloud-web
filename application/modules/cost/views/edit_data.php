<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/Master_group',false,$context);
$result = json_decode($json,true);

?>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Edit Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/cost/do_update'; ?> ">
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Unit Name</div>
                        <div class=col-md-9>
                            <select class="form-control" id="service_group" name="service_group">
                                <?php
                                foreach($result as $row){
                                    if ($row['id'] == $master_service_group_id) {
                                        echo("<option selected='selected' value='" . $row['id'] . "'>" . $row['service_group_name'] . "</option>");

                                    } else {
                                        echo("<option value='" . $row['id'] . "'>" . $row['service_group_name'] . "</option>");
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Year</div>
                        <div class=col-md-9><input type=text class="form-control" required="true" name="years" placeholder="Year" value="<?php echo $years;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Max Costs</div>
                        <div class=col-md-9><input type=text class="form-control" required="true" name="max_costs" placeholder="Max Costs" value="<?php echo $max_costs;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Min Costs</div>
                        <div class=col-md-9><input type=text class="form-control" required="true" name="min_costs" placeholder="Min Costs" value="<?php echo $min_costs;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Costs</div>
                        <div class=col-md-9><input type=text class="form-control" required="true" name="costs" placeholder="Costs" value="<?php echo $costs;?>"/></div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
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
