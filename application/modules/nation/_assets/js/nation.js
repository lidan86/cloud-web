$(function () {

    $( "#tabs" ).tabs({
        active: false,
        collapsible: true,
        beforeActivate: function (event, ui) {
            window.open($(ui.newTab).find('a').attr('href'), '_self');
            return false;
        }
    });
    var nename = $('#nename').val();
    var sgname = $('#sgname').val();

    var week = $("#week").val();
    var year = $("#year").val();
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'bar'
        },
        title: {
            text: 'ALL SERVICES NATION WIDE'
        },
        subtitle: {
            text: 'Week '+week+' Year '+year
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
                return '<b>Utilization</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }
    });


    $('#container2').highcharts({
        data: {
            table: 'datatable2'
        },
        chart: {
            type: 'bar'
        },
        title: {
            text: 'All Service by '+sgname
        },
        subtitle: {
            text: 'Week '+week+' Year '+year
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
                return '<b>CKF</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }

    });


    $('#containerx').highcharts({
        data: {
            table: 'datatablex'
        },
        chart: {
            type: 'bar'
        },
        title: {
            text:'NE CKF BY '+nename
        },
        subtitle: {
            text: 'Week '+week+' Year '+year
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Utilization'
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
                return '<b>CKF</b><br/>' +
                    this.point.y + '% ' + this.point.name.toLowerCase();
            }
        }
    });
});
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addHTML($('#convertPdf')[0], function () {
        pdf.save('Test.pdf');
    });

}
function PrintElem(elem)
{

    Popup($(elem).html());

}

function Popup(data)
{
    var base = $("#base").val();
    var css = "<?php echo base_url(); ?>";

    var mywindow =window.open('', '', 'height=500,width=900');
    mywindow.document.write('<html><head><title>XL</title>');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/bootstrap.css" media="all">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/myBootstrap.css" media="all">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/jquery-ui.css" media="all">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/style.css" media="all">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/print.css" media="all">');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10
    setTimeout(function() {
        mywindow.print();
        mywindow.close();

    }, 100);

    return true;
}
