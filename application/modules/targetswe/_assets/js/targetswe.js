$(function () {
    $('#container').highcharts({

        data: {
            table: 'datatable'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: 'Target SWE'
        },

        yAxis: {
            title: {
                text: 'Result'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        tooltip: {
            valueSuffix: ''
        }
    });
});