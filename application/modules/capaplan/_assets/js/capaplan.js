$(function () {
    var minx = $("#min").val() ;
    minx = minx - 1.2;
    console.log(minx);
  $('#container').highcharts({

        title: {
            text: 'Capacity Plan'
        },
        xAxis: {
            title: {
                text: 'Month'
            },
            categories: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']
        },
        yAxis: {
            min: minx,
            title: {
                text: 'Trafic'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y ;
            }
        },
        plotOptions: {
           column: {
               pointPadding: 0,
               groupPadding: 0,
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            type: 'column',
            name: 'Capacity Plan',
            data: JSON.parse(document.getElementById('plan').innerHTML)
        },{
            type: 'spline',
            name: 'P4'
            //data: [null, null, null, null, 8,10,11,12,13]
        },{
            type: 'spline',
            name: 'P3'
            //data: [null, null, null, 6, 8,9,10,11,12]
        },{
            type: 'spline',
            name: 'P2'
            //data: [null, null, 3, 6, 7,8,9,10,11]
        },{
            type: 'spline',
            name: 'Current Utilization',
            data: JSON.parse(document.getElementById('actual').innerHTML)
        },{
            type: 'spline',
            name: "Linear Trend",
            data: JSON.parse(document.getElementById('linearx').innerHTML)
        }]
    });

});
