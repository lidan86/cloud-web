$(function () {
    var d = $('#rbi1').val();
    var d1 = $('#rbi2').val();
    var d2 = $('#rbi3').val();
    var d3 = $('#rbi4').val();
    var d4 = $('#rbi5').val();
    var d5 = $('#rbi6').val();
    var d6 = $('#rbi7').val();
    var d7 = $('#rbi8').val();

    var e = $('#avg').val();
    var e1 = $('#avg1').val();
    var e2 = $('#avg2').val();
    var e3 = $('#avg3').val();
    var e4 = $('#avg4').val();
    var e5 = $('#avg5').val();
    var e6 = $('#avg6').val();
    var e7 = $('#avg7').val();

    var a = $('#peak').val();
    var a1 = $('#peak1').val();
    var a2 = $('#peak2').val();
    var a3 = $('#peak3').val();
    var a4 = $('#peak4').val();
    var a5 = $('#peak5').val();
    var a6 = $('#peak6').val();
    var a7 = $('#peak7').val();

    var f = $('#max').val();
    var f1 = $('#max1').val();
    var f2 = $('#max2').val();
    var f3 = $('#max3').val();
    var f4 = $('#max4').val();
    var f5 = $('#max5').val();
    var f6 = $('#max6').val();
    var f7 = $('#max7').val();

    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '2G Data'
        },
        subtitle: {
            text: 'RBI = '+d

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e+'<br> Peak Hour : '+a+' </p>'
            }
        },

        yAxis: {
            title: {
                text: 'Result'
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
    $('#containerx').highcharts({
        data: {
            table: 'datatablex'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '2G Voice'
        }, subtitle: {
            text: 'RBI = '+d1

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
                plotLines: [{
                    color: 'red', // Color value
                    dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                    value: f1, // Value of where the line will appear
                    width: 2 // Width of the line
                }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e1+'<br> Peak Hour : '+a1+' </p>'
            }
            },

        yAxis: {
            title: {
                text: 'Result'
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
    $('#containerz').highcharts({
        data: {
            table: 'datatablez'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '3G Data'
        }, subtitle: {
            text: 'RBI = '+d2

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f2, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e2+'<br> Peak Hour : '+a2+' </p>'
            }
        },


        yAxis: {
            title: {
                text: 'Result'
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
     $('#containery').highcharts({
        data: {
            table: 'datatabley'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '3G Voice'
        }, subtitle: {
            text: 'RBI = '+d3

        },xAxis: { categories: {
             dataLabels: {
                 enabled: true
             }
         },
             plotLines: [{
                 color: 'red', // Color value
                 dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                 value: f3, // Value of where the line will appear
                 width: 2 // Width of the line
             }],
             title:{
                 enabled: true,
                 text: '<p>Avrage : '+e3+'<br> Peak Hour : '+a3+' </p>'
             }
         },


         yAxis: {
            title: {
                text: 'Result'
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
    $('#container1').highcharts({
        data: {
            table: 'datatable1'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '2G Data'
        },
        subtitle: {
            text: 'RBI = '+d4

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f4, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e4+'<br> Peak Hour : '+a4+' </p>'
            }
        },

        yAxis: {
            title: {
                text: 'Result'
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
    $('#containerx1').highcharts({
        data: {
            table: 'datatablex1'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '2G Voice'
        }, subtitle: {
            text: 'RBI = '+d5

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f5, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e5+'<br> Peak Hour : '+a5+' </p>'
            }
        },

        yAxis: {
            title: {
                text: 'Result'
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
    $('#containerz1').highcharts({
        data: {
            table: 'datatablez1'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '3G Data'
        }, subtitle: {
            text: 'RBI = '+d6

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f6, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e6+'<br> Peak Hour : '+a6+' </p>'
            }
        },


        yAxis: {
            title: {
                text: 'Result'
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
    $('#containery1').highcharts({
        data: {
            table: 'datatabley1'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '3G Voice'
        }, subtitle: {
            text: 'RBI = '+d7

        },xAxis: { categories: {
            dataLabels: {
                enabled: true
            }
        },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: f7, // Value of where the line will appear
                width: 2 // Width of the line
            }],
            title:{
                enabled: true,
                text: '<p>Avrage : '+e7+'<br> Peak Hour : '+a7+' </p>'
            }
        },


        yAxis: {
            title: {
                text: 'Result'
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
