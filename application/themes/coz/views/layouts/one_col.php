<!DOCTYPE html>
<?php
//error_reporting(0);
//ini_set('displays_errors',0);
?>
<html lang="en">
<?php echo $template['partials']['header']; ?>
<body class="bg-img-num1">
<input type="hidden" id="themesch" value="<?php echo img_url(); ?>sand.png">
    <div class="container">        
        <div class="row">                   
            <div class="col-md-12">                
                <nav class="navbar brb" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-reorder"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>_assets/imglogo.png"/></a>                                                                                     
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <?php echo $template['partials']['nav'];?>
                    </div>
                </nav>
            </div>            
        </div>
<!--        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li><a href="#">Components</a></li>                    
                    <li class="active">Icons</li>
                </ol>
            </div>
        </div>        -->
        
        <div class="row">
            <div class="col-md-2">
                <div class="block block-drop-shadow">
                    <div class="user bg-default bg-light-rtl">
                        <div class="header">
                        <h2><?php echo $this->session->userdata('fullname'); ?></h2>
                        <div class="side pull-right">                            
                            <ul class="buttons">
                                <li><a data-original-title="Toggle content" href="#" class="block-toggle tip" title=""><span class="icon-chevron-down"></span></a></li>
                                <li><a data-original-title="Remove block" href="#" class="block-remove tip" title=""><span class="icon-remove"></span></a></li>
                            </ul>
                        </div>                        
                        </div>
                        <div class="info">                                                                                

                            <img src="<?php echo Modules::run('options/settings/get_pic'); ?>" class="img-circle img-thumbnail">
                        </div>
                    </div>
                    <div class="content list-group list-group-icons">
                        <a data-toggle="modal" href="<?php echo base_url() ?>msg/mailbox" class="list-group-item"><span class="icon-envelope"></span>Messages</a>
                        <a href="#" class="list-group-item"><span class="icon-bar-chart"></span>Statistic<i class="icon-angle-right pull-right"></i></a>
                        <a href="#" class="list-group-item"><span class="icon-cogs"></span>Settings<i class="icon-angle-right pull-right"></i></a>
                        <a href="<?php echo base_url() ?>logout" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
				<?php $urix = $this->uri->segment_array();
				if(empty($urix[1])){
                    $urix[1] = 'home';
					}
				if($urix[1] == 'breaches'||$urix[1] == 'home' || $urix[1] == 'carf' || $urix[1] == 'master' ){?>
                <div class="block  ">
					<?php }else{?>
						<div class="block block-fill-white ">
						<?php }?>
                    <div class="content" style="padding-left: 20px; padding-right: 30px;">
                <?php
                $uri = $this->uri->segment_array();
                foreach($uri as $row){

                    $cek = $row;
                    break;

                }
                if(empty($cek)){
                    $cek = 'home';
                }
                $rule = $cek;
                $queryx = $this->db->query("select api from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                }
                if($rule == 'capman'||$rule == 'sellable' ||$rule == 'logpath' || $rule == 'modifyservicep' ||$rule== 'breaches'||$rule == 'msg'|| $rule == 'home'||$rule == 'carf'||$rule == 'cvp' || $rule == 'navigation' || $rule == 'role' || $rule == 'auth' || $rule == 'cost' || $rule == 'revenue' || $rule == 'master'){
                    ?>


                <?php } else{?>
                    <div class="block block-fill-white">
                        <div class="container">
                            <div class="row">
                                <?php echo $template['partials']['filter'];?>

                            </div>
                        </div>
                    </div>
                        <?php }?>

            <?php echo $template['partials']['message']; ?>
            <?php echo $template['body']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo Modules::run('options/msg'); ?>
    </div>
    
       
<?php // echo $template['partials']['javascript']; ?>
<div class="row">
<?php echo $template['partials']['copyright'];?>   
</div>
<?php // echo Modules::run('navigation/build', $active); ?> 
     
    
</body>
</html>
