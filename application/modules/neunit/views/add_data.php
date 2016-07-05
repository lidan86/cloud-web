<?php

$queryx = $this->db->query("select api from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $api = $row->api;
}
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
$json = file_get_contents($api.'CapmanApi/JenisData',false,$context);
$result = json_decode($json,true);
?>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/neunit/do_insert'; ?> ">


                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Unit Name</div>
                        <div class=col-md-9><select class="form-control" id="unit_name" name="unit_name">
                                <?php
                                foreach($result as $row){

                                    echo("<option value='" . $row['units'] . "'>" . $row['name'] . "</option>");

                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Remarks</div>
                        <div class=col-md-9><input type=text class="form-control" name="remark" placeholder="Remarks"/></div>
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
