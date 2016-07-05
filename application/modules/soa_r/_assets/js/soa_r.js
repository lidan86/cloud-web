$(function () {

    $('#container').highcharts({
        data: {
            table: 'datatablex'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'SOAR CPU %'
        },
        xAxis :{
            labels:{
                rotation: -45
            }
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Utilization (%)'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        tooltip: {
            valueSuffix: ' %'
        },credits: {
            enabled: false
        },

            });

    $('#container2').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'SOAR MEMORY %'
        },
        xAxis :{
            type: 'category',
            labels:{
                rotation: -45
            }
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Utilization (%)'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        tooltip: {
            valueSuffix: ' %'
        }

    });

});

