<?php if ($status =='admin'){  ?>
    <?php
    foreach($gcrud->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($gcrud->js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
    <?php // foreach($info_client as $row): ?>
        <?php // echo 'Documents for '.$row->client_name; ?>
    <?php // endforeach; ?>
    <div>
         <?php echo $gcrud->output; ?>
    </div>
<?php }
if ($status =='user'){  ?>
    <?php echo form_open(base_url().'msg/bug/'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-bug"></i> </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Report URL  <?php echo $_SERVER['HTTP_REFERER']; ?></label>
                <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
            </div>
            <div class="form-group">
                <label>Comment bugs</label>
                <textarea name="comment" class="form-control" rows="3" placeholder="Enter ... to report bug ... !!"></textarea>
                <i class="to">* Pesan ini akan disampaikan ke admin... Terima kasih</i>
            </div>
        </div>          
        <div class="panel-footer">   
              <div class="row"> 
                  <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                       <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default">
                           <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                       </a> 
                        <button type="submit" class="btn btn-primary" name="post">
                            <i class="glyphicon glyphicon-floppy-save"></i> Simpan 
                        </button>                  
                  </div>
              </div>
        </div><!--/ Panel Footer -->
    </div><!--/ Panel -->    
    <?php echo form_close(); ?>
<?php }  ?>


