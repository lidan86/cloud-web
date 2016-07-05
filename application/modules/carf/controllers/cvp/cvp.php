<?php
class cvp extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('m_carf');
    }
    public function index(){
        $data['get_capacity']        = '';
        $crud = $this->new_crud();
        if($this->session->userdata['group_id'] == '9'){//capmanager
            $crud->or_where('approval',4)->or_where('approval',5)->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '7'){//CMDB
            $crud->or_where('approval',5)->or_where('approval',5)->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '11'){//BRM
            $crud->or_where('approval',5);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '12'){//IT PLan
            $crud->or_where('approval',5)->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '5'){//Network plan
            $crud->or_where('approval',5)->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '5'){//Net Plan
            $crud->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '8'){//Prodev
            $crud->or_where('approval',5)->or_where('approval',7);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_cvp();
        }
        if($this->session->userdata['group_id'] == '1'){//administrator
        }
        $crud->set_table('carf');
        $crud->set_subject('(CARF) - Capacity Verification Proses');
        $crud->columns('project_name');
//                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
        $crud->unset_export();$crud->unset_print();
        $crud->unset_back_to_list();
        $crud->edit_fields('service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
                'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
                'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
                'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
                'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value');
        $crud->callback_column('project_name',array($this,'_callback_action'));
        $data['gcrud'] = $crud->render();
        $this->template->build('cvp/v_cvp', $data);
    }
    public function _callback_action($value, $row){
        $reject='';$ica = $row->it_cap_available; $nca = $row->net_cap_available;
        if ($nca == 'Capacity not available'){
            $reject=' - REJECT by Network Capacity';
        }
        if ($ica == 'Capacity not available'){
            $reject=' - REJECT by Network Capacity';
        }
        $lvl_approval=$row->approval;
        $from = new DateTime($row->created_at); $to = new DateTime(date('Y-m-d H:i:s'));
        $diff = $to->diff($from);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array('y' => 'thn','m' => 'bln','w' => 'mng','d' => 'hr','h' => 'jam','i' => 'mnt','s' => 'dtk',);
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        } 
        $waktu = $string ? implode(', ', $string) . ' lalu' : 'baru saja';
        $pesan='';$status='';$icons='';$lvlapproval='';$tombol='';
        $status1 = '
            <div class="btn-group">
            <button type="button" class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                    Process to <span class="caret"></span>
                                    </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/cvp/req_new_service/'.$row->id.'">New Service</a></li>
                    <li><a href="'.base_url().'carf/cvp/req_bau_request/'.$row->id.'">BAU Request</a></li>
                    <li><a class="icon-file-text" href="'.base_url().'master/document/index/'.$row->id.'"> Document</a></li>   
                    <li class="divider"></li><li><!-- start message -->
                    </li>
                </ul>
            </div>';
        if ($lvl_approval == 5) {            
//            if ($reject==''){
//                $lvlapproval='Type = New Service';
//            }else{
                $lvlapproval='Type = New Service'.$reject;
//            }
            if ($this->session->userdata['group_id']==9){//capman
                $icons=  '<a title="Document capture" href="'.base_url().'master/document/cvp/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-picture"></span></a>'
                        .'<a title="Finalize Service Path" href="'.base_url().'carf/cvp/fsp/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-picture"></span></a>'
                        . '<a title="Reserve Capacity" href="'.base_url().'carf/cvp/recap/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Capture the Closer" href="'.base_url().'carf/cvp/capclos/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Cost to Deliver & Capacity Reserveation" href="'.base_url().'carf/cvp/cost/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Publish to Post launch" href="plma/ma/publish/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-laptop"></span></a>'
                        ;
            }
            if ($this->session->userdata['group_id']==7){//cmdb
                $icons=  '<a title="Document capture" href="'.base_url().'master/document/cvp/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-picture"></span></a>'
                        .'<a title="Finalize Service Path" href="'.base_url().'carf/cvp/fsp/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-picture"></span></a>'
                        . '<a title="Reserve Capacity" href="'.base_url().'carf/cvp/recap/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Capture the Closer" href="'.base_url().'carf/cvp/capclos/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Cost to Deliver & Capacity Reserveation" href="'.base_url().'carf/cvp/cost/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        ;
            }
            if ($this->session->userdata['group_id']==11){//brm
                $icons=  '<a title="Validate IT Service Path" href="'.base_url().'master/document/cvp/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-list-alt"></span></a>'
                        ;
            }
            if ($this->session->userdata['group_id']==13){//network engineer
                $icons=  '<a title="Validate IT Service Path" href="'.base_url().'master/document/cvp/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-list-alt"></span></a>'
                        ;
            }
            if($this->session->userdata['group_id']==12){//itplan
                $icons=  '<a title="IT Capacity Assessment" href="'.base_url().'carf/cvp/itca/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        ;
            }
            if($this->session->userdata['group_id']==5){//NetPlan 
                $icons=  '<a title="Network Capasity Assessment" href="'.base_url().'carf/cvp/nca/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        ;
            }
            $status='';$status1='';
            
        }
        if ($lvl_approval == 7) {
//            if ($reject==''){
                $lvlapproval='Type = BAU Request'.$reject;
//            }else{
//                $lvlapproval='Status = REJECT - Capacity not available';
//            }
            if ($this->session->userdata['group_id']==9 || $this->session->userdata['group_id']==7){ //capmanager
                $icons=  '<a title="Communication Plan & User Experience" href="'.base_url().'carf/cvp/spi/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Reserve Capacity" href="'.base_url().'carf/cvp/recap/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Capture the Closer" href="'.base_url().'carf/cvp/capclos/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Cost to Deliver & Capacity Reserveation" href="'.base_url().'carf/cvp/cost/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        . '<a title="Publish to Post launch" href="plma/ma/publish/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-laptop"></span></a>'
                        ;
                $tombol='
                    <li><a class="icon-file-text" href="'.base_url().'carf/cvp/demand_request/edit/'.$row->id.'"> 123Demand Request</a></li> 
                    <li><a class="icon-file-text" href="#"> xxx</a></li>  
                    </li>';
            }
            if ($this->session->userdata['group_id']==11){ //brm
                $icons=  '<a title="Validate IT Service Path" href="'.base_url().'master/document/cvp/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-picture"></span></a>'
                        ;
                $tombol='
                <li><a class="icon-file-text" href="'.base_url().'master/document/cvp/'.$row->id.'"> Validate IT Service Path</a></li>
                            </li>';
            }
            if($this->session->userdata['group_id']==12){//itplan
                $icons=  '<a title="IT Capacity Assessment" href="'.base_url().'carf/cvp/itca/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        ;
            }
            if($this->session->userdata['group_id']==5){//NetPlan 
                $icons=  '<a title="Demand Request" href="'.base_url().'carf/cvp/nca/edit/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>'
                        ;
            }
            if ($this->session->userdata['group_id']==8){ //Prodev
                $icons=  '<a title="Communication Plan & User Experience" href="'.base_url().'carf/cvp/spi/read/'.$row->id.'" class="widget-icon widget-icon-circle"><span class="icon-beaker"></span></a>';
            }
            $status1 = '
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                            BAU Request <span class="caret"></span>
                                            </button>
                        <ul class="dropdown-menu" role="menu">
                            '.$tombol.'
                        </ul>
                    </div>'; 
            $status='';$status1='';
            
        }    
        if ($lvl_approval == 4) {$lvlapproval='Type = UnProcess';}
        
        $isirow='<div class="content list">
            <div class="list-item">
                    <div class="list-datetime">
                        <div class="time"></div>
                        <div class="Date"><a href="'.base_url().'master/document/index/'.$row->id.'" class="widget-icon widget-icon-dark"><span class="icon-file-text"></span></a></div>
                    </div>
                    <div class="list-info">
                        <img src="'.Modules::run('options/settings/get_pic',$row->user_add).'" class="img-circle img-thumbnail" style="width: 50px; height: 50px">
                    </div>
                    <div class="list-text">
                        <a href="#" class="list-text-name"><i class="icon-tag"></i> '.$value.' | '.$row->request_num.$row->id.' | </a>'.$status1.'  '.$status.'
                        <p>Owner : '.Modules::run('carf/whois_user', $row->user_add).'</p>
                        <p>Last comment : '.Modules::run('carf/ambilpesan', $row->id).' | By : <img src="'.Modules::run('options/settings/get_pic',Modules::run('carf/ambilpesan_id', $row->id)).'" class="img-thumbnail" style="width: 15px; height: 15px">'.Modules::run('carf/pesanoleh', $row->id).'</p>
                        <p>'.$lvlapproval.'</p>'.
