<?php
	$conn_string = "host=192.168.50.91 port=5432 dbname=capman_rdbms user=bajau password=b4j4u123";
	$conn = pg_connect($conn_string)
		or die("Connection failed!");

?>

<html>
<head>
<script src="jquery-2.1.3.min.js"></script>
<style>
body {
	font-size:10pt;	
}
.default {
	margin:5px;
	border:0px;
	padding:0px;
}
.box {
	font-size:10pt;
	padding:12px;
	border:1px solid #555;
}
.nobox {
	padding:0px;
	border:0px;
}
</style>
</head>

<body>
<script src="Highcharts/js/highcharts.js"></script>
<script src="Highcharts/js/modules/data.js"></script>
<script src="Highcharts/js/modules/exporting.js"></script>

