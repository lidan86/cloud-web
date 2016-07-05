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
            <?php if(!empty($info_carf)){

          ?>
            <div class="head bg-default bg-light-rtl">
                <h2><?php foreach($info_carf as $row): ?>
                        <?php echo $row->project_name.' - '.$row->request_num.$row->id; ?>
                    <?php endforeach; ?>
                </h2>
                <!--                <div class="side pull-right">
                                    <ul class="buttons">
                                        <li><a href="#"><span class="icon-plus"></span></a></li>
                                        <li><a href="#"><span class="icon-cogs"></span></a></li>
                                    </ul>
                                </div> -->
            </div>
            <?php   }?>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
        </div>    
    </div>
</div>

<script type="text/javascript">    
$('#field-tld').datepicker(
        {
            minDate: 0,
            beforeShow: function() {
                $(this).datepicker('option', 'maxDate', $('#tottd').val());
            }
        });
    $('#field-ttd').datepicker(
        {
            defaultDate: "+1w",
            beforeShow: function() {
                $(this).datepicker('option', 'minDate', new Date($('#field-tld').val()).addDays(2));
                if ($('#field-tld').val() === '') $(this).datepicker('option', 'minDate', 0);
            }
        });

    Date.prototype.addDays = function(days) {
        this.setDate(this.getDate() + parseInt(days));
        return this;
    };      
function initChangeEvent() {
  $("#field-req_type_id").change(function() {
    if($(this).val() == "Change - Update") {
        $("#mention_req_field_box").show();
        $("#field-mention_req").show();// hjual
        $("#mention_req_display_as_box").show();// hsewa
    }else if($(this).val() == "New") {
        $("#mention_req_field_box").hide();
        $("#field-mention_req").hide();// hjual
        $("#mention_req_display_as_box").hide();// hsewa    
    }
  });    
}
$(function(){
  initChangeEvent();
  $("#field_req_type_id_chzn").trigger('change');  
})
</script>
