$(function () {
    $('#container').highcharts({
        title: {
            text: 'Min Physical POC (Min)'
        },
        xAxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 
                'Apr', 'Mei', 'Jun',
                'Jul','Agus','Sept',
                'Okt','Nov','Des'
            ]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Actual',
            data: [31, 32, 11, 43, 4,10,21,92,12,42,1,23]
        }, {
            type: 'column',
            name: 'Projection',
            data: [12, 23, 55, 37, 16,12,42,12,3,12,3,12]
        }, {
            type: 'spline',
            name: '% Accuracy',
            data: [124, 12.67,213, 146.33, 3.33,13, 123,123,2,12,2,12],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
    });
});

$(function () {
    $('#container2').highcharts({
        title: {
            text: 'Total Data Traffic (Tb)'
        },
        xAxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 
                'Apr', 'Mei', 'Jun',
                'Jul','Agus','Sept',
                'Okt','Nov','Des'
            ]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Actual',
            data: [31, 32, 11, 43, 4,10,21,92,12,42,1,23]
        }, {
            type: 'column',
            name: 'Projection',
            data: [12, 23, 55, 37, 16,12,42,12,3,12,3,12]
        }, {
            type: 'spline',
            name: '% Accuracy',
            data: [124, 12.67,213, 146.33, 3.33,13, 123,123,2,12,2,12],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }]
    });
});
