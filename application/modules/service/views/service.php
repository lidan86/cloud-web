<?php
    $cek =  $this->session->flashdata('pesan');
if(!empty($cek)){
?>
<div class="row">
    <div class="col-lg-12">
        <div id="message" class="alert alert-success">
            <strong><p id="messageTitle"><?php echo $this->session->flashdata('pesan'); ?></p></strong>


        </div>
    </div>
</div>
<?php }?>

    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">Service</h4>

        </div>

    </div>
    <div class="row">

        <div class="col-md-3">
            <a class="btn bg-info" href="<?php echo base_url().'index.php/service/add_data' ;?>" >tambah</a>
        </div>

    </div>
<div class="row">
	<div class="col-md-12">
<table  id="quotationsList" class="table table-striped table-bordered table-hover smaller" cellspacing="0" width="100%">
    <thead>
    <tr class="primary">
        <td>Service Name</td>
        <td style="text-align: center;" colspan="2">Action</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $d){ ?>
    <tr>
        <td><?php echo $d['service']; ?> </td>
        <td align = 'center'> 
            <a href="<?php echo base_url().'index.php/service/editData/'.$d['id']; ?> " >edit</a> 
        </td>
        <td align = 'center'> 
            <a href="<?php echo base_url().'index.php/service/do_delete/'.$d['id']; ?> " >delete</a> 
        </td>    
    </tr>
    <?php }?>  
    </tbody>
</table>

    
	</div>
</div>
