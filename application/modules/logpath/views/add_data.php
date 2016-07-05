<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/channel/do_insert'; ?> ">


                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Channel</div>
                        <div class=col-md-9><input type=text class="form-control" name="channel" placeholder="Nama channel"/></div>
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
