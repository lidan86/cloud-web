$(function () {
    var week = $("#week").val();
    var year = $("#year").val();
    var str = "Week "+week+" Year "+year;
    document.getElementById("headerWeek").innerHTML = str;
});