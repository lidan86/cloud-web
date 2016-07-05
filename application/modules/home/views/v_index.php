<?php
$queryx = $this->db->query("select * from api LIMIT 1");
$sqlx = $queryx->result();
foreach($sqlx as  $row){
    $ip_post = $row->ip_post;
    $port_post = $row->port_post;
    $db_post = $row->db_post;
    $user_post = $row->user_post;
    $pass_post = $row->pass_post;


}
$conn_string = "host=".$ip_post." port=".$port_post." dbname=".$db_post." user=".$user_post." password=".$pass_post."";
$conn = pg_pconnect($conn_string)
or die("Connection failed!");

if(!empty($_POST['search'])) {
    $s = $_POST['search'];
    $que = pg_query("select id,longitude,latitude
								from master_data.master_area
								where
									upper(region_name) like '%".strtoupper($s)."%' or
									upper(poc_name) like '%".strtoupper($s)."%' or
									upper(site_name) like '%".strtoupper($s)."%' or
									upper(bps_kecamatan) like '%".strtoupper($s)."%' or
									upper(bps_kabupaten) like '%".strtoupper($s)."%' or
									upper(bps_provinsi) like '%".strtoupper($s)."%';
								")
    or die ('could not execute query');
    $quecon = pg_query("select count(*) as jumlah
								from master_data.master_area
								where
									upper(region_name) like '%".strtoupper($s)."%' or
									upper(poc_name) like '%".strtoupper($s)."%' or
									upper(site_name) like '%".strtoupper($s)."%' or
									upper(bps_kecamatan) like '%".strtoupper($s)."%' or
									upper(bps_kabupaten) like '%".strtoupper($s)."%' or
									upper(bps_provinsi) like '%".strtoupper($s)."%';
								")
    or die ('could not execute query');
    $rowcon=pg_fetch_array($quecon);
    $count = $rowcon['jumlah'];
    $search = $s;
    $display = "Searching for : <b>".$s."</b>, Found : <b>" . $count . "</b> Locations";
} else {
    $que = pg_query('select id,longitude,latitude from master_data.master_area limit 10')
    or die ('could not execute query');
    $display = "";
}
?>
<div class="row" style='background-color:#E0E0E0;'>
    <div class="col-md-6 pull-left">
        <?php echo($display);?>
    </div>
    <div class="col-sm-4 pull-right">
        <form method="post" action="<?php echo base_url().'index.php/home/index'; ?> ">

            <div class="input-group-addon">




                <div class="col-sm-10">

                    <input type='text' name='search' size='20' maxlength='100' placeholder='Free search'>

                </div>



                <div class="col-md-2">
                    <button class="btn btn-info" id="cek" type="submit"><i class="icon-search"></i></button>
                </div>
            </div>

        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid" >
    <!--    <span style='float:left'>--><?php //echo($display);?><!--</span>-->
    <!--<span style='float:right'>-->
    <!--	<form action='index.php' method='post'>XL Axiata, BTS Locations ::-->
    <!--        <input type='text' name='search' size='20' maxlength='100' placeholder='Free search'>-->
    <!--        <input type='submit' value='Search'></form>-->
    <!--</span>-->
        <div class="row-fluid">
            <div class="span12">
                <div id="map" class="map"></div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">

    var lon2meters = function(lon) {
        var x = lon * 20037508.34 / 180;
        return [x]
    }
    var lat2meters = function(lat) {
        var y = Math.log(Math.tan((90 + lat) * Math.PI / 360)) / (Math.PI / 180);
        y = y * 20037508.34 / 180;
        return [y]
    }

    var image = new ol.style.Circle({
        radius: 5,
        fill: new ol.style.Fill({
            color: 'green',
            opacity: 0.2
        }),
        stroke: new ol.style.Stroke({color: 'black', width: 1})
    });

    var styles = {
        'Point': [new ol.style.Style({
            image: image
        })],
        'LineString': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'green',
                width: 1
            })
        })],
        'MultiLineString': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'green',
                width: 1
            })
        })],
        'MultiPoint': [new ol.style.Style({
            image: image
        })],
        'MultiPolygon': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'yellow',
                width: 1
            }),
            fill: new ol.style.Fill({
                color: 'rgba(255, 255, 0, 0.1)'
            })
        })],
        'Polygon': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'blue',
                lineDash: [4],
                width: 3
            }),
            fill: new ol.style.Fill({
                color: 'rgba(0, 0, 255, 0.1)'
            })
        })],
        'GeometryCollection': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'magenta',
                width: 2
            }),
            fill: new ol.style.Fill({
                color: 'magenta'
            }),
            image: new ol.style.Circle({
                radius: 10,
                fill: null,
                stroke: new ol.style.Stroke({
                    color: 'magenta'
                })
            })
        })],
        'Circle': [new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'red',
                width: 2
            }),
            fill: new ol.style.Fill({
                color: 'rgba(255,0,0,0.2)'
            })
        })]
    };

    var styleFunction = function(feature, resolution) {
        return styles[feature.getGeometry().getType()];
    };

    var geojsonObject = {
        'type': 'FeatureCollection',
        'crs': {
            'type': 'name',
            'properties': {
                'name': 'EPSG:4326'
            }
        },
        'features': [
            <?php
            while($row=pg_fetch_array($que)) {
            //echo($row['longitude']." - ".$row['latitude']."<br>");
            ?>
            {
                'type': 'Feature',
                'geometry': {
                    'type': 'Point',
                    'coordinates': [lon2meters(<?php echo($row['longitude']);?>),lat2meters(<?php echo($row['latitude']);?>)]
                },
                'properties': {'id': <?php echo($row['id']);?>,'popupContent': 'id='+<?php echo($row['id']);?>}
            },
            <?php } ?>
        ]
    };

    var vectorSource = new ol.source.Vector({
        features: (new ol.format.GeoJSON()).readFeatures(geojsonObject)
    });

    //vectorSource.addFeature(new ol.Feature(new ol.geom.Circle([115,-2], 1e6)));

    var vectorLayer = new ol.layer.Vector({
        source: vectorSource,
        style: styleFunction
    });

    var map = new ol.Map({
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
            vectorLayer,
        ],
        target: 'map',
        controls: ol.control.defaults({
            attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                collapsible: false
            })
        }),
        view: new ol.View({
            center: [lon2meters(121.81640625000001),lat2meters(-2.02106511876699)],
            zoom: 5
        })
    });


</script>