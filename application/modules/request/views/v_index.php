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
<div class="block">

    <?php // foreach($info_client as $row): ?>
        <?php // echo 'Documents for '.$row->client_name; ?>
    <?php // endforeach; ?>
    <?php if (!$get_capacity == ''){?>
        
                               <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                            <th>Program</th>
                                            <th>Progress</th>
                                            <th style="width: 40px"></th>
                                        </tr>
                                    <?php foreach($get_capacity as $isi){ ?>
                                        <tr>
                                            <td><?php echo $isi['program_name']."<br />"; ?></td>
                                            <td>
                                    <?php
                                        if ($isi['action']==1) {$proses = '25%'; $pbar ='progress-bar-danger'; $warna='bg-red';$status='Capman Processing New Request ... !';};
                                        if ($isi['action']==2) {$proses = '50%'; $pbar ='progress-bar-yellow'; $warna='bg-yellow';$status='Netplan Processing New Verivication ... !';};
                                        if ($isi['action']==3) {$proses = '75%'; $pbar ='progress-bar-primary'; $warna='bg-light-blue';$status='Capman Processing New Approved... !';};
                                        if ($isi['action']==4) {$proses = '100%'; $pbar ='progress-bar-success'; $warna='bg-green';$status='Completed ... !';};
                                        if ($isi['action']==21) {$proses = '40%'; $pbar ='progress-bar-yellow'; $warna='bg-yellow';$status='Capman Processing UnApproved ... !';};
                                        if ($isi['action']==31) {$proses = '90%'; $pbar ='progress-bar-primary'; $warna='bg-green';$status='Netplan Processing UnFinal ... !';};
                                    ?>            
                                                <div class="progress xs progress-striped active">
                                                    <div rel="tooltip" title="<?php echo $status; ?>" class="progress-bar <?php echo $pbar; ?>" style="width: <?php echo $proses; ?>"></div>
                                                </div>
                                            </td>
                                            <td><span rel="tooltip" title="<?php echo $status; ?>" class="badge <?php echo $warna; ?>"><?php echo $proses; ?></span></td>
                                        </tr>                                        
                                    <?php } ?>
                                    </tbody></table>
                                </div>
    <?php } ?>
    
</div>    
    <div>
         <?php echo $gcrud->output; ?>
    </div>

<?php if ($get_capacity == ''){?>
    <?php foreach($get_all_req as $isi_req){ ?>
    <div class="modal modal-info" id="modal_req_<?php echo $isi_req['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $isi_req['program_name']; ?></h4>
                </div>
                <div class="modal-body clearfix">
                    <p>Program Name : <?php echo $isi_req['program_name']; ?></p>
                    <p>Start & end Date : <?php echo $isi_req['start_date'].' & '.$isi_req['end_date']; ?></p>
                    <p>Traffic Subs : <?php echo $isi_req['traffic_subs']; ?></p>
                    <p>Notes : <?php echo $isi_req['notes']; ?></p>
                    <p></p>
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>              
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>