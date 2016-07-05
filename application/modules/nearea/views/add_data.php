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

?>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data</h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/nearea/do_insert'; ?> ">

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
                        <div class=col-md-9><input type=text class="form-control" name="region_code" placeholder="Region Code " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Region Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="region_name" placeholder="Region Name " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poi Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="poi_code" placeholder="Poi Code " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poi Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="poi_name" placeholder="Poi Name " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poc Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="poc_code" placeholder="Poc Code " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Poc Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="poc_name" placeholder="Poc Name " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Site Code</div>
                        <div class=col-md-9><input type=text class="form-control" name="site_code" placeholder="Site Code " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Site Name</div>
                        <div class=col-md-9><input type=text class="form-control" name="site_name" placeholder="Site Name " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Ne Type</div>
                        <div class=col-md-9><input type=text class="form-control" name="ne_type" placeholder="Ne Type " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Longitude</div>
                        <div class=col-md-9><input type=text class="form-control" name="longitude" placeholder="Longitude " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >latitude</div>
                        <div class=col-md-9><input type=text class="form-control" name="latitude" placeholder="Latitude " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Kecamatan</div>
                        <div class=col-md-9><input type=text class="form-control" name="kecamatan" placeholder="Kecamatan " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Kabupaten</div>
                        <div class=col-md-9><input type=text class="form-control" name="kabupaten" placeholder="Kabupaten " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Provinsi</div>
                        <div class=col-md-9><input type=text class="form-control" name="provinsi" placeholder="provinsi " value=""/></div>
                    </div>
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
