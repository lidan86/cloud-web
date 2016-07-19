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
    <?php // foreach($info_client as $row): ?>
        <?php // echo 'Documents for '.$row->client_name; ?>
    <?php // endforeach; ?>
<div class="row">
    <div class="col-md-12">
        <div class="block block-drop-shadow">
            <div class="head portlet box blue bg-light-rtl">
                <h4 ><?php echo $template['title'] ?></h4>
            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
            <div class="footer">

            </div>
        </div>
    </div>
</div>

