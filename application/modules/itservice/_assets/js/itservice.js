$(function () {
    var week = $("#ne").val();
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: week
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Utilization (%)'
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