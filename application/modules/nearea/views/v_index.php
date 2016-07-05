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
$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."'");
$sql = $query->result();
foreach($sql as $row){
    $weeks = $row->set1;
    $weeksto = $row->set2;
    $years = $row->years;


}

$result = pg_query($conn, "SELECT *
  FROM master_data.master_ne_area ")
or die ("Query error!");

?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">Master Ne Area</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
           <a class="btn btn-info" href="<?php echo base_url();?>nearea/add_data">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo("<table id='datatable2' class='table table-bordered'>");
            echo("<thead  bgcolor='#E0E0E0'>");
            echo("<th nowrap='nowrap' align='center'>Ne Name</th>");
            echo("<th nowrap='nowrap' align='center'>longitude</th>");
            echo("<th nowrap='nowrap' align='center'>latitude</th>");
            echo("<th nowrap='nowrap' align='center'>Kabupaten</th>");
            echo("<th nowrap='nowrap' align='center'>Edit</th>");
            echo("<th nowrap='nowrap' align='center'>Delete</th>");
            echo("</thead>");
            echo("<tbody>");
            while ($row = pg_fetch_array($result)) {

                echo("<tr>");
                echo("<td nowrap='nowrap' align='center'>".$row['ne_name']."</td>");

                echo("<td nowrap='nowrap' align='center'>".$row['longitude']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['latitude']."</td>");
                echo("<td nowrap='nowrap' align='center'>".$row['kabupaten']."</td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."nearea/editData/".$row['id']."'>Edit</a></td>");
                echo("<td nowrap='nowrap' align='center'><a class='btn btn-info' href='".base_url()."nearea/do_delete/".$row['id']."'>Delete</a></td>");
                echo("</tr>");
            }
            echo("</tbody>");
            echo("</table>");
            ?>
        </div>
    </div>