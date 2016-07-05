<?php echo form_open(base_url().'carf/plma/ma/publish/'.$action_id); ?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-outdent"></i> </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Project Name = <?php echo $project; ?></label><br>
            <label><?php echo $title; ?> Publish to Post Launch</label>
            <textarea name="comment" class="form-control" rows="3" placeholder="Enter your comments..."></textarea>
        </div>
    </div>          
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('carf'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Back
                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Save
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->
</div><!--/ Panel -->    
<?php echo form_close(); ?>