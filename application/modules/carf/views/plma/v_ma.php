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
                <h2>Post Lauch - Monitor & Analysis (PLMA)</h2>
                <div class="head-panel nm">                                               
                </div>
            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
        </div>    
    </div>
</div>