<?php
foreach($gcrud->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($gcrud->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
    <?php foreach($info_capacity as $row): ?>
        <?php echo 'Documents for '.$row->program_name; ?>
    <?php endforeach; ?>
    <div>
         <?php echo $gcrud->output; ?>
    </div>
    <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                       <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default">
                           <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                       </a>                 
    </div>

