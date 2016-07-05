<?php
foreach($gcrud->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($gcrud->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="row">
    <div class="col-md-12">
        <div class="block block-drop-shadow">
            <div class="head bg-default bg-light-rtl">
                <h2><?php foreach($info_carf as $row): ?>
                    <?php echo 'Documents for '.$row->project_name; ?>
                    <?php endforeach; ?>
                </h2>
<!--                <div class="side pull-right">                            
                    <ul class="buttons">                                
                        <li><a href="#"><span class="icon-plus"></span></a></li>
                        <li><a href="#"><span class="icon-cogs"></span></a></li>
                    </ul>
                </div> -->
            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
            <div class="footer">
                <button type="button" class="btn btn-default btn-clean" onclick="location.href='<?php echo base_url() ?>carf'">Back to CARF</button>
            </div>
        </div>    
    </div>
</div>