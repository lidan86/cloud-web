$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Billing Subscribers (MIO)'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
            name: 'Actual SMS',
            data: [7.0, 7.9, 9.5, 14.5, 18.4, 24.5, 25.2, 22.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Actual Voice',
            data: [3.9, 9.2, 5.7, 5.5, 11.9, 15.2, 17.0, 11.6, 6.2, 10.3, 6.6, 4.8]
        },
        {
            name: 'Projection SMS',
            data: [3.9, 4.2, 2.7, 8.5, 10.9, 15.2, 17.0, 11.6, 11.2, 10.3, 6.6, 4.8]
        },
        {
            name: 'Projection Voice',
            data: [3.9, 4.2, 5.7, 5.5, 11.9, 15.2, 39.0, 16.6, 14.2, 30.3, 6.6, 4.8]
        }]
    });
});


$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Billing Subscribers (MIO)'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
            name: 'Actual Data',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Projection Data',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
});