$(function () {

    var week = $("#ne").val();
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'spline'
        },
        title: {
            text: week
        },
        yAxis: {

            title: {
                text: 'Utilization (%)'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        xAxis: {
            title: {
                text: 'Week'
            }
        },
        tooltip: {
            tooltip: {
                valueSuffix: '%'
            },
        }
    });

});
