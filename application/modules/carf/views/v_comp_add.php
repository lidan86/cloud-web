<div class="row">
    <div class="col-md-12">
        <div class="block block-fill-white">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'carf/compl_lvl/do_insert/edit/'.$id; ?> ">

                    <div class="form-row">
                        <div class="col-md-2" ><input type="radio" name="category_lvl" value="low"></div>
                        <div class="col-md-2" ><font color="green">LOW</font> </div>
                        <div class="col-md-2" ><input type="radio" name="category_lvl" value="medium"></div>
                        <div class="col-md-2" ><font color="orange">MEDIUM</font> </div>
                        <div class="col-md-2" ><input type="radio" name="category_lvl" value="high"></div>
                        <div class="col-md-2" ><font color="red">HIGH</font> </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-2" ></div>
                        <div class="col-md-2" >Vas Project</div>
                        <div class="col-md-2" >Device Project</div>
                        <div class="col-md-2" >Blackberry Project</div>
                        <div class="col-md-2" >Mobile Internet Project</div>
                        <div class="col-md-2" >Internet Banking Project</div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2" >Duration Product Concept a Days</div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dcp" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dcp1" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dcp2" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dcp3" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dcp4" placeholder="days"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2" >Devlopment Time a  Working Days</div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dt" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dt1" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dt2" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dt3" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="dt4" placeholder="days"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2" >Total RFS a  Working Days</div>
                        <div class="col-md-2" ><input type=text class="form-control" name="total_rfs" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="total_rfs1" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="total_rfs2" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="total_rfs3" placeholder="days"/></div>
                        <div class="col-md-2" ><input type=text class="form-control" name="total_rfs4" placeholder="days"/></div>
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
