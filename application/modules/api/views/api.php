

    <?php echo '<h2>'.$this->session->flashdata('pesan').'</h2>'; ?>
<div class="row">
	<div class="col-md-12">
<table  id="quotationsList" class="table table-striped table-bordered table-hover smaller" cellspacing="0" width="100%">
    <thead>
    <tr class="primary">
        <td>Service Name</td>
        <td colspan="2">Action</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $d){ ?>
    <tr>
        <td><?php echo $d['api']; ?> </td>
        <td align = 'center'> 
            <a href="<?php echo base_url().'index.php/api/editData/'.$d['id']; ?> " >edit</a>
        </td>

    </tr>
    <?php }?>  
    </tbody>
</table>

	</div>
</div>
