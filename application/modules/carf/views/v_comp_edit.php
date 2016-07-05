<div class="row">
    <div class="col-md-12">
        <div class="block block-fill-white">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'carf/compl_lvl/do_update/edit/'.$carf_id.'/'.$id; ?> ">


                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Category Level</div>
                        <div class=col-md-9><input type=text class="form-control" readonly name="category_lvl" value="<?php echo $category_lvl;?>" placeholder="category lvl "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Category Project</div>
                        <div class=col-md-9><input type=text class="form-control" name="category_project" readonly value="<?php echo $category_project;?>" placeholder="category project"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Duration Product Concept</div>
                        <div class=col-md-9><input type=text class="form-control" name="dcp" value="<?php echo $dcp;?>" placeholder="Duration Product Concept "/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Development Time</div>
                        <div class=col-md-9><input type=text class="form-control" name="dt" value="<?php echo $dt;?>" placeholder="Development Time"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Total RFS</div>
                        <div class=col-md-9><input type=text class="form-control" name="total_rfs" value="<?php echo $total_rfs;?>" placeholder="total rfs"/></div>
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
