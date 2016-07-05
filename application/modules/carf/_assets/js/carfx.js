$(function() {
             var dateToday = new Date();
            $( "#field-ttd" ).datepicker({
                numberOfMonths: 1,
                showButtonPanel: true,
                minDate: dateToday
            });
         });