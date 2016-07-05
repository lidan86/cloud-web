<?php
$query = $this->db->query("SELECT * FROM view_expiry_reservation ");
$sql = $query->result();
?>
<div class="row" style="display: none;">
    <div class="col-md-12">
        <table id="datatable" class="table table-bordered">
            <thead>
            <th>Months</th>
            <th>product_count</th>
            </thead>
            <tbody>
            <?php
            foreach($sql as $row){
                echo("<tr>");
                echo("<td>".strval($row->months)."<br> ".strval($row->years)."</td>");
                echo("<td>".$row->product_count."</td>");
                echo("</tr>");
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="container" style="min-width: 510px; max-width: 1000px; height: 600px; margin: 0 auto"></div>

    </div>
</div>
