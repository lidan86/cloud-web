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

$result = pg_query($conn, "SELECT id, service_group_name
  FROM master_data.new_master_service_group ")
or die ("Query error!");
//$id = str_replace('%20', ' ', $this->uri->segment(3));
$table_name = str_replace('%20', ' ', $this->uri->segment(3));
$type = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));
$ckf = str_replace('%20', ' ', $this->uri->segment(6));
//SELECT table_name, column_name, ne_column_name FROM master_data.view_master_formula where ne_name='CC';
//
//SELECT * FROM raw_sources.bowoTEST('alert_capacity_rnc_cc','max_cc_sp_load','rnc') where weeks=49;

?>

<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header">NE Utilization</h4>
    </div>

</div>

<div class="row">
    <div class="col-md-2"> Service Group</div>
    <div class="col-md-2"> Service Type</div>
    <div class="col-md-2"> NE Type</div>
    <div class="col-md-2"> CKF</div>
</div>
<div class="row">
    <div class="col-md-2">
        <select class="form-control" id="ne_id" name="ne_id" size="4">
            <?php
            while ($row = pg_fetch_array($result)) {
                if(!empty($table_name) && $table_name == $row['id']){
                    echo('<option selected value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'neutil/index/'.$row['id'].'\')">'.$row['service_group_name'].'</option>');

                }else{
                echo('<option value="'.$row['id'].'" onclick="javascript:location.replace(\''. base_url().'neutil/index/'.$row['id'].'\')">'.$row['service_group_name'].'</option>');
                }
            }
            ?>

        </select>
    </div>
    <?php if(!empty($table_name)) {
        ?>
        <div class="col-md-2">

            <select class="form-control" required="true" id="yee" name="yee" size="4">
                <?php
                $yeez = pg_query($conn, "SELECT id, id_service_group, service_type_name
  FROM master_data.new_master_service_type where id_service_group =" . $table_name)
                or die ("Query error!");
                while ($row = pg_fetch_array($yeez)) {
                    if (!empty($table_name) && !empty($type) && $type == $row['id']) {
                        echo('<option selected onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/' . $row['id'] . '\')" value="' . $row['id'] . '" >' . $row['service_type_name'] . '</option>');

                    } else {
                        echo('<option  onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/' . $row['id'] . '\')" value="' . $row['id'] . '" >' . $row['service_type_name'] . '</option>');

                    }
                }
                ?>
            </select>
        </div>
        <?php
        if (!empty($type)) {
            ?>
            <div class="col-md-2">

            <select class="form-control" required="true" id="wee" name="wee" size="4">
            <?php

            $weez = pg_query($conn, "SELECT id, master_service_type_id, master_jenis_ne_id, ne_name
  FROM master_data.new_master_service_path where master_service_type_id = ".$type." order by ne_name ")
            or die ("Query error!");
            while ($row = pg_fetch_array($weez)) {
                if($ne_name == $row['master_jenis_ne_id']){

                    echo('<option selected onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/' . $type . '/'. $row['master_jenis_ne_id'] . '\')" value="' . $row['master_jenis_ne_id'] . '" >' . $row['ne_name'] . '</option>');

                } else {
                    echo('<option  onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/'. $type . '/' . $row['master_jenis_ne_id'] . '\')" value="' . $row['master_jenis_ne_id'] . '" >' . $row['ne_name'] . '</option>');

                }

            }

        ?>

        </select>

        </div>
    <?php
    }
            ?>
        <?php
        if (!empty($ne_name)) {
            ?>
            <div class="col-md-2">

                <select class="form-control" required="true" id="wee" name="wee" size="4">
                    <?php

                    $ck = pg_query($conn, "SELECT ckf_id, ckf FROM master_data.view_master_formula where id_jenis_ne='".$ne_name."'")
                    or die ("Query error!");
                    while ($row = pg_fetch_array($ck)) {
                        if($ckf == $row['ckf_id']){

                            echo('<option selected onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/' . $type . '/'. $ne_name . '/'. $row['ckf_id'] . '\')" value="' . $row['ckf_id'] . '" >' . $row['ckf'] . '</option>');

                        } else {
                            echo('<option  onclick="javascript:location.replace(\'' . base_url() . 'neutil/index/' . $table_name . '/'. $type . '/'. $ne_name . '/'.  $row['ckf_id'] . '\')" value="' . $row['ckf_id'] . '" >' . $row['ckf'] . '</option>');

                        }

                    }

                    ?>

                </select>

            </div>
        <?php
        }?>
    <?php }?>

</div>
<?php
if(!empty($ckf)) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">NE Utilization </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="datatable1" class="table table-bordered">
                <thead>
                <th style="text-align: center">Week</th>
                <th style="text-align: center">Date</th>
                <th style="text-align: center">Ne Name</th>
                <th style="text-align: center" >Utilization</th>
                <th style="text-align: center" >Status</th>


                </thead>
                <tbody>
                <?php
    $colu = pg_query($conn, "SELECT table_name, column_name, ne_column_name
FROM master_data.view_master_formula where id_jenis_ne=".$ne_name)
    or die ("Query error!");
    while ($row = pg_fetch_array($colu)) {
        $table_name = $row['table_name'];
        $column_name = $row['column_name'];
        $ne_column_name = $row['ne_column_name'];
    }

                $list = pg_query($conn, "SELECT * FROM raw_sources.bowoTEST('".$table_name."','".$column_name."','".$ne_column_name."')
where (weeks >=".$weeks." AND weeks <= ".$weeksto."  )and years =".$years)
                or die ("Query error!");
                while ($row = pg_fetch_array($list)) {
                    echo("<tr>");
                    echo ("<td nowrap='nowrap'  align='center'>".$row['weeks']."</td>");
                    echo ("<td nowrap='nowrap'  align='center'>".$row['dated']."</td>");
                    echo ("<td nowrap='nowrap'  align='center'>".$row['ne_name']."</td>");
                    echo("<td nowrap='nowrap' align='center'>".number_format($row['avgutil'],2)."</td>");
                    echo("<td class='styled'><meter min='0' max='100' low='50' high='75' optimum='100' value='" . $row['avgutil'] . "'></meter></td>");

                    echo("</tr>");
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
<?php
}
    ?>