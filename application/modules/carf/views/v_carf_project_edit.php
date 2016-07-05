<div class="row">
    <div class="col-md-12">
        <div class="block block-fill-white">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'carf/traffic_proj/do_update/edit/'.$carf_id.'/'.$id; ?> ">


                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Quater</div>
                        <div class=col-md-9><input type=text class="form-control" readonly="readonly" name="months" value="<?php echo $months;?>" placeholder="months "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Total Voice</div>
                        <div class=col-md-9><input type=text class="form-control" name="total_voice" value="<?php echo $total_voice;?>" placeholder="total voice"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Total SMS</div>
                        <div class=col-md-9><input type=text class="form-control" name="total_sms" value="<?php echo $total_sms;?>" placeholder="total sms "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Total Data Peak Traffic</div>
                        <div class=col-md-9><input type=text class="form-control" name="total_data_peak_traffic" value="<?php echo $total_data_peak_traffic;?>" placeholder="total data peak traffic"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Burn Rate</div>
                        <div class=col-md-9><input type=text class="form-control" name="burn_rate" value="<?php echo $burn_rate;?>" placeholder="burn rate "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Churn Rate</div>
                        <div class=col-md-9><input type=text class="form-control" name="churn_rate" value="<?php echo $churn_rate;?>" placeholder="churn rate"/></div>
                    </div>

                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                    <input type="hidden" id="carf_id" name="carf_id" value="<?php echo $carf_id;?>">

                    <div class="footer">
                        <div class="side pull-right">
                            <div class="btn-group">

                                <button class="btn btn-primary" type="submit" > Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
