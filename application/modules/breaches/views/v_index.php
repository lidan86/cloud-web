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
                <h2>History Breaches</h2>
                <!--                <div class="side pull-right">
                                    <ul class="buttons">
                                        <li><a href="#"><span class="icon-plus"></span></a></li>
                                        <li><a href="#"><span class="icon-cogs"></span></a></li>
                                    </ul>
                                </div> -->
                <div class="head-panel nm">
                    <?php echo $newbutton ?>
                    <!--                    <a data-original-title="Refresh" href="#" class="hp-info hp-one pull-right tip" title="">
                                            <div class="hp-icon">
                                                <span class="icon-refresh"></span>
                                            </div>
                                            <span class="hp-main">9:24 am</span>
                                        </a>                                                 -->
                </div>

            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
        </div>
    </div>
</div>
