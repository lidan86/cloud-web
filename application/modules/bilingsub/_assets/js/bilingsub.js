$(function () {
    $('#container').highcharts({

        title: {
            text: 'End Subs'
        },
        xAxis: {
            categories: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']
        },
        series: [ {
            type: 'spline',
            name: "XL",
            data: JSON.parse(document.getElementById('xl').innerHTML)
        },{
            type: 'spline',
            name: "Axis",
            data: JSON.parse(document.getElementById('axis').innerHTML)
        }]
    });
});