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
$conn = pg_connect($conn_string)
or die("Connection failed!");
$result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne order by ne_name ASC")
or die ("Query error!");
$resultx = pg_query($conn, "SELECT id, region_code, region_name, poc_code, poc_name,
 poi_code, poi_name,
       site_code, site_name, jenis_ne_id, ne_type, ne_name, longitude,
       latitude, kecamatan, kabupaten, provinsi
  FROM master_data.master_ne_area  where id = ".$id." limit 1 ")
or die ("Query error!");
//
while ($row = pg_fetch_array($resultx)) {
    $region_code = $row['region_code'];
    $region_name = $row['region_name'];
    $poc_code = $row['poc_code'];
    $poc_name = $row['poc_name'];
    $poi_code = $row['poi_code'];
    $poi_name = $row['poi_name'];
    $site_code = $row['site_code'];
    $site_name = $row['site_name'];
    $jenis_ne_id = $row['jenis_ne_id'];
    $ne_type = $row['ne_type'];
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];
    $kecamatan = $row['kecamatan'];
    $kabupaten = $row['kabupaten'];
    $provinsi = $row['provinsi'];


}
?>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/nearea/do_update'; ?> ">

                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Jenis Ne</div>
                        <div class=col-md-9>
                            <select class="form-control" id="jenis_ne" name="jenis_ne">
                                <?php
                                while ($row = pg_fetch_array($result)) {
                                    echo("<option value='" . $row['id'] . "'>" . $row['ne_name'] . "</option>");

                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Region Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="region_code" placeholder="Region Code " value="<?php echo $region_code;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Region Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="region_name" placeholder="Region Name " value="<?php echo $region_name;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poi Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="poi_code" placeholder="Poi Code " value="<?php echo $poi_code;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poi Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="poi_name" placeholder="Poi Name " value="<?php echo $poi_name;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poc Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="poc_code" placeholder="Poc Code " value="<?php echo $poc_code;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poc Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="poc_name" placeholder="Poc Name " value="<?php echo $poc_name;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Site Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="site_code" placeholder="Site Code " value="<?php echo $site_code;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Site Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="site_name" placeholder="Site Name " value="<?php echo $site_name;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Ne Type</div>
                        <div class=col-md-9><input type=text class="form-control" name="ne_type" placeholder="Ne Type " value="<?php echo $ne_type;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Longitude</div>
                        <div class=col-md-9><input type=text class="form-control" name="longitude" placeholder="Longitude " value="<?php echo $longitude;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >latitude</div>
                        <div class=col-md-9><input type=text class="form-control" name="latitude" placeholder="Latitude " value="<?php echo $latitude;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Kecamatan</div>
                        <div class=col-md-9><input type=text class="form-control" name="kecamatan" placeholder="Kecamatan " value="<?php echo $kecamatan;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Kabupaten</div>
                        <div class=col-md-9><input type=text class="form-control" name="kabupaten" placeholder="Kabupaten " value="<?php echo $kabupaten;?>"/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Provinsi</div>
                        <div class=col-md-9><input type=text class="form-control" name="provinsi" placeholder="provinsi " value="<?php echo $provinsi;?>"/></div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <br>
                    <div class="footer">
                        <div class="side pull-right">
                            <div class="btn-group">
                                <br>
                                <button class="btn btn-primary" type="submit" > Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
