$(function () {
    $('#datatable1').dataTable({
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
            null

        ]
    });
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Subscriber Profile vs Projections'
        },
        yAxis: {

            title: {
                text: 'Traffic'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>Capacity Key Factor</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});