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
