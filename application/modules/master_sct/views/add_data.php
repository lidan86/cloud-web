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
                <form method="post" action="<?php echo base_url().'index.php/master_sct/do_insert'; ?> ">

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
                        <div class="col-md-3"  class="form-control" >Minimum Fill Capacity</div>
                        <div class=col-md-9><input type=text class="form-control" name="minimum_fill_capacity" placeholder="Minimum Fill Capacity " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Alert Threshold Capacity</div>
                        <div class=col-md-9><input type=text class="form-control" name="alert_threshold_capacity" placeholder="Alert Threshold Capacity " value=""/></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3"  class="form-control" >Max Capacity Threshold</div>
                        <div class=col-md-9><input type=text class="form-control" name="max_capacity_threshold" placeholder="Max Capacity Threshold" value=""/></div>
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
