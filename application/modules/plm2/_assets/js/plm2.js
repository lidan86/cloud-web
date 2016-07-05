$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Voice Projection vs Actual'
        },
        xAxis: {
            categories: ['41823', '41825', '41827', '41829', '41831', '41833', '41835', '41837', '41839', '41841', '41843', '41845']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Actual Voice',
            data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
        },
        {
            name: 'Projection Voice',
            data: [3.9, 4.2, 5.7, 5.5, 11.9, 15.2, 39.0, 16.6, 14.2, 30.3, 6.6, 4.8]
        }]
    });
});

