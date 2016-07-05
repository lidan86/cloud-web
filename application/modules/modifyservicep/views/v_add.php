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
$result = pg_query($conn, "SELECT * FROM master_data.new_master_jenis_ne ")
or die ("Query error!");
$i = str_replace('%20', ' ', $this->uri->segment(3));
$ii = str_replace('%20', ' ', $this->uri->segment(4));
$iii = str_replace('%20', ' ', $this->uri->segment(5));

?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Change Network Element</h4>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="block">
            <div class="header">
                <h4 class="page-header">Add Data Column </h4>
            </div>
            <div class="content controls">
                <form method="post" action="<?php echo base_url().'index.php/modifyservicep/do_insert'; ?> ">

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
                        <div class="col-md-3"  class="form-control" >Type</div>
                        <div class=col-md-9>
                            <select class="form-control" id="type" name="type">
                                <option value="1">Traffic</option>
                                <option value="2">Signal</option>
                            </select>
                        </div>

                    </div>
                    <input type="hidden" id="service_type" name="service_type" value="<?php echo $i;?>">
                    <input type="hidden" id="column_number" name="column_number" value="<?php echo $ii;?>">
                    <input type="hidden" id="last_column" name="last_column" value="<?php echo $iii;?>">

                    <div class="footer">
                        <div class="side pull-right">
                            <div class="btn-group">
                                <br>
                                <button class="btn btn-primary" type="submit" ><i class="icon-save"></i> Update</button>
                                <a class="btn btn-warning" href="<?php echo base_url();?>modifyservicep"><i class="icon-refresh"></i> Cancel</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>