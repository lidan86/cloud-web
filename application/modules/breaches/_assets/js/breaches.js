$(function () {
    var week = $("#ne").val();
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: "Product Expiry"
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'product'
            }
        },
        tooltip: {

        }
    });
});