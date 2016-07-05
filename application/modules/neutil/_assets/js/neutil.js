$(function () {
    $('#datatable1').dataTable({
        "sPaginationType": "full_numbers",
        "bPaginate": true,

        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true

    });
    var name_dash = $('#name_dash').val();
    var chart_type = $('#chart_type').val();

    $('#container').highcharts({
        data: {
            table: 'datatable1'
        },
        chart: {
            type: chart_type
        },
        title: {
            text: name_dash
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Ultization / Traffic'
            }
        },
        tooltip: {
            valueSuffix: '% / tps'
        }
    });

});
