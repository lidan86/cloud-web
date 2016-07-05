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
				<?php if(!empty($info_carf)){ ?>
                <h2><?php foreach($info_carf as $row): ?>
                
                        <?php echo 'Project Name for '.$row->project_name.' ('.$row->request_num.$row->id.')'; ?>
                    <?php endforeach; ?>
                </h2>
                <?php }?>
                <!--                <div class="side pull-right">
                                    <ul class="buttons">
                                        <li><a href="#"><span class="icon-plus"></span></a></li>
                                        <li><a href="#"><span class="icon-cogs"></span></a></li>
                                    </ul>
                                </div> -->
            </div>
            <div class="content">
                <?php echo $gcrud->output; ?>
            </div>
        </div>    
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var 
        jqDdl = $('#field-net_cap_available'),
        onChange = function(event) {
            if ($(this).val() === 'Capacity partially available') {
                $("#field-net_cap_par_available").show();
                $("#net_cap_par_available_display_as_box").show();
                $("#net_cap_par_available_field_box").show();
                $("#field-net_cap_cond_available").hide();                   
                $("#net_cap_cond_available_display_as_box").hide();                
                $("#net_cap_cond_available_field_box").hide();
            } else if ($(this).val() === 'Capacity conditionally available') {
                $("#field-net_cap_par_available").hide();
                $("#net_cap_par_available_display_as_box").hide();
                $("#net_cap_par_available_field_box").hide();
                $("#field-net_cap_cond_available").show();                   
                $("#net_cap_cond_available_display_as_box").show();                
                $("#net_cap_cond_available_field_box").show();
            } else if ($(this).val() === 'Capacity available') {
                $("#field-net_cap_par_available").hide();
                $("#net_cap_par_available_display_as_box").hide();
                $("#net_cap_par_available_field_box").hide();
                $("#field-net_cap_cond_available").hide();                   
                $("#net_cap_cond_available_display_as_box").hide();                
                $("#net_cap_cond_available_field_box").hide();
            }else{
                $("#field-net_cap_par_available").hide();
                $("#net_cap_par_available_display_as_box").hide();
                $("#net_cap_par_available_field_box").hide();
                $("#field-net_cap_cond_available").hide();                   
                $("#net_cap_cond_available_display_as_box").hide();                
                $("#net_cap_cond_available_field_box").hide();
            }
        };
        onChange.apply(jqDdl.get(0)); // To show/hide the Other textbox initially
        jqDdl.change(onChange);
    });
    function initChangeEvent() {
//        $("#field_it_cap_available_chzn").change(function() {
//            if($(this).val() == "Capacity partially available") {
//                $("#field-it_cap_par_available").show();
//                $("#it_cap_par_available_display_as_box").show();
//                $("#it_cap_par_available_field_box").show();
//                
//                $("#field-it_cap_cond_available").hide();                   
//                $("#it_cap_cond_available_display_as_box").hide();                
//                $("#it_cap_cond_available_field_box").hide();
//            }else if($(this).val() == "Capacity conditionally available") {
//                $("#field-it_cap_par_available").hide();
//                $("#it_cap_par_available_display_as_box").hide();
//                $("#it_cap_par_available_field_box").hide();
//                
//                $("#field-it_cap_cond_available").show();                   
//                $("#it_cap_cond_available_display_as_box").show();                
//                $("#it_cap_cond_available_field_box").show();
//            }
//        });
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
$('#date01').datepicker(
         { 
            minDate: 0,
            beforeShow: function() {
            $(this).datepicker('option', 'maxDate');
          }
       });
$('#date02').datepicker(
         { 
            minDate: 0,
            beforeShow: function() {
            $(this).datepicker('option', 'maxDate');
          }
       });       

$(function(){
  initChangeEvent();
//  $("#field_it_cap_available_chzn").trigger('change'); 
  $("#field_req_type_id_chzn").trigger('change');
})
</script>
