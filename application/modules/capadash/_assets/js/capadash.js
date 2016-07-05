$(function() {
var x = $("#nename").val();
    $('#container').highcharts({
        data: {
            table: 'datatablex'
        },
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Utilization by NE ('+x+')'
        },

        yAxis: {

            title: {
                text: 'Utilization (%)'
            },
            plotLines: [{
                color: 'red', // Color value
                dashStyle: 'longdashdot', // Style of the plot line. Default to solid
                value: 80, // Value of where the line will appear
                width: 2 // Width of the line
            }]
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
    $( "#tabs" ).tabs();
});
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter')

    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
        , source = $('#tabs-1').html()

    // we support special element handlers. Register them with jQuery-style
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors
    // (class, of compound) at this time.
        , specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#buttoned': function(element, renderer){
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        }

    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.addHTML(
        source // HTML string or DOM elem ref.
        , margins.left // x coord
        , margins.top // y coord
        , {
            'width': margins.width // max width of content on PDF
            , 'elementHandlers': specialElementHandlers
        },
        function (dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html
            pdf.save('Test.pdf');
        },
        margins
    )
}
function PrintElem(elem)
{

    Popup(document.all.item(elem).innerHTML);

}

function Popup(data)
{
    var base = $("#base").val();
    var css = "<?php echo base_url(); ?>";

    var mywindow =window.open('', '_blank', 'height=500,width=900');
    mywindow.document.write('<html><head><title>XL</title>');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/stylesheets.css" media="print">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/jquery-ui.css" media="print">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+base+'_assets/css/print.css" media="print">');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10
    setTimeout(function() {
        mywindow.print();
        mywindow.close();

    }, 800);

    return true;
}