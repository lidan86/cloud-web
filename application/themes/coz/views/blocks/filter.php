<?php
$we = date('W');
$ye = date('Y');

$user = $this->session->userdata('username');
$query = $this->db->query("select * from filter where username ='".$user."' limit 1");

if($query->num_rows() > 0){
   $sql = $query->result();
   foreach($sql as $row){
		$data = $row->week;
        $datax = $row->years;
       $cat_type = $row->cat_type;
       $category = $row->category;
       $set1    = $row->set1;
       $set2    = $row->set2;

}
}else{
	if(!empty($user)){
		$coba = $this->db->query("INSERT INTO filter (username, years,category,cat_type,set1,set2) VALUES ('$user' ,'$ye','3','1','1' ,'1' )");
		
        $data = $we;
        $datax = $ye;
        $cat_type = 1;
        $category = 1;
		}

}



$uri2 = $this->uri->segment_array();
$cek2 = '';
foreach($uri2 as $row){

    $cek2 .= $row.'/';

}
if(empty($cek2)){
    $cek2 = 'nation';
}
?>
    <div class="col-sm-9 pull-right">
        <form method="post" action="<?php echo base_url().'index.php/service/filter'; ?> ">

            <div class="input-group-addon">

                <input type="hidden" name="uri" value="<?php echo $cek2;?>">
                <input type="hidden" name="sett" id="sett" value="3"  >




                    <div class="col-sm-3">

                        <input type="text" class="form-control" placeholder="From" name="set1" id="set1" value="<?php if(!empty($set1)){echo $set1;}?>">

                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="To" name="set2" id="set2" value="<?php if(!empty($set1)){echo $set2;}?>">

                    </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Search Years" name="year" id="years" value="<?php echo $datax;?>">

                </div>
                <div class="col-sm-2">
                    <select name='cat_type' class="form-control" >
                        <option <?php if($cat_type == 1){ echo "selected"; }?>  value="1"> SMS</option>
                        <option <?php if($cat_type == 2){ echo "selected"; }?> value="2"> Data</option>
                        <option <?php if($cat_type == 3){ echo "selected"; }?> value="3"> Voice</option>
                    </select>
                </div>

                <div class="col-md-1">
                <button class="btn btn-info" id="cek" type="submit"><i class="icon-search"></i></button>
                    </div>
            </div>

        </form>
    </div>
