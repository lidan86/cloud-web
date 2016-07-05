<?php
class carf extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('m_carf');
    }
    public function index(){

        $crud = $this->new_crud();
        $data['get_capacity']        = '';
        $data['newbutton']='';

        if($this->session->userdata['group_id'] == '6' || $this->session->userdata['group_id'] == '15' || $this->session->userdata['group_id'] == '16' || $this->session->userdata['group_id'] == '17'){//requester
            $url_link = "href='".base_url()."carf/new_prg_info/index/add'";
            $data['newbutton']='<button type="button" class="btn btn-success" onclick="location.'.$url_link.'">CARF FORM</button>';
           if($this->session->userdata['job_role'] == 1 ||$this->session->userdata['job_role'] == 2){

           }else {
               $crud->where('user_add', $this->session->userdata['user_id']);
           }
            $crud->where('(approval = 11 OR approval = 4 OR approval = 21 OR approval = 5 OR approval = 51)');
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_carf_request($this->session->userdata['user_id']);
        }
        if($this->session->userdata['group_id'] == '7'){//cmdb
            $data['newbutton']='';
            $crud->or_where('approval',1);
            $crud->or_where('approval',21);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_carf();
        }    
        if($this->session->userdata['group_id'] == '8'){//prodev
            $data['newbutton']='';
            $crud->or_where('approval',2);
            $crud->or_where('approval',31);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_carf();
        }
        if($this->session->userdata['group_id'] == '9'){//capmanager
            $data['newbutton']='';
            $crud->or_where('approval',3);
            $crud->or_where('approval',4);
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_carf();
        }
         if($this->session->userdata['group_id'] == '10'){//capmanager
            $data['newbutton']='';
			
            $crud->or_where('approval',4);
            
           
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_delete();
            $data['get_capacity']= $this->m_carf->get_all_carf();
        }
        if($this->session->userdata['group_id'] == '1'){//administrator
        }
                $crud->set_table('carf');
                $crud->set_subject('CAPACITY ASSESMENT REQUEST FORM (CARF)');
                $crud->columns('project_name');

                $crud->fields('project_name','updated_at');
                 $crud->order_by('created_at','desc');

                $crud->unset_export();$crud->unset_print();

//                $crud->unset_read_fields('created_at','user_add','updated_at','user_update','approval');
                $crud->callback_column('project_name',array($this,'_callback_action'));
                $data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
    }
    public function _callback_action($value, $row){
        $flag = $row->flag_form;
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
        $pesan='';$status='';
        if($this->session->userdata['group_id'] == '10'){
			 $status1 = '
            <div class="btn-group">
            <button type="button" class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                    Review <span class="caret"></span>
                                    </button>
                <ul class="dropdown-menu" role="menu">
                   
                    <li><a href="'.base_url().'carf/traffic_proj/index/edit/'.$row->id.'">Traffic Projection</a></li>
                   <li><a class="icon-file-text" href="'.base_url().'master/document/index/'.$row->id.'">Attachment File</a></li>   
                    
                    <li class="divider"></li><li><!-- start message -->
                    </li>
                </ul>
            </div>';
			}else{
            $kl = '';
            if($flag == 0){
                for($x = 0; $x < 13; $x++){
                    $kl .= '<li><a href="#"><i class="icon-remove" style="color:red;"></i></a></li>';
                }
            }elseif($flag == 1){
                for($x = $flag; $x <= 13; $x++){
                    $kl .= '<li><a href="#"><i class="icon-remove" style="color:red;"></i></a></li>';
                }
            }else{
                for($y = 1; $y <= $flag; $y++){
                    $kl .= '<li><a href="#"><i class="icon-check-sign" style="color:green;"></i></a></li>';
                }
                for($x = $flag+1; $x <= 13; $x++){
                    $kl .= '<li><a href="#"><i class="icon-remove" style="color:red;"></i></a></li>';
                }
            }
        $status1 = '
            <div class="btn-group">
            <button type="button" class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                    Review <span class="caret"></span>
                                    </button>
                <ul class="dropdown-menu multi-column columns-2" role="menu" style="width: 200px;">
                <div class="row">
                    <div class="col-md-10">
                    <li><a href="'.base_url().'carf/prg_info/index/edit/'.$row->id.'">Program Information</a></li>
                    <li><a href="'.base_url().'carf/traffic_proj/index/edit/'.$row->id.'">Traffic Projection</a></li>
                    <li><a href="'.base_url().'carf/pack_detail/index/edit/'.$row->id.'">Package Detail</a></li>
                    <li><a href="'.base_url().'carf/cs_tools/index/edit/'.$row->id.'">CS Tools</a></li>
                    <li><a href="'.base_url().'carf/capman/index/edit/'.$row->id.'">Capacity Management</a></li>
                    <li><a href="'.base_url().'carf/spec_add/index/edit/'.$row->id.'">Specific Additional</a></li>
                    <li><a href="'.base_url().'carf/com_plan/index/edit/'.$row->id.'">Communication Plan</a></li>
                    <li><a href="'.base_url().'carf/bus_mod/index/edit/'.$row->id.'">Business Model</a></li>
                    <li><a href="'.base_url().'carf/prg_mec/index/edit/'.$row->id.'">Program Mechanism</a></li>
                    <li><a href="'.base_url().'carf/impact/index/edit/'.$row->id.'">Impact Assessment Result</a></li>
                    <li><a href="'.base_url().'carf/compl_lvl/index/edit/'.$row->id.'">Complexity Level</a></li>
                    <li><a href="'.base_url().'carf/recommend/index/edit/'.$row->id.'">Recommendation</a></li>
                    <li><a class="icon-file-text" href="'.base_url().'master/document/index/'.$row->id.'">Attachment File</a></li>   
                    <li class="divider"></li><li><!-- start message -->
                    </li>
                    </div>
                    <div class="col-md-2">
                    '.$kl.'

                    </div>
                </div>
                </ul>
            </div>';
		}

        $status2 = '
            <div class="btn-group">
            <button type="button" class="btn btn-primary btn-clean dropdown-toggle" data-toggle="dropdown">
                                    View <span class="caret"></span>
                                    </button>
                <ul class="dropdown-menu" role="menu">

                    <li><a href="'.base_url().'carf/prg_info/index/read/'.$row->id.'">Program Information</a></li>
                    <li><a href="'.base_url().'carf/traffic_proj/index/read/'.$row->id.'">Traffic Projection</a></li>
                    <li><a href="'.base_url().'carf/pack_detail/index/read/'.$row->id.'">Package Detail</a></li>
                    <li><a href="'.base_url().'carf/cs_tools/index/read/'.$row->id.'">CS Tools</a></li>
                    <li><a href="'.base_url().'carf/capman/index/read/'.$row->id.'">Capacity Management</a></li>
                    <li><a href="'.base_url().'carf/spec_add/index/read/'.$row->id.'">Specific Additional</a></li>
                    <li><a href="'.base_url().'carf/com_plan/index/read/'.$row->id.'">Communication Plan</a></li>
                    <li><a href="'.base_url().'carf/bus_mod/index/read/'.$row->id.'">Business Model</a></li>
                    <li><a href="'.base_url().'carf/prg_mec/index/edit/'.$row->id.'">Program Mechanism</a></li>
                    <li><a href="'.base_url().'carf/impact/index/read/'.$row->id.'">Impact Assessment Result</a></li>
                    <li><a href="'.base_url().'carf/compl_lvl/index/read/'.$row->id.'">Complexity Level</a></li>
                    <li><a href="'.base_url().'carf/recommend/index/read/'.$row->id.'">Recommendation</a></li>
                    <li><a class="icon-file-text" href="'.base_url().'master/document/index/'.$row->id.'"></a></li>   
                    <li class="divider"></li><li><!-- start message -->
                    </li>

                </ul>
            </div>
            ';
        if($this->session->userdata['group_id'] == '6' && $flag <= 12){
            if($flag == 1 || $flag == 0){
                $status3 = '<a class="btn btn-danger" href="'.base_url().'carf/traffic_proj/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 2){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/pack_detail/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 3){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/cs_tools/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 4){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/capman/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 5){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/spec_add/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 6){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/com_plan/index/edit/'.$row->id.'">Incomplete</a>
           ';
            }elseif($flag == 7){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/bus_mod/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 8){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/impact/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }elseif($flag == 10){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/compl_lvl/index/edit/'.$row->id.'">Incomplete</a>
           ';
            }elseif($flag == 11){
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'carf/recommend/index/edit/'.$row->id.'">Incomplete</a>
            ';
            }else{
                $status3 = '
                       <a class="btn btn-danger" href="'.base_url().'master/document/index/'.$row->id.'">Incomplete</a>
            ';
            }

        }else{
            $status3 = '';
        }
        if ($lvl_approval == 0) {$status='<button class="btn btn-danger disabled">Error.!</button>';}
        if ($lvl_approval == 1) {$status='<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Response</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/verification/'.$row->id.'">Accept</a></li>
                    <li><a href="'.base_url().'carf/unverification/'.$row->id.'">Reject.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}
        if ($lvl_approval == 2) {$status='<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Response</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/approved/'.$row->id.'">Accept</a></li>
                    <li><a href="'.base_url().'carf/unapproved/'.$row->id.'">Reject.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}
        if ($lvl_approval == 3) {$status='<div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Response</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/completed/'.$row->id.'">Accept</a></li>
                    <li><a href="'.base_url().'carf/uncompleted/'.$row->id.'">Reject.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>
                </ul>
            </div>';}    
        if ($lvl_approval == 4) {
            if($this->session->userdata['group_id'] == '9'){
                $status='<button class="btn btn-danger disabled">Under Assesment</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Confrim to Launch</button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="'.base_url().'carf/confrim/'.$row->id.'">Yes</a></li>
                         <li><a href="'.base_url().'carf/unconfrim/'.$row->id.'">No</a></li>
                    </ul>
                </div>';
            }else{
                $status='<button class="btn btn-danger disabled">Under Assesment</button>';
            }

        }
        if ($lvl_approval == 11) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"">Actions</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/newrequest/'.$row->id.'">Submit Request</a></li>
                    <li class="divider"></li>
                    <li><a onclick="return confirmDialog()" href="'.base_url().'carf/delete_/'.$row->id.'">Delete</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>    
                </ul>
            </div>';}
        if ($lvl_approval == 21) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Response!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/newrequest/'.$row->id.'">Re Submited</a></li>
                    <li><a onclick="return confirmDialog()" href="'.base_url().'carf/delete_/'.$row->id.'">Delete</a></li>

                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>    
                </ul>
            </div>';}
        if ($lvl_approval == 31) {$status='<div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Response!</button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="'.base_url().'carf/approved/'.$row->id.'">Accept</a></li>
                     <li><a href="'.base_url().'carf/unapproved/'.$row->id.'">Reject.!</a></li>
                    <li class="divider"></li><li><!-- start message -->
                        <a>
                            <h5>
                                <small><i class="fa fa-clock-o"></i> '.$waktu.'</small>                            
                                <p><small>Comment : '.$this->ambilpesan($row->id).'</small></p>
                            </h5>
                        </a>
                    </li>
                    
                </ul>
            </div>';} 
        if($this->session->userdata['group_id'] == '6'||$this->session->userdata['group_id'] == '9'||$this->session->userdata['group_id'] == '10'){
            
        }else{
            $status1='';
        }
        if ($lvl_approval == 99) {$status='<button class="btn btn-default disabled">Delete.!</button>';}
        if ($lvl_approval == 5) {$status='<button class="btn btn-success disabled">Success Launch</button>';}
        if ($lvl_approval == 51) {$status='<button class="btn btn-default disabled">Close Launch</button>';}
       if($this->session->userdata['group_id'] == '6' && $flag <=12){
           $isirow='  <div class="row">'
               . '     <div class="col-md-8">'
               . '         <i class="icon-tag"></i> '.$value.' | '.$row->request_num.$row->id
               . '     <div>'
               . '<div>'
               . '<div class="row">'
               . '     <div class="col-md-12">'
               . '         | '.$status1.$status2.$status3.'  '
               . '     <div>'
               . '<div>';
       }else {
           $isirow = '  <div class="row">'
               . '     <div class="col-md-8">'
               . '         <i class="icon-tag"></i> ' . $value . ' | ' . $row->request_num . $row->id
               . '     <div>'
               . '<div>'
               . '<div class="row">'
               . '     <div class="col-md-12">'
               . '         | ' . $status1 . $status2 . '  ' . $status . ''
               . '     <div>'
               . '<div>';
       }
        return $isirow;
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
    public function ambilpesan_id($id){
        $comment = $this->m_carf->get_comment($id,'comment request');
        $pesan ='';
        foreach ($comment as $row_pesan) {
        $pesan = $row_pesan->user_add;}
        if ($pesan == NULL){
            $pesan = '';
        }else{
            return $pesan;
        }
    }
    public function pesanoleh($id){
        $comment = $this->m_carf->get_comment($id,'comment request');
        $pesan ='';
        foreach ($comment as $row_pesan) {
        $pesan = $this->whois_user($row_pesan->user_add);}
        if ($pesan == NULL){
            $pesan = '';
        }else{
            return $pesan;
        }
    }
    public function whois_user($id){
        $hasil_qry = $this->m_carf->get_info_user($id);
        $hasil ='';
        foreach ($hasil_qry as $row_hasil) {
        $hasil = $row_hasil->username;}
        if ($hasil == NULL){
            $hasil = '';
        }else{
            return $hasil;
        }
    }


// Work flow
        public function newrequest($id=''){
//    if(!Modules::run('role/has_role', 'verification')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'New Request';
            //$this->template->build('v_newrequest', $data);
           // if ($this->input->post()){
            $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
            $sq = $quer->result();
            foreach($sq as $row){
                $project = $row->project_name;
                $ttd = $row->ttd;
                $program = "Your request ".$project." Sucessfully submitted with UDR Number: ".$row->request_num.$id;
                $program .= "<br> has been recieved and will be reviewed by Product Development team";
            }
                $req = array(
                    'approval'        => 2,//merubah status action jadi New Verification
//                    'traffic_subs'  => $this->input->post('traffic_subs', TRUE),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'user_update'   => $this->session->userdata('user_id')
                        );
                $msg = array(
                    'code'          => 'comment request',
                    'dest_id'       => $id,
                    'msg'           => $program,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                        );
                $this->db->where('id', $id);
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $capman='';
                $cmdb='';
                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }

                $date = date('H');
                $new_date = strtotime($date) + strtotime("+".$sla1." hours");
                $new_date = date('Y-m-d H:i:s', $new_date);

                $cron3 = array(
                    'sla' => 3,
                    'subject' => 'Remider Not Respon '.$sla1.' Hour Request CARF #'.$id,
                    'carf_id' => $id,
                    'note' => $this->input->post('comment').' link '.base_url(),
                    'mail_to' => 9,
                    'send_time' => $new_date,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                );
                $this->db->insert('cron',$cron3);

                $cron8 = array(
                    'sla' => 10,
                    'subject' => 'Expiry Of Request CARF #'.$id,
                    'carf_id' => $id,
                    'note' => ' This will launch the product is '.$project,
                    'mail_to' => 6,
                    'send_time' => $ttd,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                );
                $this->db->insert('cron',$cron8);

                $subject = 'New Request CARF #'.$id;
                $isi = $program;
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=7 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                //http://192.168.50.93:8080/ServerMail/Mail?status=now&mailfrom=capman@belinux.com&mailto=irsyadul.reza@gmail.com&subject=wwef&content=wwefwe

                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
            //ServerMail/Smsc?tosms=....&message=
            $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
            $result2 = json_decode($json2,true);
//                $this->sendMail($this->session->userdata('user_id'), 'CARF - New Request', $msg['msg']);
                m('s', $msg['msg'].'<br>'.'send mail success, ');
                redirect('carf');
            }
      //  }
//    }redirect('home');
    }
    public function verification($id=''){
//    if(!Modules::run('role/has_role', 'verification')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Verification';
            $this->template->build('v_verification', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }
                    $req = array(
                    'approval'        => 2,//merubah status action jadi New Verification
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }

                $subject = 'Verification CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=8");
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);
                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function unverification($id=''){
//    if(!Modules::run('role/has_role', 'unverification')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'UnVerification';
            $this->template->build('v_unverification', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }
                $req = array(
                    'approval'        => 11,//merubah status action jadi Unverification
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                }


                $subject = 'Un Verification CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=6");
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);


                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function approved($id=''){
//    if(!Modules::run('role/has_role', 'approved')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Approved';
            $this->template->build('v_approved', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }
                $req = array(
                    'approval'        => 3,//merubah status action jadi Approved
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }

                $date = date('H');
                $new_date = strtotime($date) + strtotime("+".$sla1." hours");
                $new_date = date('Y-m-d H:i:s', $new_date);

                $cron3 = array(
                    'sla' => 3,
                    'subject' => 'Remider Not Respon '.$sla1.' Hour Request CARF #'.$id,
                    'carf_id' => $id,
                    'note' => $this->input->post('comment').' link '.base_url(),
                    'mail_to' => 9,
                    'send_time' => $new_date,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                );
                $this->db->insert('cron',$cron3);
                $subject = 'Approved CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=9 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);

                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function unapproved($id=''){
//    if(!Modules::run('role/has_role', 'unapproved')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'UnApproved';
            $this->template->build('v_unapproved', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }

                $req = array(
                    'approval'        => 21,//merubah status action jadi New Request
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                }


                $subject = 'Un Approved CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=6 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);

                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function completed($id=''){
//    if(!Modules::run('role/has_role', 'completed')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Completed';
            $this->template->build('v_completed', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }

                $req = array(
                    'approval'        => 4,//merubah status action jadi Completed
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);

                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }
                $this->db->where('carf_id', $id);
                $this->db->where('sla', $sla1);
                $this->db->delete('cron');


                $subject = 'Completed CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=10 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);
                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function uncompleted($id=''){
//    if(!Modules::run('role/has_role', 'uncompleted')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Reject';
            $this->template->build('v_uncompleted', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }

                $req = array(
                    'approval'        => 21,//merubah status action jadi UnCompleted
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }
                $this->db->where('carf_id', $id);
                $this->db->where('sla', $sla1);
                $this->db->delete('cron');



                $subject = 'Un Completed CARF #'.$id;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=8 OR group_id=6 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                $mobile = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.urlencode($row->email).'&';
                    $mobile . 'tosms='.urlencode($row->mobile).'&';

                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);
                //ServerMail/Smsc?tosms=....&message=
                $json2 = file_get_contents($api.'ServerMail/Smsc?'.$mobile.'&message='.$subject.'',false,$context);
                $result2 = json_decode($json2,true);
                redirect('carf');
            }
        }
//    }redirect('home');    
    }

    //Confrim To Launch
    public function confrim($id=''){
//    if(!Modules::run('role/has_role', 'completed')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Confrim to launch';
            $this->template->build('v_confrim', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }

                $req = array(
                    'approval'        => 5,//merubah status action jadi Completed
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);

                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }
                $this->db->where('carf_id', $id);
                $this->db->where('sla', $sla1);
                $this->db->delete('cron');


                $subject = 'Success Launch Carf #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=10 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.$row->email.'&';


                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1200)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);

                redirect('carf');
            }
        }
