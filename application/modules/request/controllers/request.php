<?php
class Request extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
        $this->load->library('grocery_CRUD');
        $this->load->model('m_request');
//        $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['get_capacity']        = '';
        $status = 0;
        $crud = new grocery_CRUD();
        $data['get_all_req']= $this->m_request->get_all_req();
        if($this->session->userdata['group_name'] == 'request'){
            
//            $crud->add_action('request', '', 'master/lampiran/index','ui-icon-image');
//            $crud->add_action('request', '', '','ui-icon-image',array($this,'just_a_test'));  
//            $crud->where('user_add',$this->session->userdata['user_id']);
            $crud->where('action','4');
            $crud->or_where('action','11');
//            $crud->or_where('action','4');
//            $crud->unset_add();
            $crud->unset_read();
//            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_request->get_all_capacity_request($this->session->userdata['user_id']);
        }
        if($this->session->userdata['group_name'] == 'capman'){
//            $crud->add_action('capman', '', 'master/lampiran/index','ui-icon-image');
//            $crud->add_action('', '', '','ui-icon-image',array($this,'just_a_test'));
            $crud->or_where('action',1);
            $crud->or_where('action',3);
            $crud->or_where('action',21);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            
        }    
        if($this->session->userdata['group_name'] == 'netplan'){
//            $crud->add_action('request', '', 'master/lampiran/index','ui-icon-image');
            $crud->where('action',2);
            $crud->or_where('action',31);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
        }
        if($this->session->userdata['group_name'] == 'administrator'){
//            $crud->add_action('request', '', 'master/lampiran/index','ui-icon-image');
        }
        // baru=1 verifikasi=2 backtoverifikasi=3 approved=4 backtoapproved=5
        
        $crud->set_table('capacity');
        $crud->set_subject('Request');
        $crud->set_theme('datatables');
        $crud->unset_export();
        $crud->unset_print();
        $crud->required_fields('program_name','channel');
        $crud->columns('program_name'
//                ,'service_id','start_date','end_date'
                ,'action');
        $crud->display_as('program_name','Program Name')->display_as('service_id','Service')
                ->display_as('action','Status')
                ;
        $crud->set_relation_n_n('service_id','r_capacity_service','m_service','capacity_id','service_id','service');
        $crud->set_relation('channel_id','m_channel','channel');
        $crud->set_relation('bo_id','m_business_owner','business_owner');
