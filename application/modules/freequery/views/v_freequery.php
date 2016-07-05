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

$result = pg_query($conn, "SELECT table_name FROM information_schema.tables WHERE table_schema='raw_sources' AND table_type='BASE TABLE' ")
or die ("Query error!");
$table_name = str_replace('%20', ' ', $this->uri->segment(3));
$tahun = str_replace('%20', ' ', $this->uri->segment(4));
$ne_name = str_replace('%20', ' ', $this->uri->segment(5));

?>
<form method="post" action="<?php echo base_url().'index.php/freequery/do_insert'; ?> ">

<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header">Customizeable Dashboard</h4>
    </div>

</div>

<div class="row">
    <div class="col-md-2"> Table Name</div>
    <div class="col-md-2"> Year</div>
    <div class="col-md-2"> Week</div>
    <div class="col-md-2"> CKF Name</div>
    <div class="col-md-2"> Agregation</div>
    <div class="col-md-2"> Chart Type</div>
</div>
<div class="row">
    <div class="col-md-2">
        <select class="form-control" id="ne_id" name="ne_id" size="4">
            <?php
            while ($row = pg_fetch_array($result)) {
                if(!empty($table_name) && $table_name == $row['table_name']){
                    echo('<option selected value="'.$row['table_name'].'" onclick="javascript:location.replace(\''. base_url().'freequery/index/'.$row['table_name'].'\')">'.$row['table_name'].'</option>');

                }else{
                echo('<option value="'.$row['table_name'].'" onclick="javascript:location.replace(\''. base_url().'freequery/index/'.$row['table_name'].'\')">'.$row['table_name'].'</option>');
                }
            }
            ?>

        </select>
    </div>
    <?php if(!empty($table_name)){
        ?>
        <div class="col-md-2">

            <select class="form-control" required="true" id="yee" name="yee" size="4">
                <?php
                $yeez = pg_query($conn, "select extract(year from dated) as weeks from raw_sources.".$table_name." group by extract(year from dated) order by  extract(year from dated) ")
                or die ("Query error!");
                while ($row = pg_fetch_array($yeez)) {
                    if (!empty($table_name)&& !empty($tahun) && $tahun == $row['weeks']) {
                        echo('<option selected onclick="javascript:location.replace(\'' . base_url() . 'freequery/index/' . $table_name . '/' . $row['weeks'] . '\')" value="' . $row['weeks'] . '" >' . $row['weeks'] . '</option>');

                    }else{
                        echo('<option  onclick="javascript:location.replace(\'' . base_url() . 'freequery/index/' . $table_name . '/' . $row['weeks'] . '\')" value="' . $row['weeks'] . '" >' . $row['weeks'] . '</option>');

                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-2">

            <select class="form-control" required="true" id="wee" name="wee" size="4">
                <?php
                if(!empty($tahun)) {
                    $weez = pg_query($conn, "select extract(week from dated) as weeks from raw_sources." . $table_name . " where extract(year from dated)=".$tahun." group by extract(week from dated) order by  extract(week from dated) ")
                    or die ("Query error!");
                    while ($row = pg_fetch_array($weez)) {

                        echo('<option value="' . $row['weeks'] . '" >' . $row['weeks'] . '</option>');

                    }
                }
                ?>

            </select>

        </div>

        <div class="col-md-2">
            <select class="form-control" id="column_name" required="true" name="column_name[]" size="4" multiple>
                <?php
                $colum = pg_query($conn, "SELECT column_name FROM information_schema.columns WHERE table_schema = 'raw_sources'  and table_name='".$table_name."' and (data_type = 'integer' or data_type='double precision' )")
                or die ("Query error!");
                while ($row = pg_fetch_array($colum)) {
                    if($row['column_name'] != 'id' && $row['column_name'] != 'dated' ){
                        echo('<option value="'.$row['column_name'].'" >'.$row['column_name'].'</option>');

                    }

                }
                ?>

            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" id="agregatio" required="true" name="agregatio" size="4">
                <option value="max">Max</option>
                <option value="min">Min</option>
                <option value="avg">Avarage</option>
            </select></div>




        <div class="col-md-2">

            <select class="form-control" required="true" id="chart_type" name="chart_type" size="4">
                <option value="bar">Bar</option>
                <option value="column">Column</option>
                <option value="line">line</option>
            </select>
        </div>
    <?php }?>


</div>
    <div class="row">
        <div class="col-md-4">Dashboard Name</div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <input type="text" id="dashboard" name="dashboard" required="true" placeholder="Chart / Dashboard Name">
        </div>
    </div>
<div class="row" >
    <div class="side pull-right" style="margin-right: 10px;">
        <div class="btn-group">
            <button class="btn btn-primary" type="submit" >Save </button>

        </div>
    </div>


</div>
</form>
<div class="row" >
    <div class="col-md-12">
        <h4 class="page-header">List Data Freequery</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="datatable1" class="table table-bordered">
            <thead>
            <th>Name Dashboard</th>
            <th>Week</th>
            <th>Year</th>
            <th>Chart Type</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php
            $list = pg_query($conn, "SELECT id, dashboard_name, chart_type, weeks, years FROM public.dashboard_free_query ")
            or die ("Query error!");
            while ($row = pg_fetch_array($list)) {
                echo("<tr>");
                echo("<td>".$row['dashboard_name']."</td><td>".$row['weeks']."</td>");
                echo("<td>".$row['years']."</td><td>".$row['chart_type']."</td>");
                echo("<td><a class='btn btn-info' href='".base_url()."freequery/result/".$row['id']."'>View Table & Chart</a>&nbsp; <a class='btn btn-danger' href='".base_url()."freequery/delete/".$row['id']."'>Delete Table & Chart</a></td>");
                echo("</tr>");
            }
            ?>

            </tbody>
        </table>
    </div>
</div>