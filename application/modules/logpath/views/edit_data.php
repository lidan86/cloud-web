<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Edit Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/channel/do_update'; ?> ">

                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Channel</div>
                        <div class=col-md-9><input type=text class="form-control" name="channel" placeholder="Nama Channel" value="<?php echo $channel; ?>"/></div>
                    </div>
                    <br>
                    <div class="footer">
                        <div class="side pull-right">
                            <div class="btn-group">
                                <br>
                                <input type='hidden' readonly name="id" value="<?php echo $id; ?> "/>
                                <button class="btn btn-primary" type="submit" > Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