//        $crud->set_relation('user_add','ion_users','username');
        $crud->change_field_type('created_at','invisible')
                ->change_field_type('user_add','invisible')
                ->change_field_type('updated_at','invisible')
                ->change_field_type('user_update','invisible');
        $crud->callback_column('program_name',array($this,'_callback_program_name'));
        $crud->callback_column('action',array($this,'_callback_action'));
        $crud->callback_before_insert(array($this,'insert_callback'));
        $crud->callback_before_update(array($this,'update_callback'));
        if ($crud->getState() == 'edit') {$crud->field_type('equip_type_id', 'hidden');}
        $data['gcrud'] = $crud->render();
        $data['gcrud1'] = '';
	$this->template->build('v_index', $data);
    }
    public function _callback_program_name($value, $row){        
        //Interval waktu begin
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
//        if (!$full) $string = array_slice($string, 0, 1);
        $waktu = $string ? implode(', ', $string) . ' lalu' : 'baru saja';
        //Interval waktu end
        
        $tampilan = '<strong>'.$value.'</strong>'; 
        return $tampilan.' <a href="#modal_req_'.$row->id.'" data-toggle="modal" class="icon-list-alt"> </a>'
                . '<a class="icon-file-text" href="'.base_url().'master/lampiran/index/'.$row->id.'"></a>'
                . ' <small class="label label-default messages-item-text icon-time"><a class="messages-item-text icon-time"> '.$waktu.'</a></small>'
            ;
    }
    public function _callback_action($value, $row){
        $status='';
        $baris=$row->id;
        $kondisi=$value;
        //Interval waktu begin
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
//        if (!$full) $string = array_slice($string, 0, 1);
        $waktu = $string ? implode(', ', $string) . ' lalu' : 'baru saja';
        $pesan='';
        $waktu = $string ? implode(', ', $string) . ' lalu' : 'baru saja';
        $comment = $this->m_request->get_comment($row->id,'comment request');
        foreach ($comment as $row) {
        $pesan = $row->msg;
        }
//        if ($comment !==''){
////            $user_msg = $comment->user_add;
//            $pesan = $comment['msg'];
//        }  else {
////            $user_msg = '';
//            $pesan = '...';
//        }
        //Interval waktu end
        if ($value == 0) {$status='<button class="btn btn-danger disabled">Error.!</button>';}
        if ($value == 1) {$status='<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">New requests.!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/verification/'.$row->id.'">Verification</a></li>
                    <li><a href="'.base_url().'request/unverification/'.$row->id.'">UnVerification.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}
        if ($value == 2) {$status='<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">New Verification.!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/approved/'.$row->id.'">Approved</a></li>
                    <li><a href="'.base_url().'request/unapproved/'.$row->id.'">UnApproved.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}
        if ($value == 3) {$status='<div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">New Approved</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/completed/'.$row->id.'">Completed</a></li>
                    <li><a href="'.base_url().'request/uncompleted/'.$row->id.'">UnCompleted.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}    
        if ($value == 4) {$status='<button class="btn btn-danger disabled">Completed</button>';}
        if ($value == 11) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"">UnVerification!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/newrequest/'.$row->id.'">New Request</a></li>
                    <li class="divider"></li>
                    <li><a onclick="return confirmDialog()" href="'.base_url().'request/delete_/'.$row->id.'">Delete</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>    
                </ul>
            </div>';}
        if ($value == 21) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">UnApproved!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/verification/'.$row->id.'">Verification</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>    
                </ul>
            </div>';}
        if ($value == 31) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">UnCompleted!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'request/approved/'.$row->id.'">Approved</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$pesan.'</small></p>
                            </h5>
                        </a>
                    </li>
                    
                </ul>
            </div>';} 
        if ($value == 99) {$status='<button class="btn btn-default disabled">Delete.!</button>';}    
//        return "<a href='".site_url('admin/sub_webpages/'.$row->id)."'>$value</a>";
//        '.$this->m_request->get_comment($id,'').'
        return $status;
    }
    public function _request_action($value, $row){
        $status='';
        $baris=$row->id;
        $kondisi=$value;
        if ($value == 0) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Error ... !!</small>';}
        if ($value == 1) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Capman Processing New Request ... !!</small>';}
        if ($value == 2) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Netplan Processing New Verivication ... !!</small>';}
        if ($value == 3) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Capman Processing New Approved... !!</small>';}    
        if ($value == 4) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Completed ... !!</small>';}
        if ($value == 11) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> UnVerification ... !!</small>';}
        if ($value == 21) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Capman Processing UnApproved ... !!</small>';}
        if ($value == 31) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Netplan Processing UnFinal ... !!</small>';} 
        if ($value == 99) {$status='<small class="label label-default"><i class="fa fa-clock-o"></i> Delete ... !!</small>';}    
//        return "<a href='".site_url('admin/sub_webpages/'.$row->id)."'>$value</a>";
        return $status;
    }
    
        function insert_callback($post_array) { 
            $post_array['action'] = 11;
            $post_array['created_at'] = date('Y-m-d H:i:s');
            $post_array['user_add'] = $this->session->userdata('user_id'); 
            return $post_array;
        }
        function update_callback($post_array) { 
            $post_array['updated_at'] = date('Y-m-d H:i:s');
            $post_array['user_update'] = $this->session->userdata('user_id'); 
            return $post_array;
        }
    public function newrequest($id=''){
//    if(!Modules::run('role/has_role', 'verification')){
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'New Request';
            $this->template->build('v_newrequest', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 1,//merubah status action jadi New Verification
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');
    }    
    public function verification($id=''){
//    if(!Modules::run('role/has_role', 'verification')){
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'Verification';
            $this->template->build('v_verification', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 2,//merubah status action jadi New Verification
                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');
    }
    public function unverification($id=''){
//    if(!Modules::run('role/has_role', 'unverification')){    
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'UnVerification';
            $this->template->build('v_unverification', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 11,//merubah status action jadi Unverification
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');    
    }
    public function approved($id=''){
//    if(!Modules::run('role/has_role', 'approved')){    
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'Approved';
            $this->template->build('v_approved', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 3,//merubah status action jadi Approved
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');    
    }
    public function unapproved($id=''){
//    if(!Modules::run('role/has_role', 'unapproved')){    
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'UnApproved';
            $this->template->build('v_unapproved', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 1,//merubah status action jadi New Request
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');
    }
    public function completed($id=''){
//    if(!Modules::run('role/has_role', 'completed')){    
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'Completed';
            $this->template->build('v_completed', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 4,//merubah status action jadi Completed
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');    
    }
    public function uncompleted($id=''){
//    if(!Modules::run('role/has_role', 'uncompleted')){    
        if ($id != ''){
            $data['req']        = $this->m_request->get_capacity($id);
            $data['action_id']   = $id;
            $data['title']   = 'UnCompleted';
            $this->template->build('v_uncompleted', $data);
            if ($this->input->post()){
                $req = array(
                    'action'        => 31,//merubah status action jadi UnCompleted
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
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
                $this->db->update('capacity', $req);
                $this->db->insert('m_msg', $msg);
                redirect('request');
            }
        }
//    }redirect('home');    
    }
    
    function delete_($id=''){
//    if(!Modules::run('role/has_role', 'deleterequest')){    
        if ($id != ''){
            $this->m_request->delete_capacity($id);
        }
        redirect('request');
//    }redirect('home');    
    }
    

}