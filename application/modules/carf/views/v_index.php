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
                <h2>CAPACITY ASSESMENT REQUEST FORM (CARF)</h2>
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
<?php if (!$get_capacity == ''){?>
<div class="row">
    <div class="col-md-12">
        <div class="block block-drop-shadow">
            <div class="head bg-default bg-light-rtl">
                <h2>CHANGE DOCUMENT HISTORICAL</h2>
                
            </div>
            <div class="content list">
                <?php foreach($get_capacity as $isi){ ?>
                <?php
                $proses='';$status='';$pbar='';
                    if ($isi['approval']==1) {$proses = '25'; $pbar ='progress-bar'; $status='Capman Processing New Request ... !';};
                    if ($isi['approval']==2) {$proses = '50'; $pbar ='progress-bar progress-bar-info'; $status='Netplan Processing New Verivication ... !';};
                    if ($isi['approval']==3) {$proses = '75'; $pbar ='progress-bar progress-bar-warning'; $status='Capman Processing New Approved... !';};
                    if ($isi['approval']==4) {$proses = '100'; $pbar ='progress-bar progress-bar-success'; $status='Completed ... !';};
                    if ($isi['approval']==21) {$proses = '40'; $pbar ='progress-bar progress-bar-danger'; $status='Capman Processing UnApproved ... !';};
                    if ($isi['approval']==31) {$proses = '90'; $pbar ='progress-bar progress-bar-danger'; $status='Netplan Processing UnFinal ... !';};
                ?>
                <div class="list-item">
                    <div class="list-datetime">
                        <div class="time"><?php echo $isi['request_num']?></div>
                        <div class="Date"><a href="http://192.168.50.70/bajau/master/document/index/<?php echo $isi['id']; ?>" class="widget-icon widget-icon-dark"><span class="icon-file-text"></span></a></div>
                    </div>
                    <div class="list-info">
                        <img src="<?php echo Modules::run('options/settings/get_pic',$isi['user_add']); ?>" class="img-circle img-thumbnail" style="width: 50px; height: 50px">
                    </div>
                    <div class="list-text">
                        <a href="#" class="list-text-name"><i class="icon-tag"></i> <?php echo $isi['project_name']; ?> | <?php echo $isi['request_num'].$isi['id']; ?> | Owner : <?php echo Modules::run('carf/whois_user', $isi['user_add']); ?></a>
                        <p>Last comment : <?php echo Modules::run('carf/ambilpesan', $isi['id']); ?> | By : <img src="<?php echo Modules::run('options/settings/get_pic',Modules::run('carf/ambilpesan_id', $isi['id'])); ?>" class="img-thumbnail" style="width: 15px; height: 15px"><?php echo Modules::run('carf/pesanoleh', $isi['id']); ?> </p>
                        <div class="progress progress-striped progress-small active">
                            <div class="<?php echo $pbar ?>" role="progressbar" aria-valuenow="<?php echo $proses ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $proses ?>%"></div>
                        </div>
                    </div>
                    <div style="height: 50px; line-height: 30px;" class="list-controls">
                        <a href="#" class="widget-icon widget-icon-circle"><span class="icon-list-alt"></span></a>
                        <a href="#" class="widget-icon widget-icon-circle"><span class="icon-tags"></span></a>
                        <a href="#" class="widget-icon widget-icon-circle"><span class="icon-print"></span></a>
                        <?php echo $status.' Progress :'.$proses.'%'?>
                    </div>
                </div>
                <?php } ?>           
            </div>
        </div>
    </div>
</div>
<?php } ?>
        