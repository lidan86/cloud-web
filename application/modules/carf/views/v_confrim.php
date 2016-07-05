<?php echo form_open(base_url().'carf/confrim/'.$action_id);
$quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$action_id." LIMIT 1");
$sq = $quer->result();
foreach($sq as $row){
    $project = $row->project_name;
    $ttd = $row->ttd;
    $program = "UDR ".$row->request_num.$action_id." Project name ".$project;
    $program .= "<br> will be launch at the 7 days are you sure to launch this project? please confrim";
}
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-outdent"></i> </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Comment to <?php echo $title; ?></label>
            <textarea name="comment" required="required" class="form-control" rows="3" placeholder="Enter ..."><?php echo $program; ?></textarea>
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