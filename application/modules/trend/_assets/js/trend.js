$(function () {

var f = $("#type").val();
  $('#container').highcharts({

      title: {
          text: 'Linear Trend '+f
      },
      xAxis: {
          categories: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']
      },
      series: [ {
          type: 'spline',
          name: "Plan",
          data: JSON.parse(document.getElementById('plan').innerHTML)
      },{
          type: 'spline',
          name: "Actual Traffic",
          data: JSON.parse(document.getElementById('actual').innerHTML)
      },{
          type: 'spline',
          name: "Linear Trend",
          data: JSON.parse(document.getElementById('linearx').innerHTML)
      }]
    });
    $('#containerx').highcharts({

        title: {
            text: 'Exponential Chart '+f
        },
        xAxis: {
            categories: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']
        },
        series: [ {
            type: 'spline',
            name: "Plan",
            data: JSON.parse(document.getElementById('plan').innerHTML)
        },{
            type: 'spline',
            name: "Actual Traffic",
            data: JSON.parse(document.getElementById('actual').innerHTML)
        },{
            type: 'spline',
            name: "Exponential Trend",
            data: JSON.parse(document.getElementById('expo').innerHTML)
        }]
    });
    $('#containery').highcharts({

        title: {
            text: 'Polynomial Chart '+f
        },
        xAxis: {
            categories: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des']
        },
        series: [ {
            type: 'spline',
            name: "Plan",
            data: JSON.parse(document.getElementById('plan').innerHTML)
        },{
            type: 'spline',
            name: "Actual Traffic",
            data: JSON.parse(document.getElementById('actual').innerHTML)
        },{
            type: 'scatter',
            name: 'Polynomial Traffic',
            data: JSON.parse(document.getElementById('poly').innerHTML),
            marker: {
                radius: 4
            }
        }]
    });


});
