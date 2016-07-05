$(function () {
    var f = $('#f1').val();
    var f1 = $('#f2').val();
    var f2 = $('#f3').val();
    var type = $('#type').val();
    var w = parseInt(f) +1;
    var w1 = parseInt(f1) +1;
    var w2 = parseInt(f2) +1;
  $('#container').highcharts({

      title: {
          text: 'Trend '+type
      },
      subtitle: {
        text: 'Utilization >80% = Week '+w

    },
      xAxis: {
          categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52']
            ,plotLines: [{

                  color: 'red', // Color value
                  dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                  value: f, // Value of where the line will appear
                  width: 2 // Width of the line
              }]

      }, yAxis: {
          title: {
              text: 'Utilization'
          },
          plotLines: [{
              color: 'red', // Color value
              dashStyle: 'longdashdot', // Style of the plot line. Default to solid
              value: 80, // Value of where the line will appear
              width: 2 // Width of the line
          }]
      },
      series: [{
          type: 'spline',
          name: "Actual Utilization",
          data: JSON.parse(document.getElementById('actual').innerHTML)
      },{
          type: 'spline',
          name: "Linear Trend",
          data: JSON.parse(document.getElementById('linearx').innerHTML)
      },{
          type: 'spline',
          name: "Exponential Trend",
          data: JSON.parse(document.getElementById('expo').innerHTML)
      },{
          type: 'scatter',
          name: 'Polynomial Trend',
          data: JSON.parse(document.getElementById('poly').innerHTML),
          marker: {
              radius: 4
          }
      },{
          type: 'line',
          name: 'P1',
          data: JSON.parse(document.getElementById('p1').innerHTML)
      }]
    });
    $('#containerx').highcharts({

        title: {
            text: 'Exponential Chart '+type
        },

        subtitle: {
        text: 'Utilization >80% = Week '+w1

    },
    xAxis: {
        categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52']
            ,
            plotLines: [{
            color: 'red', // Color value
            dashStyle: 'longdashdot', // Style of the plot line. Default to solid
            value: f1, // Value of where the line will appear
            width: 2 // Width of the line
        }]
    }, yAxis: {
        title: {
            text: 'Utilization'
        },
        plotLines: [{
            color: 'red', // Color value
            dashStyle: 'longdashdot', // Style of the plot line. Default to solid
            value: 80, // Value of where the line will appear
            width: 2 // Width of the line
        }]
    },
        series: [ {
            type: 'spline',
            name: "Actual Utilization",
            data: JSON.parse(document.getElementById('actual').innerHTML)
        }]
    });
    $('#containery').highcharts({

        title: {
            text: 'Polynomial Chart '+type
        },

        subtitle: {
            text: 'Utilization >80% = Week '+w2

        },
        xAxis: {
            categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52']
            ,
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f2, // Value of where the line will appear
                width: 2 // Width of the line
            }]
        }, yAxis: {
            title: {
                text: 'Utilization'
            },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: 80, // Value of where the line will appear
                width: 2 // Width of the line
            }]
        },
        series: [{
            type: 'spline',
            name: "Actual Utilization",
            data: JSON.parse(document.getElementById('actual').innerHTML)
        }]
    });


    $('#container1').highcharts({

        title: {
            text: 'Capacity Limit Breaches'
        },
        xAxis: {
            categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']

        }, yAxis: {
            title: {
                text: 'Utilization'
            }
        },
        series: [{
            type: 'spline',
            name: "Actual Utilization",
            data: JSON.parse(document.getElementById('actual1').innerHTML)
        },{
            type: 'spline',
            name: "Linear Trend",
            data: JSON.parse(document.getElementById('liner').innerHTML)
        }
        ]
    });

});
