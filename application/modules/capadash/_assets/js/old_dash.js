$(document).ready(function(){
    var icons = {
        header: "ui-icon-circle-arrow-e",
        activeHeader: "ui-icon-circle-arrow-s"
    };

    var api ;
    api = $("#api").val();
    $("#menu").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: "content" });
    var service = api+"CapmanApi/Service";
    $.getJSON(service,
        function (data) {

            var tr;
            for (var i = 0; i < data.length; i++) {

                var tblRow = "<h3>"+data[i].service_group+"</h3> <div class='row'> <table class='table table-bordered' id='entrydata"+i+"'><thead> <th>Region</th><th>POC</th><th>Utilization</th><th>Max Utilization</th><th>Percen %</th> </thead><tbody id='datable-"+i+"'></tbody> </table> </div>";
                $(tblRow).appendTo("#accordion");

            }
            $("#accordion").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

        });


    $("#cek").click(function() {

        $("#entrydata0 tbody").empty();
        $("#entrydata1 tbody").empty();
        $("#entrydata2 tbody").empty();
        $("#entrydata3 tbody").empty();
        $("#entrydata4 tbody").empty();
        $("#entrydata5 tbody").empty();
        $("#entrydata6 tbody").empty();
        $("#entrydata7 tbody").empty();
        $("#entrydata8 tbody").empty();
        $("#entrydata9 tbody").empty();



        var week = $("#week").val();
        var str = "Week "+week;


        document.getElementById("headerWeek").innerHTML = str;
        dmJSON2 = api+"CapmanApi/Api?service=3G Data Service&weeks="+week;
        dmJSON = api+"CapmanApi/Api?service=2G Data Service&&weeks="+week;
        dmJSON3 = api+"CapmanApi/Api?service=3G Roaming Service&weeks="+week;
        dmJSON4 = api+"CapmanApi/Api?service=2G Roaming Service&&weeks="+week;
        dmJSON5 = api+"CapmanApi/Api?service=3G BB Service&weeks="+week;
        dmJSON6 = api+"CapmanApi/Api?service=2G BB Service&&weeks="+week;
        dmJSON7 = api+"CapmanApi/Api?service=3G Voice Service&weeks="+week;
        dmJSON8 = api+"CapmanApi/Api?service=2G Voice Service&&weeks="+week;
        dmJSON9 = api+"CapmanApi/Api?service=Vas Service&weeks="+week;
        dmJSON10 = api+"CapmanApi/Api?service=IT Service&weeks="+week;
//console.log("test json= "+dmJSON);
        $.getJSON(dmJSON2,
            function (json2) {

                var tr;
                for (var i = 0; i < json2.length; i++) {


                    var tblRow = "<tr>" + "<td>" + json2[i].region_name + "</td>" + "<td>" + json2[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json2[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json2[i].max_utilization + "</td>" +  "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json2[i].percen+"'></meter> " + json2[i].percen +" % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata0 tbody");

                }
            });
        $.getJSON(dmJSON,
            function (json) {

                var tr;
                for (var i = 0; i < json.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json[i].region_name + "</td>" + "<td>" + json[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json[i].percen+"'></meter> " + json[i].percen + " % </td>" +"</tr>";
                    $(tblRow).appendTo("#entrydata1 tbody");


                }
            });
        $.getJSON(dmJSON3,
            function (json3) {

                var tr;
                for (var i = 0; i < json3.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json3[i].region_name + "</td>" + "<td>" + json3[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json3[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json3[i].max_utilization + "</td>" +  "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json3[i].percen+"'></meter> " + json3[i].percen + " % </td>" +"</tr>";
                    $(tblRow).appendTo("#entrydata2 tbody");


                }
            });
        $.getJSON(dmJSON4,
            function (json4) {

                var tr;
                for (var i = 0; i < json4.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json4[i].region_name + "</td>" + "<td>" + json4[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json4[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json4[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json4[i].percen+"'></meter>" + json4[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata3 tbody");


                }
            });
        $.getJSON(dmJSON5,
            function (json5) {

                var tr;
                for (var i = 0; i < json5.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json5[i].region_name + "</td>" + "<td>" + json5[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json5[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json5[i].max_utilization + "</td>" +  "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json5[i].percen+"'></meter>" + json5[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata4 tbody");


                }
            });
        $.getJSON(dmJSON6,
            function (json6) {

                var tr;
                for (var i = 0; i < json6.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json6[i].region_name + "</td>" + "<td>" + json6[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json6[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json6[i].max_utilization + "</td>" +  "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json6[i].percen+"'></meter>" + json6[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata5 tbody");


                }
            });
        $.getJSON(dmJSON7,
            function (json7) {

                var tr;
                for (var i = 0; i < json7.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json7[i].region_name + "</td>" + "<td>" + json7[i].poc_name + "</td>" + "<td style='text-align: center;'>" + json7[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json7[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json7[i].percen+"'></meter>" + json7[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata6 tbody");


                }
            });
        $.getJSON(dmJSON8,
            function (json8) {

                var tr;
                for (var i = 0; i < json8.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json8[i].region_name + "</td>" + "<td>" + json8[i].poc_name + "</td>" + "<td style='text-align: center;' >" + json8[i].min_utilization + "</td>" + "<td style='text-align: center;'> " + json8[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json8[i].percen+"'></meter>" + json8[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata7 tbody");


                }
            });
        $.getJSON(dmJSON9,
            function (json9) {

                var tr;
                for (var i = 0; i < json9.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json9[i].region_name + "</td>" + "<td>" + json9[i].poc_name + "</td>" + "<td style='text-align: center;' >" + json9[i].min_utilization + "</td>" + "<td style='text-align: center;' > " + json9[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json9[i].percen+"'></meter>" + json9[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata8 tbody");


                }
            });
        $.getJSON(dmJSON10,
            function (json10) {

                var tr;
                for (var i = 0; i < json10.length; i++) {

                    var tblRow = "<tr>" + "<td>" + json10[i].region_name + "</td>" + "<td>" + json10[i].poc_name + "</td>" + "<td style='text-align: center;' >" + json10[i].min_utilization + "</td>" + "<td style='text-align: center;' > " + json10[i].max_utilization + "</td>" + "<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='"+json10[i].percen+"'></meter>" + json10[i].percen + " % </td>" + "</tr>";
                    $(tblRow).appendTo("#entrydata9 tbody");


                }
            });

    });




});;;