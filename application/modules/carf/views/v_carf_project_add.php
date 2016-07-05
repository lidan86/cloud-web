<div class="row">
    <div class="col-md-12">
        <div class="block block-fill-white">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'carf/traffic_proj/do_insert/edit/'.$id; ?> ">

                    <div class="form-row">
                        <div class="col-md-4"  class="form-control" >1st Projection</div>
                        <div class="col-md-4"  class="form-control" >2nd Projection</div>
                        <div class="col-md-4"  class="form-control" >3rd Projection</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" readonly="readonly" name="months" placeholder="months " value="1"/></div>
                        <div class=col-md-2>Q</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" readonly="readonly" name="months1" placeholder="months " value="2"/></div>
                        <div class=col-md-2>Q</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" readonly="readonly" name="months2" placeholder="months " value="3"/></div>
                        <div class=col-md-2>Q</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_voice" placeholder="total voice"/></div>
                        <div class=col-md-2>Total Voice</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_voice1" placeholder="total voice"/></div>
                        <div class=col-md-2>Total Voice</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_voice2" placeholder="total voice"/></div>
                        <div class=col-md-2>Total Voice</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_sms" placeholder="total sms "/></div>
                        <div class=col-md-2>Total SMS</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_sms1" placeholder="total sms "/></div>
                        <div class=col-md-2>Total SMS</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_sms2" placeholder="total sms "/></div>
                        <div class=col-md-2>Total SMS</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_data_peak_traffic" placeholder="total data peak traffic"/></div>
                        <div class=col-md-2>Total Data Peak Traffic</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_data_peak_traffic1" placeholder="total data peak traffic"/></div>
                        <div class=col-md-2>Total Data Peak Traffic</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="total_data_peak_traffic2" placeholder="total data peak traffic"/></div>
                        <div class=col-md-2>Total Data Peak Traffic</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="burn_rate" placeholder="Burn Rate"/></div>
                        <div class=col-md-2>Burn Rate</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="burn_rate1" placeholder="Burn Rate"/></div>
                        <div class=col-md-2>Burn Rate</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="burn_rate2" placeholder="Burn Rate"/></div>
                        <div class=col-md-2>Burn Rate</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="churn_rate" placeholder="Churn Rate"/></div>
                        <div class=col-md-2>Churn Rate</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="churn_rate1" placeholder="Churn Rate"/></div>
                        <div class=col-md-2>Churn Rate</div>
                        <div class="col-md-2"  class="form-control" ><input type=text class="form-control" name="churn_rate2" placeholder="Churn Rate"/></div>
                        <div class=col-md-2>Churn Rate</div>
                    </div>




                    <input type="hidden" id="carf_id" name="carf_id" value="<?php echo $id;?>">

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