//                      <div class="progress progress-striped progress-small active">
//                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
//                        </div>
                    '</div>
                    <div style="height: 70px; line-height: 60px;" class="list-controls">
                        '.$icons.'
                    </div>
                </div>
                </div>';
        return $isirow;
    }
    public function req_new_service($id=''){
//    if(!Modules::run('role/has_role', 'completed')){    
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'New Service';
            $this->template->build('cvp/v_cvp_new_service', $data);
            if ($this->input->post()){
                $req = array(
                    'approval'        => 5,//merubah status action jadi Completed
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'user_update'   => $this->session->userdata('user_id')
                        );
                $msg = array(
                    'code'          => 'comment request', 
                    'dest_id'       => $id,
                    'msg'           => $this->input->post('comment', TRUE),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                        );
                $this->db->where('id', $id);
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                redirect('carf/cvp');
            }
        } 
    }
    public function req_bau_request($id=''){
//    if(!Modules::run('role/has_role', 'completed')){    
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'BAU Request';
            $this->template->build('cvp/v_cvp_bau_request', $data);
            if ($this->input->post()){
                $req = array(
                    'approval'        => 7,//merubah status action jadi Completed
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'user_update'   => $this->session->userdata('user_id')
                        );
                $msg = array(
                    'code'          => 'comment request', 
                    'dest_id'       => $id,
                    'msg'           => $this->input->post('comment', TRUE),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                        );
                $this->db->where('id', $id);
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                redirect('carf/cvp');
            }
        } 
    }
    public function ambilpesan($id){
        $comment = $this->m_carf->get_comment($id,'comment request');
        $pesan ='';
        foreach ($comment as $row_pesan) {
        $pesan = $row_pesan->msg;}
        if ($pesan == NULL){
            $pesan = '';
        }else{
            return $pesan;
        }
    }
    public function fsp(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Finalize Service Path');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();

                $crud->display_as('it_tottal_subs','Total Subs')	
                    ->display_as('it_sub_with_events','Subs with events')
                    ->display_as('it_increase_tps','Increase in TPS')
                    ->display_as('net_traffic_erlang','Traffic in Erlang')
                    ->display_as('net_throughput','Troughput')
                    ->display_as('net_tot_subs','Total Subs')
                    ->display_as('net_subs_events','Subs with event')
                         ;
                 if($this->session->userdata['group_id'] == '9'){//capman
                     $crud->required_fields(
                         'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events'
                     );
                     $crud->edit_fields(
                             'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events'
                             );
                 }
                 if($this->session->userdata['group_id'] == '5'){//itplan
                     $crud->required_fields(
                         'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events'
                     );
                     $crud->edit_fields(
                             'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events'
                             );
                 }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function service_path(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CARF) - Communication Plan & User Experience');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
//                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                
                 if($this->session->userdata['group_id'] == '9'){//capmanager
                     $crud->required_fields('it_tottal_subs',
                         'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                         'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
                         'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
                         'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
                         'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value'
                     );
                     $crud->edit_fields('it_tottal_subs',	
                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                        'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
                        'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
                        'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value');
                 }
                 if($this->session->userdata['group_id'] == '7'){//CMDB
                     $crud->required_fields('it_tottal_subs',
                         'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                         'net_subs_events','it_cap_available','it_cap_not_available',
                         'it_cap_par_available','it_cap_cond_available','net_cap_not_available',
                         'net_cap_par_available','net_cap_cond_available','net_element_resevation',
                         'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially');
                     $crud->edit_fields('it_tottal_subs',	
                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                        'net_subs_events','it_cap_available','it_cap_not_available',
                        'it_cap_par_available','it_cap_cond_available','net_cap_not_available',
                        'net_cap_par_available','net_cap_cond_available','net_element_resevation',
                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially');
                 }
//                $crud->edit_fields('service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
//                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
//                        'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
//                        'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
//                        'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
//                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value');
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $crud->display_as('service_path_desc','Service path description')
                    ->display_as('system_net_element','System and Network element impacted')
                    ->display_as('it_service_path','IT Service path')
                    ->display_as('it_system_desc','IT System description')
                    ->display_as('it_tottal_subs','Total Subs')	
                    ->display_as('it_sub_with_events','Subs with events')
                    ->display_as('it_increase_tps','Increase in TPS')
                    ->display_as('net_traffic_erlang','Traffic in Erlang')
                    ->display_as('net_throughput','Troughput')
                    ->display_as('net_tot_subs','Total Subs')
                    ->display_as('net_subs_events','Subs with event')
                    ->display_as('prod_dev_req','Product Development if required')
                    ->display_as('it_cap_assessment','Network Capacity assessment')
                    ->display_as('it_cap_available','Network Capacity available')
                    ->display_as('it_cap_not_available','Network Capacity not available')
                    ->display_as('it_cap_par_available','Network Capacity partial available')
                    ->display_as('it_cap_cond_available','Network Capacity conditionally available')
                    ->display_as('net_cap_available','IT Capacity available')
                    ->display_as('net_cap_not_available','IT Capacity not available')
                    ->display_as('net_cap_par_available','IT Capacity partial available')
                    ->display_as('net_cap_cond_available','IT Capacity conditionally available')
                    ->display_as('res_cap_across','Reserve capacity across')
                    ->display_as('net_element_resevation','Network element with reservation date')
                    ->display_as('cons_reserv','Consolidated reservetion')
                    ->display_as('dr_withdrawn','Demand withdrawn')
                    ->display_as('dr_approved','Demand approved')
                    ->display_as('dr_reject','Demand reject')
                    ->display_as('dr_partially','Demand partially')
                    ->display_as('cost_deliver','Cost to Deliver')
                    ->display_as('cost_cap_value','Cost of capacity');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function spi(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Service Path & Projections Information');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_list();//$crud->unset_read();
                $crud->unset_back_to_list();
                $crud->display_as('service_path_desc','Service path description')
                    ->display_as('system_net_element','System and Network element impacted')
                    ->display_as('it_service_path','IT Service path')
                    ->display_as('it_system_desc','IT System description')
                    ->display_as('it_tottal_subs','Total Subs')	
                    ->display_as('it_sub_with_events','Subs with events')
                    ->display_as('it_increase_tps','Increase in TPS')
                    ->display_as('net_traffic_erlang','Traffic in Erlang')
                    ->display_as('net_throughput','Troughput')
                    ->display_as('net_tot_subs','Total Subs')
                    ->display_as('net_subs_events','Subs with event')
                         ;
        $crud->unset_fields(
                        'project_name','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_prepaid_id','mention_reg_prep','mention_seg_prep','target_market_postpaid_id','mention_reg_post','mention_seg_post',
            'sp_project_txt',
            'first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax',
            'cs_tools_needed_id','cs_tools_other',
            'pd_pic','received_date',
            'additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas_orhers',
            'Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others',
            'business_model','business_model_other',
            'sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any',
            'vas_low_conc','vas_low_dev','vas_med_conc','vas_med_dev','vas_high_conc','vas_high_dev','device_low_conc','device_low_dev','device_med_conc','device_med_dev','device_high_conc','device_high_dev',
            'recommendation',
            'request_num','sp_project_id','email','mobile','additional_modul_vas','prog_mech_note','attachment_id',
            //'service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events',
            'prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value',
            'approval','created_at','user_add','updated_at','user_update'
        );
                 if($this->session->userdata['group_id'] == '9'){//capmanager
                     $crud->required_fields( 'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',
                         'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                         'net_subs_events');
                     $crud->edit_fields(
                             'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                        'net_subs_events'
                             );
                 }
                 if($this->session->userdata['group_id'] == '7'){//CMDB
                     //$crud->required_fields( 'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput',
                     //    'net_tot_subs','net_subs_events');
                     //$crud->edit_fields(
                     //        'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput',
                      //       'net_tot_subs','net_subs_events'
                       //      );
                 }
        if($this->session->userdata['group_id'] == '8'){//ProDev
            $crud->required_fields( 'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',
                'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                'net_subs_events');
            $crud->edit_fields(
                'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',
                'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                'net_subs_events'
            );
        }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function itca(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - IT Capacity Assessment');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();
                $crud->
                    display_as('it_cap_available','Capacity Assessment')
                    ->display_as('it_cap_not_available','Network Capacity not available')
                    ->display_as('it_cap_par_available','Network Capacity partial available')
                    ->display_as('it_cap_cond_available','Network Capacity conditionally available')
                         ;
                $crud->field_type('it_cap_available','enum',array('Capacity available','Capacity not available','Capacity partially available','Capacity conditionally available'));
//                array('1' => 'Capacity available', '2' => 'Capacity not available','3' => 'Capacity partially available' , '4' => 'Capacity conditionally available'));
                 if($this->session->userdata['group_id'] == '12'){//itplan
                     $crud->required_fields(
                         'it_cap_available'//,'it_cap_not_available'
                     );
                     $crud->edit_fields(
                             'it_cap_available','it_cap_par_available','it_cap_cond_available'//,'it_cap_not_available'
                             );
                 }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function nca(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Network Capacity Assesment');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();
                $crud->
                    display_as('net_cap_available','Net Capacity available')
                    ->display_as('net_cap_not_available','Net Capacity not available')
                    ->display_as('net_cap_par_available','Net Capacity partial available')
                    ->display_as('net_cap_cond_available','Net Capacity conditionally available')
                         ;
        $crud->field_type('net_cap_available','enum',array('Capacity available','Capacity not available','Capacity partially available','Capacity conditionally available'));
        //    array('1' => 'Capacity available', '2' => 'Capacity not available','3' => 'Capacity partially available' , '4' => 'Capacity conditionally available'));
                 if($this->session->userdata['group_id'] == '5'){//itplan
                     $crud->required_fields(
                         'net_cap_available'//,'net_cap_not_available'
                     );
                     $crud->edit_fields(
                             'net_cap_available','net_cap_par_available','net_cap_cond_available'//,'net_cap_not_available'
                             );
                 }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_netplan', $data);
    }
    public function recap(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Reserve Capacity');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();
                $crud->
                    display_as('res_cap_across','Reserve capacity across')
                    ->display_as('net_element_resevation','Network element with reservation date')
                    ->display_as('cons_reserv','Consolidated reservetion')
                         ;
                if ($this->session->userdata['group_id']==9 || $this->session->userdata['group_id']==7){//itplan
                    $crud->required_fields('res_cap_across');
                    $crud->edit_fields(
                            'res_cap_across','net_element_resevation','cons_reserv'
                            );
                }
                $crud->callback_field('net_element_resevation',array($this,'net_element_resevation'));
                $crud->callback_field('cons_reserv',array($this,'cons_reserv'));
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    function net_element_resevation($value = '', $primary_key = null){
        $tampil=  '<input value="'.$value.'" maxlength="10" type="text" id="date01" name="date01"/>'
                . '';
        return $tampil;
    }
    function cons_reserv($value = '', $primary_key = null){
        $tampil=  '<input value="'.$value.'" maxlength="10" type="text" id="date02" name="date02"/>'
                . '';
        return $tampil;
    }
    public function capclos(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Capture the Closer');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();
                $crud->
                    display_as('dr_withdrawn','Demand Status')
                    ->display_as('dr_approved','Note')
                         ;
                           $crud->unset_texteditor('dr_approved','full_text');
                 if ($this->session->userdata['group_id']==9 || $this->session->userdata['group_id']==7){//itplan
                     $crud->required_fields('dr_withdrawn','dr_approved');
                     $crud->edit_fields(
                             'dr_withdrawn','dr_approved'
                             );
                 }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function cost(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Cost to Deliver & Capacity Reserveation');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_back_to_list();
                $crud
                    ->display_as('cost_cur','Currency')    
                    ->display_as('cost_deliver','Cost to Deliver')
                    ->display_as('cost_cap_value','Cost of capacity')
                         ;
                $crud->field_type('cost_cur','enum',array('IDR','USD'));
                $crud->field_type('cost_deliver', 'integer');
                $crud->field_type('cost_cap_value', 'integer');
                 if ($this->session->userdata['group_id']==9 || $this->session->userdata['group_id']==7){//itplan
                     $crud->required_fields( 'cost_cur','cost_deliver','cost_cap_value');
                     $crud->edit_fields(
                             'cost_cur','cost_deliver','cost_cap_value'
                             );
                 }
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
    public function demand_request(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CVP) - Service Path & Projections Information');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
//                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->display_as('service_path_desc','Service path description')
                    ->display_as('system_net_element','System and Network element impacted')
                    ->display_as('it_service_path','IT Service path')
                    ->display_as('it_system_desc','IT System description')
                    ->display_as('it_tottal_subs','Total Subs')	
                    ->display_as('it_sub_with_events','Subs with events')
                    ->display_as('it_increase_tps','Increase in TPS')
                    ->display_as('net_traffic_erlang','Traffic in Erlang')
                    ->display_as('net_throughput','Troughput')
                    ->display_as('net_tot_subs','Total Subs')
                    ->display_as('net_subs_events','Subs with event')
                        
                    ->display_as('prod_dev_req','Product Development if required')
                    ->display_as('it_cap_assessment','Network Capacity assessment')
                    ->display_as('it_cap_available','Network Capacity available')
                    ->display_as('it_cap_not_available','Network Capacity not available')
                    ->display_as('it_cap_par_available','Network Capacity partial available')
                    ->display_as('it_cap_cond_available','Network Capacity conditionally available')
                    ->display_as('net_cap_available','IT Capacity available')
                    ->display_as('net_cap_not_available','IT Capacity not available')
                    ->display_as('net_cap_par_available','IT Capacity partial available')
                    ->display_as('net_cap_cond_available','IT Capacity conditionally available')
                    ->display_as('res_cap_across','Reserve capacity across')
                    ->display_as('net_element_resevation','Network element with reservation date')
                    ->display_as('cons_reserv','Consolidated reservetion')
                    ->display_as('dr_withdrawn','Demand withdrawn')
                    ->display_as('dr_approved','Demand approved')
                    ->display_as('dr_reject','Demand reject')
                    ->display_as('dr_partially','Demand partially')
                    ->display_as('cost_deliver','Cost to Deliver')
                    ->display_as('cost_cap_value','Cost of capacity');
                 if($this->session->userdata['group_id'] == '9'){//capmanager
                     $crud->required_fields(  'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',
                         'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                         'net_subs_events');
                     $crud->edit_fields(
                             'service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
                        'net_subs_events'
//                             ,'prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
//                        'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
//                        'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
//                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value'
                             );
                 }
                 if($this->session->userdata['group_id'] == '7'){//CMDB
                     $crud->required_fields( 'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput',
                         'net_tot_subs','net_subs_events'
                         ,'it_cap_available','it_cap_not_available');
                     $crud->edit_fields(
                             'it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput',
                             'net_tot_subs','net_subs_events'
                             ,'it_cap_available','it_cap_not_available'
//                        ,'it_cap_par_available','it_cap_cond_available','net_cap_not_available',
//                        'net_cap_par_available','net_cap_cond_available','net_element_resevation',
//                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially'
                             );
                 }
//                $crud->edit_fields('service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
//                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
//                        'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
//                        'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
//                        'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
//                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value');
                $crud->set_lang_string('update_success_message',
                     'Your data has been successfully stored into the database.<br/>.
                     <script type="text/javascript">
                              window.location = "'.base_url().'carf/cvp";
                             </script>
                             <div style="display:none">
                     ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
}
