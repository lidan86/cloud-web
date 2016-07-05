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
                <h2>Calculate Opportunity Cost</h2>
                <div class="head-panel nm">                                               
                </div>
            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
            <div class="footer">
                <button type="button" class="btn btn-default btn-clean" onclick="location.href='<?php echo base_url() ?>carf/plma/ma'">Back to PLMA lists</button>
            </div>
        </div>    
    </div>
</div>