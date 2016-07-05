/**
 * Created by root on 1/21/15.
 */
$(function() {
    var icons = {
        header: "ui-icon-circle-arrow-e",
        activeHeader: "ui-icon-circle-arrow-s"
    };
    $("#accordion2").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

    var service = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=3G Data Service";
    $.getJSON(service,
        function (data) {

            var tr;

            for (var i = 0; i < data.length; i++) {
                var tblRow2;
                if(data[i].ne_name == "NodeB"){
                    table = "http://192.168.50.93:8088/CapmanApi/Data_3G?data=UTILIZATION_CKF&ne_name="+data[i].ne_name+"&weeks=49";
                    $.getJSON(table,
                        function (json) {

                            //console.log(data[i].ne_name);

                            if(json[0].max_utilization >=75){
                                tblRow2 = "<table class='table table-bordered'><tr><td>"+json[0].ne+"</td><td style='text-align: center;' bgcolor='#FF0000'>"+json[0].max_utilization+"</td></tr></table> </div>";
                                json.push(tblRow2);
                            }else if(json[0].max_utilization >= 50 && json[0].max_utilization < 75 ){
                                tblRow2 = "<table class='table table-bordered'><tr><td>"+json[0].ne+"</td><td style='text-align: center;' bgcolor='#FFCC00'>"+json[0].max_utilization+"</td></tr></table> </div>";
                                json.push(tblRow2);
                            }else {
                                tblRow2 = "<table class='table table-bordered'><tr><td>"+json[0].ne+"</td><td style='text-align: center;' bgcolor='#00FF00'>"+json[0].max_utilization+"</td></tr></table> </div>";
                                json.push(tblRow2);
                            }



                        });
                }else{
                    tblRow2="";
                }
                console.log(json);
                var tblRow = "<h3>"+data[i].ne_name+"</h3> <div class='row'><div class='col-md-12'><div id='3gdata"+i+"'>"+tblRow2+"</div></div></div>"
                $(tblRow).appendTo("#accordion");

            }
            $("#accordion").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

        });

    var service2 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=2G Data Service";
    $.getJSON(service2,
        function (data2) {

            var tr;
            for (var i = 0; i < data2.length; i++) {

                var tblRow = "<h3>"+data2[i].ne_name+"</h3> <div class='row'><div class='col-md-12'><div id='2gdata"+i+"'></div></div> </div>"
                $(tblRow).appendTo("#accordion3");

            }
            $("#accordion3").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

        });
    service3 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=3G Data Roaming Service";
    service4 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=2G Data Roaming Service";
    //service5 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=3G Data BB Service";
    //service6 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=2G Data BB Service";
    //service7 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=3G Voice Service";
    //service8 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=2G Voice Service";
    //service9 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=Vas Service";
    //service10 = "http://192.168.50.93:8088/CapmanApi/ServicePath?service_group=IT Service";

    $.getJSON(service3,
        function (data3) {

            var tr;
            for (var i = 0; i < data3.length; i++) {

                var tblRow = "<h3>"+data3[i].ne_name+"</h3> <div class='row'><div class='col-md-12'><div id='3groaming"+i+"'></div></div>  </div>"
                $(tblRow).appendTo("#accordion4");

            }
            $("#accordion4").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

        });
    $.getJSON(service4,
        function (data4) {

            var tr;
            for (var i = 0; i < data4.length; i++) {

                var tblRow = "<h3>"+data4[i].ne_name+"</h3> <div class='row'><div class='col-md-12'><div id='2groaming"+i+"'></div></div>  </div>"
                $(tblRow).appendTo("#accordion5");

            }
            $("#accordion5").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });

        });
    //$.getJSON(service5,
    //    function (data5) {
    //
    //        var tr;
    //        for (var i = 0; i < data5.length; i++) {
    //
    //            var tblRow = "<h3>"+data5[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion6");
    //
    //        }
    //        $("#accordion6").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });
    //$.getJSON(service6,
    //    function (data6) {
    //
    //        var tr;
    //        for (var i = 0; i < data6.length; i++) {
    //
    //            var tblRow = "<h3>"+data6[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion7");
    //
    //        }
    //        $("#accordion7").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });
    //$.getJSON(service7,
    //    function (data7) {
    //
    //        var tr;
    //        for (var i = 0; i < data7.length; i++) {
    //
    //            var tblRow = "<h3>"+data7[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion8");
    //
    //        }
    //        $("#accordion8").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });
    //$.getJSON(service8,
    //    function (data8) {
    //
    //        var tr;
    //        for (var i = 0; i < data8.length; i++) {
    //
    //            var tblRow = "<h3>"+data8[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion9");
    //
    //        }
    //        $("#accordion9").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });
    //$.getJSON(service9,
    //    function (data9) {
    //
    //        var tr;
    //        for (var i = 0; i < data9.length; i++) {
    //
    //            var tblRow = "<h3>"+data9[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion10");
    //
    //        }
    //        $("#accordion10").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });
    //$.getJSON(service10,
    //    function (data10) {
    //
    //        var tr;
    //        for (var i = 0; i < data10.length; i++) {
    //
    //            var tblRow = "<h3>"+data10[i].ne_name+"</h3> <div class='row'> </div>"
    //            $(tblRow).appendTo("#accordion11");
    //
    //        }
    //        $("#accordion11").accordion({collapsible: true, clearStyle: true,  icons: icons, heightStyle: content });
    //
    //    });



});

