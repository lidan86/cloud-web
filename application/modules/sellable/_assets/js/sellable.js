$(function () {

    $('#datatable2').dataTable({
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
            null

        ]

    });
    $('#container').highcharts({

        title: {
            text: 'Sellable Trend '
        },
        xAxis: {
            categories: JSON.parse(document.getElementById('time').innerHTML)
        },
            yAxis: {
            title: {
                text: 'Utilization'
            }
        },
        series: [{
            type: 'column',
            name: "Full Capacity",
            data: JSON.parse(document.getElementById('capacity').innerHTML)
        },{
            type: 'column',
            name: "Current Trrafic",
            data: JSON.parse(document.getElementById('current').innerHTML)
        },{
            type: 'spline',
            name: "Sellable",
            data: JSON.parse(document.getElementById('sellable').innerHTML)
        }]
    });
});