//    }redirect('home');
    }
    public function unconfrim($id=''){
//    if(!Modules::run('role/has_role', 'uncompleted')){
        if ($id != ''){
            $data['req']        = $this->m_carf->get_carf($id);
            $data['action_id']   = $id;
            $data['title']   = 'Unconfrim to Launch';
            $this->template->build('v_unconfrim', $data);
            if ($this->input->post()){
                $quer = $this->db->query("select project_name, ttd,program_desc,request_num from carf where id =".$id." LIMIT 1");
                $sq = $quer->result();
                foreach($sq as $row) {
                    $code = $row->requestnum.$id;

                }

                $req = array(
                    'approval'        => 51,//merubah status action jadi UnCompleted
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
                $this->db->update('carf', $req);
                $this->db->insert('m_msg', $msg);
                $queryx = $this->db->query("select api, sla1, sla2 from api LIMIT 1");
                $sqlx = $queryx->result();
                foreach($sqlx as  $row){
                    $api = $row->api;
                    $sla1 = $row->sla1;
                    $sla2 = $row->sla2;
                }
                $this->db->where('carf_id', $id);
                $this->db->where('sla', $sla1);
                $this->db->delete('cron');



                $subject = 'Unsuccess to Launch CARF #'.$code;
                $isi = $this->input->post('comment').' link '.base_url();
                $queryx = $this->db->query("select email,mobile  from ion_users WHERE group_id=8 OR group_id=6 OR id=".$this->session->userdata('user_id'));
                $res = $queryx->result();
                // http://192.168.50.93:8080/MailServer/Mail?mailfrom=reza.irsyadul@gmail.com&mailto=shwibowo@bajau.com&mailcc1=maulidan@bajau.com&mailcc2=Ajibaskoro@bajau.com&subject=test%20email%20dari%20server%20capman&content=test%20email%20aja
                $mailTo = '';
                foreach($res as  $row){
                    $mailTo .= 'mailto='.$row->email.'&';


                }

                $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1200)));
                $json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('CapacityMgmtServ@xl.co.id').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
                $result = json_decode($json,true);

                redirect('carf');
            }
        }
//    }redirect('home');
    }
    
    function delete_($id=''){
//    if(!Modules::run('role/has_role', 'deleterequest')){    
        if ($id != ''){
            $this->m_carf->delete_carf($id);
        }
        redirect('carf');
//    }redirect('home');    
    }
    
    public function sendMail($to='',$sub='',$msg=''){
        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host'] = "aapialang.co.id";
        $config['smtp_user'] = "reko@aapialang.co.id"; 
        $config['smtp_pass'] = "g4t3w4y";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from('reko@aapialang.co.id');
        $this->email->to($to);

        $this->email->subject($sub);
        $this->email->message($msg);

          if($this->email->send())
         {
          m('s', 'Email sent.');
         }
         else
        {
         m('w', show_error($this->email->print_debugger()));
        }
    }
    public function test($id=''){
        $this->db->where('group_id', $id);
        $result = $this->db->get('ion_users')
                ->result();
        foreach ($result as $row_hasil) {
            echo $row_hasil->username;
        }
    }
}
