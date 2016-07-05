$(function () {
    var cat = $('#type').val();
    var title = $('#title').val();
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Instaled Capacity '+cat
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
            formatter: function () {
                return '<b>Ne Name</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }
    });


    $('#containerx').highcharts({
        data: {
            table: 'datatable1'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Current Utilization '+cat
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
            formatter: function () {
                return '<b>Ne Name</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }

    });


    $('#containery').highcharts({
        data: {
            table: 'datatable2'
        },
        chart: {
            type: 'column'
        },
        title: {
            text:'Capacity Used '+cat
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Traffic'
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
            formatter: function () {
                return '<b>Ne Name</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }
    });
    $('#container2').highcharts({
        data: {
            table: 'datatable3'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: title
        },

        yAxis: {
            allowDecimals: false,
            title: {

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
            formatter: function () {
                return '<b>Ne Name</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }
    });
});