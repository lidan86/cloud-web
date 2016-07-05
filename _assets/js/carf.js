$(function () {

    $('#carf').dataTable({
        "sPaginationType": "full_numbers",
        "bPaginate": true,

        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "aoColumns": [

            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null

        ]
    });
    $('#carf2').dataTable({
        "sPaginationType": "full_numbers",
        "bPaginate": true,

        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "aoColumns": [

            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null


        ]
    });
    var dateToday = new Date();
    $('#field-tld').datepicker(
        {
            minDate: 0,
            beforeShow: function() {
                $(this).datepicker('option', 'maxDate', $('#field-ttd').val());
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

    $("#mention_reg_field_box").hide();
    $("#field-target_market_id").change(function(){

        if($(this).val()==6){
            $('#mention_reg_field_box').show();
        }
        else{
            $('#mention_reg_field_box').hide();
        }
    });
});/**
 * Created by root on 3/25/15.
 */
