
    <form method="post" action="<?php echo base_url().'api/do_update'; ?> ">
<table  id="quotationsList" class="table table-striped table-bordered table-hover smaller" cellspacing="0" width="100%">
            <tr>
                <td>id</td>
                <td><input type='text' readonly name="id" value="<?php echo $id; ?> "/></td>
            </tr>
            <tr>
                <td>nama</td>
                <td><input type='text' name="api" value="<?php echo $api; ?>"/></td>
            </tr>
            <td><input type="submit" name="btnsubmit" value="submit"/> </td>
            </tr>
        </table>
    </form>
    
